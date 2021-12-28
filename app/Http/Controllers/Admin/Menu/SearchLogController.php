<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use App\Models\LoginLog;
use App\Models\SearchLog;
use Illuminate\Http\Request;

class SearchLogController extends Controller
{
    //
    public function index(Request $request)
    {
        $search_log = SearchLog::orderBy('created_at','desc')->paginate(25);
        return view('admin.setting.SearchLog',[
            'search_log'=>$search_log,
        ]);
    }
}
