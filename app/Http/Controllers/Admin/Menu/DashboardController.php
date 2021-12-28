<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\SearchLog;
use App\Models\User;
use App\Models\UserVersion;
use Facebook\Facebook;
use Facebook\FacebookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    /**
     * index
     */
    function index(Request $request){
        $queried=[
            'type'=>'',
            'keyword'=>'',
        ];

        if($request->get('keyword')) {
            $type_array = ['customer','member','manager','administrator'];
            $users = User::role($type_array);
            if($request->get('type')) {
                $queried['type'] = $request->get('type');
                $users = $users->where('type','LIKE','%'.$request->get('type').'%');
            }
            $queried['keyword'] = $request->get('keyword');
            $user_ids = UserVersion::where('value','LIKE','%'.$queried['keyword'].'%')->groupBy('user_id')->pluck('user_id')->toArray();
            $users = $users->where(function ($query) use ($queried,$user_ids){
                $query->orwhere('name','LIKE','%'.$queried['keyword'].'%');
                $query->orwhere('email','LIKE','%'.$queried['keyword'].'%');
                $query->orwhere('phone','LIKE','%'.$queried['keyword'].'%');
                $query->orwhere('ID_number','LIKE','%'.$queried['keyword'].'%');
                $query->orwhereIn('id',$user_ids);
            });
            $users = $users->paginate(20);

            $data = [
                'user_id'=>Auth::id(),
                'IP'=>$request->getClientIp(),
                'keyword'=>$request->get('keyword'),
            ];
            SearchLog::create($data);
        }else{
            $users =  User::where('id',0)->paginate(20);
        }

        return view('admin.dashboard.dashboard',[
            'users'=>$users,
            'queried' => $queried,
        ]);

    }

}
