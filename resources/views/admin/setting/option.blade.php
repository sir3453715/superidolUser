@extends('admin.layouts.app')

{{--@section('title', 'System Status')--}}

@section('admin-page-content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">設定修改</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首頁</a></li>
                        <li class="breadcrumb-item active">設定修改</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form id="admin-edit-form" class="admin-form" action="{{ route('admin.option.store') }}" method="post">
    @csrf
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">一般設定</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @inject('html', 'App\Presenters\Admin\OptionFormFieldsPresenter')
                            {!! $html->render() !!}
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
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
@endsection
