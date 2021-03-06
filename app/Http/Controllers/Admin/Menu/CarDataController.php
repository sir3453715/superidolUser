<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use App\Models\CarData;
use App\Models\CarItems;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\User;
use Illuminate\Http\Request;

class CarDataController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::find($request->get('user'));
        $carTypes = CarType::where('parent_id',0)->get();
        $carModels = CarModel::all();

        return view('admin.carData.createCarData',[
            'user'=>$user,
            'carTypes'=>$carTypes,
            'carModels'=>$carModels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
              "user_id" => $request->get('user_id'),
              "date" => $request->get('date'),
              "time" => $request->get('date').' '.$request->get('time').':00',
              "car_type" => $request->get('car_type'),
              "car_model" => $request->get('car_model'),
              "VIN" => $request->get('VIN'),
              "car_code" => $request->get('car_code'),
              "milage" => $request->get('milage'),
              "price" => $request->get('price'),
              "giveaway" => $request->get('giveaway'),
              "how_to_know" => $request->get('how_to_know'),
              "car_situation" => $request->get('car_situation'),
              "notes" => $request->get('notes'),
        ];
        $carData = CarData::create($data);
        ActionLog::create_log($carData,'create');

        foreach ($request->get('location') as $key => $value){
            $item=[
                "car_data_id" => $carData->id,
                "location" => $request->get('location')[$key],
                "paper_type" => $request->get('paper_type')[$key],
            ];
            $carItem = CarItems::create($item);
            ActionLog::create_log($carItem,'create');
        }

        return redirect(route('admin.user.edit',['user'=>$request->get('user_id')]))->with('message', '????????????????????????!');
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

        $carData = CarData::find($id);
        $user = $carData->user;
        $carTypes = CarType::where('parent_id',0)->get();
        $carModels = CarModel::all();

        return view('admin.carData.editCarData',[
            'user'=>$user,
            'carData'=>$carData,
            'carTypes'=>$carTypes,
            'carModels'=>$carModels,
        ]);
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
        $carData = CarData::find($id);
        $data=[
            "date" => $request->get('date'),
            "time" => $request->get('date').' '.$request->get('time').':00',
            "car_type" => $request->get('car_type'),
            "car_model" => $request->get('car_model'),
            "VIN" => $request->get('VIN'),
            "car_code" => $request->get('car_code'),
            "milage" => $request->get('milage'),
            "price" => $request->get('price'),
            "giveaway" => $request->get('giveaway'),
            "how_to_know" => $request->get('how_to_know'),
            "car_situation" => $request->get('car_situation'),
            "notes" => $request->get('notes'),
        ];
        $carData->fill($data);
        ActionLog::create_log($carData);
        $carData->save();
        $oldCarItems = CarItems::where('car_data_id',$id);
        if($oldCarItems){
            foreach ($oldCarItems->get() as $oldCarItem){
                ActionLog::create_log($oldCarItem,'delete');
            }
            $oldCarItems->delete();
        }

        foreach ($request->get('location') as $key => $value){
            $item=[
                "car_data_id" => $id,
                "location" => $request->get('location')[$key],
                "paper_type" => $request->get('paper_type')[$key],
            ];
            $carItem = CarItems::create($item);
            ActionLog::create_log($carItem,'create');
        }

        return redirect(route('admin.user.edit',['user'=>$carData->user_id]))->with('message', '????????????????????????!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carData = CarData::find($id);
        $oldCarItems = CarItems::where('car_data_id',$id);
        if($oldCarItems){
            foreach ($oldCarItems->get() as $oldCarItem){
                ActionLog::create_log($oldCarItem,'delete');
            }
            $oldCarItems->delete();
        }
        if ($carData){
            ActionLog::create_log($carData,'delete');
            $carData->delete();
        }
        return redirect(route('admin.user.edit',['user'=>$carData->user_id]))->with('message', '????????????????????????!');
    }
    public function setNewCarData(Request $request){
        $model = $request->get('model');
        $value = $request->get('value');
        $result = ['id'=>'','result'=>false,'content'=>'???????????????????????????????????????!'];

        if ($model == 'car_type'){
            /* ???????????????????????? */
            $carType=explode(' ',$value);

            if (sizeof($carType)==2){
                $carTypeName = CarType::where('name',$carType[1])->first();
                if($carTypeName){
                    $result['id']=$carTypeName->id;
                }else{
                    $carTypeParent = CarType::where('name',$carType[0])->first();
                    if($carTypeParent){
                        $newCarType = CarType::create(['name'=>$carType[1],'parent_id'=>$carTypeParent->id]);
                        $result['id']=$newCarType->id;
                        ActionLog::create_log($newCarType,'create');
                    }else{
                        $newCarTypeParent = CarType::create(['name'=>$carType[0],'parent_id'=>0]);
                        $newCarType = CarType::create(['name'=>$carType[1],'parent_id'=>$newCarTypeParent->id]);
                        $result['id']=$newCarType->id;
                        ActionLog::create_log($newCarType,'create');
                    }
                }
                $result['result']=true;
            }else{
                $result['content']='????????????!';
            }
        }elseif($model == 'car_model'){
            $carModelName = CarModel::where('name',$value)->first();
            if($carModelName){
                $result['id']=$carModelName->id;
            }else{
                $newCarModel = CarModel::create(['name'=>$value]);
                $result['id']=$newCarModel->id;
                ActionLog::create_log($newCarModel,'create');
            }
            $result['result']=true;
        }

        return json_encode($result, true);


    }
}
