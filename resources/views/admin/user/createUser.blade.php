@extends('admin.layouts.app')

{{--@section('title', 'System Status')--}}

@section('admin-page-content')
    @inject('html', 'App\Presenters\Html\HtmlPresenter')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">建立顧客</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首頁</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">顧客資料管理</a></li>
                        <li class="breadcrumb-item active">建立顧客</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form id="admin-form" class="admin-form" action="{{ route('admin.user.store') }}" method="post">
        @csrf
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-10">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">基本資料</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="form-group col-md-4">
                                        <label for="name">姓名</label>
                                        <input type="text" class="form-control form-required" name="name" id="name" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone">電話</label>
                                        <input type="text" class="form-control form-required" name="phone" id="phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="ID_number">身份證字號</label>
                                        <input type="text" class="form-control" name="ID_number" id="ID_number">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email">電子信箱</label>
                                        <input type="email" class="form-control form-required" name="email" id="email" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="field-name" for="ja-password">密碼</label>
                                        <button type="button" class="random-password btn btn-sm btn-outline-secondary" title="產生密碼"><i class="fas fa-random"></i></button>
                                        <button type="button" class="view-password btn btn-sm btn-outline-secondary" title="檢視/隱藏"><i class="fas fa-eye"></i></button>
                                        <input type="password" id="password" class="form-control form-required" name="password" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="field-name" for="re-password">請再次輸入密碼</label>
                                        <input type="password" id="re-password" class="form-control form-required" name="re_password" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone">生日</label>
                                        <input type="date" class="form-control" name="birthday" id="birthday" >
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="type">顧客類型</label>
                                        <select class="form-control select2 form-required" id="type" name="type[]" multiple>
                                            @foreach(config('data-presets.user_type') as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sex">性別</label>
                                        <select class="form-control" id="sex" name="sex" >
                                            <option value="">請選擇</option>
                                            <option value="1">男</option>
                                            <option value="2">女</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="address">地址</label>
                                        <input type="text" class="form-control" name="address" id="address">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <div class="col-md-2">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">動作</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">角色</label>
                                    <select name="users_role" id="users-role" class="form-control select2">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" >{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">送出</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
