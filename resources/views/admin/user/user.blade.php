@extends('admin.layouts.app')

@section('admin-page-content')
    @inject('html', 'App\Presenters\Html\HtmlPresenter')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">顧客資料管理</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首頁</a></li>
                        <li class="breadcrumb-item active">顧客資料管理</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col d-flex filter-form">
                            <form class="form-inline filter">
                                <div class="form-group mr-3">
                                    <label for="users-role">角色</label>
                                    <select name="role" id="users-role" class="form-control ml-3">
                                        <option value="" >全部</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" {{(isset($queried['role']) && $queried['role']==$role->id )?'selected':''}}>{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mr-3">
                                    <label for="">信箱</label>
                                    <input type="text" name="email" class="form-control ml-3" placeholder="姓名、信箱、電話、身分證字號" value="{{(isset($queried['keyword'])?$queried['keyword']:'')}}">
                                </div>
                                <div class="form-group mr-3 ">
                                    <label for="type">顧客類型</label>
                                    <select name="type" id="type" class="form-control ml-3">
                                        <option value="" >請選擇</option>
                                        @foreach(config('data-presets.user_type') as $key => $value)
                                            <option value="{{$key}}" {!! $html->selectSelected($key, $queried['type']) !!}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control">篩選</button>
                                </div>
                            </form>
                            <div class="ml-auto">
                                <a href="{{route('admin.user.create')}}"><button type="button" class="btn btn-primary">新增</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- Main row -->
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>姓名</th>
                                <th>電子信箱</th>
                                <th>顧客類型</th>
                                <th>角色權限</th>
                                <th style="width: 15%">動作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>
                                            <a href="{{route('admin.user.edit',['user'=>$user->id])}}">{{$user->name}}</a>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @foreach(config('data-presets.user_type') as $key => $value)
                                                @if(in_array($key,explode(',',$user->type)))
                                                    <span class="badge bg-secondary fa-1x">{{$value}}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $user->roles->first()->display_name }}</td>
                                        <td class="action form-inline">
                                            <a href="{{route('admin.user.edit',['user'=>$user->id])}}" class="btn btn-sm btn-secondary mr-1">修改</a>
                                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('administrator')||\Illuminate\Support\Facades\Auth::user()->hasRole('manager'))
                                            <form action="{{ route('admin.user.destroy', ['user' => $user->id]) }}" method="post" class="form-btn">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger delete-confirm">刪除</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix row">
                        <div class="col">
                            {{ $users->appends(request()->except('page'))->links() }}
                        </div>
                        <div class="ml-auto mr-4">
                            <small>
                                第 {{$users->firstItem()}} 到 {{$users->lastItem()}} 筆 共 {{$users->total()}} 筆
                            </small>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection

