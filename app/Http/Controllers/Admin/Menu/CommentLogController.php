<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use App\Models\UserCommentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLogController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'user_id'=>$request->get('user_id'),
            'type'=>$request->get('type'),
            'content'=>$request->get('content'),
            'dateTime'=>date('Y-m-d H:i:s'),
            'author'=>Auth::id(),
        ];
        $comment = UserCommentLog::create($data);
        ActionLog::create_log($comment,'create');

        return redirect(route('admin.user.edit',['user'=>$request->get('user_id')]))->with('message', '紀錄已新增!');
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
}
