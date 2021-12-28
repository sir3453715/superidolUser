<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use App\Models\LoginLog;
use Illuminate\Http\Request;

class WebLogController extends Controller
{
    //
    public function index(Request $request)
    {
        $action_log = ActionLog::orderBy('created_at','desc')->paginate(10);

        return view('admin.setting.webHistoryLog',[
            'action_log'=>$action_log,
        ]);
    }
}
