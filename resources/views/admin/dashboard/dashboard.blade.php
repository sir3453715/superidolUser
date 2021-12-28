@extends('admin.layouts.app')

{{--@section('title', 'System Status')--}}

@section('admin-page-content')
    @inject('html', 'App\Presenters\Html\HtmlPresenter')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">主控台</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">首頁 </li>
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
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col d-flex filter-form">
                            <form id="admin-form" class="col-12 filter">
                                <div class="form-group row">
                                    <div class="form-group mr-3 col-md-6">
                                        <label for="">關鍵字</label>
                                        <input type="text" name="keyword" class="form-control form-required" placeholder="請輸入關鍵字 如:姓名、信箱、電話、身分證字號" value="{{(isset($queried['keyword'])?$queried['keyword']:'')}}">
                                    </div>
                                    <div class="form-group mr-3 col-md-3">
                                        <label for="type">顧客類型</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="" >請選擇</option>
                                            @foreach(config('data-presets.user_type') as $key => $value)
                                                <option value="{{$key}}" {!! $html->selectSelected($key, $queried['type']) !!}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-1">
                                        <label for="">動作</label>
                                        <button type="submit" class="form-control">篩選</button>
                                    </div>
                                </div>
                            </form>
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
                                <th>電話</th>
                                <th>顧客類型</th>
                                <th>電子信箱</th>
                                <th style="width: 15%">動作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @foreach(config('data-presets.user_type') as $key => $value)
                                            @if(in_array($key,explode(',',$user->type)))
                                                <span class="badge bg-secondary fa-1x">{{$value}}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td class="action form-inline">
                                        <a href="{{route('admin.user.edit',['user'=>$user->id])}}" class="btn btn-sm btn-secondary mr-1">修改</a>
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
