@extends('admin.layouts.app')

{{--@section('title', 'System Status')--}}

@section('admin-page-content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User </li>
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
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-edit"></i>
                        Controller Bar
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col d-flex filter-form">
                            <form class="form-inline filter">
                                <div class="form-group mr-3">
                                    <label for="users-role">角色</label>
                                    <select name="type" id="users-role" class="form-control ml-3">
                                        <option value="0" selected="&quot;selected&quot;">全部</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">SiteManager</option>
                                        <option value="3">Vendor</option>
                                        <option value="4">Customer</option>
                                    </select>
                                </div>
                                <div class="form-group mr-3">
                                    <label for="">會員帳號</label>
                                    <input type="text" class="form-control ml-3" placeholder=".col-3">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control">篩選</button>
                                </div>
                            </form>
                            <div class="ml-auto">
                                <a href="https://meihao.express/adm/user/create"><button type="button" class="btn btn-primary">新增</button></a>
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
                                <th>Task</th>
                                <th>Progress</th>
                                <th style="width: 15%">Label</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Update software</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>
                                <td class="action">
                                    <a href="{{route('admin.user.edit',['user'=>1])}}" class="btn btn-sm btn-secondary">編輯</a>
                                    <button class="btn btn-sm btn-danger delete-product">刪除</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Clean database</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                                    </div>
                                </td>

                                <td class="action">
                                    <a href="{{route('admin.user.edit',['user'=>1])}}" class="btn btn-sm btn-secondary">編輯</a>
                                    <button class="btn btn-sm btn-danger delete-product">刪除</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Cron job running</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                                    </div>
                                </td>

                                <td class="action">
                                    <a href="{{route('admin.user.edit',['user'=>1])}}" class="btn btn-sm btn-secondary">編輯</a>
                                    <button class="btn btn-sm btn-danger delete-product">刪除</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Fix and squish bugs</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar bg-success" style="width: 90%"></div>
                                    </div>
                                </td>

                                <td class="action">
                                    <a href="{{route('admin.user.edit',['user'=>1])}}" class="btn btn-sm btn-secondary">編輯</a>
                                    <button class="btn btn-sm btn-danger delete-product">刪除</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection
