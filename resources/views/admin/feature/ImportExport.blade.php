@extends('admin.layouts.app')

@section('admin-page-content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">顧客資料匯入</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首頁</a></li>
                        <li class="breadcrumb-item active">顧客資料匯入</li>
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
            <div class="card card-default color-palette-box">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col d-flex filter-form">
                            <form id="admin-form" class="col-12 filter admin-form" action="{{ route('admin.import-export.import') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="form-group mr-3 col-md-3">
                                        <label for="type">匯入檔案範例(excel)</label>
                                        <ul class="list-group">
                                            @foreach(config('data-presets.user_type') as $key => $value)
                                                <li class="list-group-item"><a href="#" target="_blank">{{$value}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="form-group mr-3 col-md-3">
                                        <label for="">匯入檔案</label>
                                        <input type="file" name="import" id="import" class="form-control-file form-required" >
                                    </div>
                                    <div class="form-group mr-3 col-md-3">
                                        <label for="type">匯入類型</label>
                                        <select name="type" id="type" class="form-control form-required">
                                            <option value="" >請選擇</option>
                                            @foreach(config('data-presets.user_type') as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-1">
                                        <label for="">動作</label>
                                        <button type="submit" class="form-control btn-success">送出</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            @if(is_array($import_data))
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">{{ '匯入結果' }}</div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>欄數</th>
                                        <th>結果</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($import_data as $data)
                                        <tr>
                                            <td>{{$data['row']}}</td>
                                            <td>{{$data['content']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
