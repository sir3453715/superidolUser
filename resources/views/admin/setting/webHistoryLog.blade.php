@extends('admin.layouts.app')

{{--@section('title', 'System Status')--}}

@section('admin-page-content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">操作歷史紀錄</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首頁</a></li>
                        <li class="breadcrumb-item active">操作歷史紀錄</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>姓名</th>
                                <th>更動資料表</th>
                                <th>執行動作</th>
                                <th>更動項目</th>
                                <th>時間</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($action_log as $action)
                                <tr>
                                    <td>
                                        @if($action->user)
                                            <a href="{{route('admin.user.edit',['user'=>$action->user->id])}}" target="_blank">
                                                {{$action->user->name}}
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{$action->action_table}}</td>
                                    <td>{{$action->action}}</td>
                                    <td>
                                        <span class="dropright">
                                            <a data-toggle="dropdown" href="#">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-xl">
                                                <div>
                                                    <ul class="list-group">
                                                    @foreach(json_decode($action->change_column) as $key => $change_item )
                                                            <li class="list-group-item">{!! $key  !!} => {!! $change_item  !!}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </span>
                                    </td>
                                    <td>{{$action->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix row">
                        <div class="col">
                            {{ $action->appends(request()->except('page'))->links() }}
                        </div>
                        <div class="ml-auto mr-4">
                            <small>
                                第 {{$action->firstItem()}} 到 {{$action->lastItem()}} 筆 共 {{$action->total()}} 筆
                            </small>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection


@push('admin-app-scripts')
    <script type="text/javascript">
        $(document.body).on('click','.tab-item',function (){
            let $tab = $(this).attr('data-value');
            window.history.pushState('','','?tab='+$tab);
            $('.page-link').each((index, ele)=> {
                let $href = $(ele).attr('href');
                $(ele).attr('href',$href.replace('login-log','action-log'));
            });


        });
    </script>
@endpush
