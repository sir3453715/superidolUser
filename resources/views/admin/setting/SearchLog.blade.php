@extends('admin.layouts.app')

{{--@section('title', 'System Status')--}}

@section('admin-page-content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">搜尋紀錄</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首頁</a></li>
                        <li class="breadcrumb-item active">搜尋紀錄 </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>姓名</th>
                                <th>IP</th>
                                <th>搜尋關鍵字</th>
                                <th>時間</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($search_log as $search)
                                <tr>
                                    <td>
                                        @if($search->user)
                                            <a href="{{route('admin.user.edit',['user'=>$search->user->id])}}" target="_blank">
                                                {{$search->user->name}}
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{$search->IP}}</td>
                                    <td>{{$search->keyword}}</td>
                                    <td>{{$search->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $search_log->appends(request()->except('page'))->links() }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection

