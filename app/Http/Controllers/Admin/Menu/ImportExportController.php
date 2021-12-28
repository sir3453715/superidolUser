<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Exports\DemoExport;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailQueueJob;
use App\Models\ActionLog;
use App\Models\CarData;
use App\Models\CarItems;
use App\Models\CarType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Nette\Utils\Random;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\TimeValue;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $import_data = Session::get('data') ?? null;

        return view('admin.feature.ImportExport', [
            'import_data'=>$import_data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * custome Import And Export
     * @param $id
     */
    public function import(Request $request)
    {
        if($request->hasFile('import')){
            $extension = $request->file('import')->getClientOriginalExtension(); //副檔名
            $path1 = time() . "." . $extension;    //重新命名
            $request->file('import')->move(storage_path('app').'/temp', $path1); //移動至指定目錄
            $path=storage_path('app').'/temp/'.$path1;
            $excel = Excel::toArray('' ,$path);
            $data = array();
            $errorData = array();
            switch ($request->get('type')){
                case 1://隔熱紙
                    foreach ($excel as $key => $sheets){ // 各個表分別撈出來
                        foreach ($sheets as $rows => $column){
                            if($rows>0){ //排除檔案標題欄位
                                $checkValue = $this->checkImportValue($column,1);
                                if($checkValue['result']){
                                    $userData=[
                                        'name'=>$column[0],
                                        'phone'=>str_replace('-','',$column[1]),
                                        'tel'=>str_replace('-','',$column[2]),
                                        'ID_number'=>$column[3],
                                        'address'=>$column[4],
                                        'email'=>$column[5],
                                    ];
                                    $user = User::where(function ($query) use ($userData){
                                        $query->orwhere('email',$userData['email']);
                                        $query->orwhere('phone',$userData['phone']);
                                        $query->orwhere('ID_number','%'.$userData['ID_number']);
                                    })->first();
                                    if($user){
                                        $userType = explode(',',$user->type);
                                        $userType[] = "1";
                                        $typeArray = array_unique($userType);
                                        $userData['type']=implode(',',$typeArray);
                                        $user->fill($userData);
                                        $user->save();
                                        ActionLog::create_log($user);
                                    }else{
                                        $userData['type']=1;
                                        $userData['password']=Hash::make(Random::generate());
                                        $user = User::create($userData);
                                        $user->assignRole('customer');
                                        ActionLog::create_log($user,'create');
                                    }
                                    $carDataArray=[
                                        'user_id'=>$user->id,
                                        'date'=>date('Y-m-d',Date::excelToTimestamp($column[6])),
                                        'time'=>date('Y-m-d',Date::excelToTimestamp($column[6])).' '.Date::excelToDateTimeObject($column[7])->format('H:i:s'),
                                        'car_code'=>$column[10],
                                        'VIN'=>$column[11],
                                        'price'=>$column[12],
                                        'milage'=>$column[13],
                                        'giveaway'=>$column[14],
                                        'how_to_know'=>$column[15],
                                        'car_situation'=>$column[16],
                                        'notes'=>$column[17],
                                    ];
                                    /* 匯入車輛品牌型號 */
                                    $carType=explode(' ',$column[8]);
                                    $carTypeName = CarType::where('name',$carType[1])->first();
                                    if($carTypeName){
                                        $carDataArray['car_type']=$carTypeName->id;
                                    }else{
                                        $carTypeParent = CarType::where('name',$carType[0])->first();
                                        if($carTypeParent){
                                            $newCarType = CarType::create(['name'=>$carType[1],'parent_id'=>$carTypeParent->id]);
                                            $carDataArray['car_type']=$newCarType->id;
                                            ActionLog::create_log($newCarType,'create');
                                        }else{
                                            $newCarTypeParent = CarType::create(['name'=>$carType[0],'parent_id'=>0]);
                                            $newCarType = CarType::create(['name'=>$carType[1],'parent_id'=>$newCarTypeParent->id]);
                                            $carDataArray['car_type']=$newCarType->id;
                                            ActionLog::create_log($newCarType,'create');
                                        }
                                    }
                                    /* 匯入隔熱紙資料*/
                                    $carData = CarData::create($carDataArray);
                                    ActionLog::create_log($carData,'create');
                                    $carItemsColumnArray = explode(' ',$column[9]);
                                    foreach ($carItemsColumnArray as $ItemColumn){
                                        $Item = explode('-',$ItemColumn);
                                        $ItemDataArray = ['car_data_id'=>$carData->id,'location'=>$Item[0],'paper_type'=>$Item[1]];
                                        $carItems = CarItems::create($ItemDataArray);
                                        ActionLog::create_log($carItems,'create');
                                    }
                                }else{
                                    $errorData = [
                                        'row' => $rows,
                                        'content' => $checkValue['content'],
                                    ];
                                }
                            }
                        }
                    }
                    break;
                case 2:
                    foreach ($excel as $key => $sheets){ // 各個表分別撈出來
                        foreach ($sheets as $rows => $column){
                            if($rows>0){ //排除檔案標題欄位
                                $data[$key+$rows]['name']=$column[1];
                            }
                        }
                    }
                    break;
                case 3:
                    foreach ($excel as $key => $sheets){ // 各個表分別撈出來
                        foreach ($sheets as $rows => $column){
                            if($rows>0){ //排除檔案標題欄位
                                $data[$key+$rows]['phone']=$column[2];
                            }
                        }
                    }
                    break;
                case 4:
                    foreach ($excel as $key => $sheets){ // 各個表分別撈出來
                        foreach ($sheets as $rows => $column){
                            if($rows>0){ //排除檔案標題欄位
                                $data[$key+$rows]['email']=$column[3];
                            }
                        }
                    }
                    break;
                case 5:
                    foreach ($excel as $key => $sheets){ // 各個表分別撈出來
                        foreach ($sheets as $rows => $column){
                            if($rows>0){ //排除檔案標題欄位
                                $data[$key+$rows]['email']=$column[3];
                            }
                        }
                    }
                    break;
                default:
                    break;
            }
            unlink(storage_path('app/temp/'.$path1));
            return redirect(route('admin.import-export.index',['import_data'=>$errorData]))->with('message', '檔案成功匯入!');
        }else{
            return redirect(route('admin.import-export.index'))->with('Errormessage','檔案匯出失敗!');
        }
    }
    public function export()
    {
        $data=[
            0=>[
                'name'=>'王小明',
                'phone'=>'0912345678',
                'email'=>'a@a.com',
            ],
            1=>[
                'name'=>'王中明',
                'phone'=>'0912876543',
                'email'=>'b@b.com',
            ],
            2=>[
                'name'=>'王大明',
                'phone'=>'0987654321',
                'email'=>'c@c.com',
            ],
        ];
        $title = '模擬匯出';

        $headings = [
            'name'=>"姓名",
            'phone'=>"電話",
            'email'=>"信箱",
        ];

        return Excel::download(new DemoExport($data,$title,$headings),'模擬匯出'.date('Y-m-d_H_i_s'). '.xls');
    }
//    public function sendmail(Request $request)
//    {
//        $data = [
//            'email'=>$request->get('mail'),
//            'subject'=>'測試發送信件主旨',
//            'for_title'=>'測試對象',
//            'msg'=>'測試發送信件內文!收到信表示功能目前正常，一切都好',
//            'cc'=>['sir3453715@gmail.com','hanhsu@beautifullife.global'],
//        ];
//        dispatch(new SendMailQueueJob($data));
//
//        return redirect(route('admin.import-export.index'))->with('message', '信件成功寄出!');
//    }
    public function checkImportValue($column=array(),$type='1'){
        $checkValue['result'] = true;
        switch ($type){
            case 1://隔熱紙
                if(!$column[0]){//姓名填寫
                    $checkValue['result'] = false;
                    $checkValue['content'] = '姓名沒有填寫';
                }
                if(!preg_match("/^09[0-9]{2}[0-9]{6}$/", str_replace('-','',$column[1]))){//手機格式
                    $checkValue['result'] = false;
                    $checkValue['content'] = '手機格式錯誤';
                }
                if(!preg_match("/^0[0-9]{9}$/", str_replace('-','',$column[1]))){//電話格式
                    $checkValue['result'] = false;
                    $checkValue['content'] = '聯絡電話格式錯誤';
                }
                if(!preg_match("/^[A-Z]{1}[1-2]{1}[0-9]{8}$/",$column[3])){//身分證格式
                    $checkValue['result'] = false;
                    $checkValue['content'] = '身分證格式錯誤';
                }
                if(!$column[9]){//項目填寫
                    $checkValue['result'] = false;
                    $checkValue['content'] = '沒有寫項目';
                }

                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;
            case 5:
                break;
            default:
                break;
        }
        return $checkValue;
    }
}
