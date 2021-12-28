@extends('admin.layouts.app')

@section('admin-page-content')
    @inject('html', 'App\Presenters\Html\HtmlPresenter')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">修改顧客 {{ $user->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首頁</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">顧客資料管理</a></li>
                        <li class="breadcrumb-item active">修改</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form id="admin-form" class="admin-form" action="{{ route('admin.user.update',['user'=>$user->id]) }}" method="post">
        @csrf
        @method('PUT')
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
                            <div class="card-body pb-5">
                                <div class="form-group row">
                                    <div class="form-group col-md-4">
                                        <label for="name">姓名</label>
                                        <input type="text" class="form-control form-required" name="name" id="name" value="{{$user->name}}" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email">電子郵件</label>
                                        <input type="text" class="form-control form-required" name="email" id="email" value="{{$user->email}}" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="field-name" for="ja-password">密碼</label>
                                        <button type="button" class="random-password btn btn-sm btn-outline-secondary" title="產生密碼"><i class="fas fa-random"></i></button>
                                        <button type="button" class="view-password btn btn-sm btn-outline-secondary" title="檢視/隱藏"><i class="fas fa-eye"></i></button>
                                        @if($user) <small><label class="help-label"><input type="checkbox" name="change_password" value="1"> 若要修改密碼請打勾</label></small> @endif
                                        <input type="password" id="password" class="form-control" name="password" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="ID_number">身份證字號</label>
                                        <input type="text" class="form-control" name="ID_number" id="ID_number" value="{{$user->ID_number}}" >
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="type">顧客類型</label>
                                        <select class="form-control select2" id="type" name="type[]" multiple>
                                            @foreach(config('data-presets.user_type') as $key => $value)
                                                    <option value="{{$key}}" {{ in_array($key,explode(',',$user->type))?'selected':'' }}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone">電話</label>
                                        <input type="text" class="form-control form-required" name="phone" id="phone" value="{{$user->phone}}" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone">生日</label>
                                        <input type="date" class="form-control" name="birthday" id="birthday" value="{{$user->birthday}}" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sex">性別</label>
                                        <select class="form-control" id="sex" name="sex" >
                                            <option value="">請選擇</option>
                                            <option value="1" {!! $html->selectSelected(1, $user->sex) !!}>男</option>
                                            <option value="2" {!! $html->selectSelected(2, $user->sex) !!}>女</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="address">地址</label>
                                        <input type="text" class="form-control" name="address" id="address" value="{{$user->address}}" >
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
                                    <select name="users_role" id="users_role" class="form-control select2">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" {!! $html->selectSelected($role->id, $user_roles) !!}>{{$role->display_name}}</option>
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
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h3 class="card-title">顧客資料</h3>
                            </div>
                            <!-- ./row -->
                            <div class="card-header p-0 pl-1 pt-2">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link tab-item active" id="type-car-tab" data-toggle="pill" data-type="1" href="#type-car" role="tab" aria-controls="type-car" aria-selected="true">超級名膜隔熱紙</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab-item" id="type-coffee-tab" data-toggle="pill" data-type="2" href="#type-coffee" role="tab" aria-controls="type-coffee" aria-selected="false">磨滴咖啡</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab-item" id="type-design-tab" data-toggle="pill" data-type="3" href="#type-design" role="tab" aria-controls="type-design" aria-selected="false">家傳室內設計</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab-item" id="type-pretty-tab" data-toggle="pill" data-type="4" href="#type-pretty" role="tab" aria-controls="type-pretty" aria-selected="false">白潤美</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab-item" id="type-house-tab" data-toggle="pill" data-type="5" href="#type-house" role="tab" aria-controls="type-house" aria-selected="false">房地產</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content col-12" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade active show" id="type-car" role="tabpanel" aria-labelledby="type-car-tab">
                                        <div class="form-group row">
                                            <div class="form-group col-md-9 navbar-nav-scroll">
                                                <a href="{{route('admin.carData.create',['user'=>$user->id])}}"><button type="button" class="btn btn-outline-primary">新增-超級名膜隔熱紙資料</button></a>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>施工日期</th>
                                                        <th>進廠時間</th>
                                                        <th>車輛品牌型號</th>
                                                        <th>車牌號碼</th>
                                                        <th>車型</th>
                                                        <th>價格</th>
                                                        <th class="none">車輛識別號碼</th>
                                                        <th class="none">里程數</th>
                                                        <th class="none">贈品</th>
                                                        <th class="none">如何得知超級名模</th>
                                                        <th class="none">車輛狀況</th>
                                                        <th class="none">備註</th>
                                                        <th class="none">施工項目</th>
                                                        <th class="none">動作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($carDatas as $carData)
                                                            <tr>
                                                                <td>{{$carData->date}}</td>
                                                                <td>{{ date('H:i', strtotime($carData->time)) }}</td>
                                                                <td>{{ $carData->CarType() }}</td>
                                                                <td>{{ $carData->car_code }}</td>
                                                                <td>{{ $carData->CarModel->name }}</td>
                                                                <td>{{ $carData->price }}</td>
                                                                <td>{{ $carData->VIN }}</td>
                                                                <td>{{ $carData->milage }}</td>
                                                                <td>{{ $carData->giveaway }}</td>
                                                                <td>{{ $carData->how_to_know }}</td>
                                                                <td>{{ $carData->car_situation }}</td>
                                                                <td>{{ $carData->notes }}</td>
                                                                <td>
                                                                    <ul>
                                                                        @foreach($carData->CarItems as $items)
                                                                            <li>位置: {{$items->location}} / 隔熱紙: {{$items->paper_type}}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
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
                                            <div class="form-group col-md-3 border-left">
                                                <div class="form-group col-12  pre-scrollable border-bottom">
                                                    <div class="card-header">
                                                        <h3 class="card-title">相關紀錄</h3>
                                                    </div>
                                                    @foreach($user->CommentLog->where('type','1') as $comment)
                                                        <div class="card-body bg-gray-light border rounded border-white mb-1 pb-1">
                                                            <span>{{$comment->content}}</span>
                                                            <small class="d-block text-right">By {{$comment->authorData->name}} {{$comment->dateTime}}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group col-12 pt-5">
                                                    <form id="admin-form" class="admin-form" action="{{ route('admin.comment.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <input type="hidden" name="type" value="1">
                                                        <div class="card-header">
                                                            <h3 class="card-title">新增紀錄</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="comment">內容</label>
                                                                <textarea name="comment" rows="4" id="comment" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn btn-success">送出</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade " id="type-coffee" role="tabpanel" aria-labelledby="type-coffee-tab">
                                        <div class="form-group row">
                                            <div class="form-group col-md-9 navbar-nav-scroll">
                                                <a href="{{route('admin.user.create')}}"><button type="button" class="btn btn-outline-primary">新增-磨滴咖啡資料</button></a>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>施工日期</th>
                                                        <th>進廠時間</th>
                                                        <th>車輛品牌型號</th>
                                                        <th>車型</th>
                                                        <th>車牌號碼</th>
                                                        <th>價格</th>
                                                        <th class="none">車輛識別號碼</th>
                                                        <th class="none">里程數</th>
                                                        <th class="none">贈品</th>
                                                        <th class="none">如何得知超級名模</th>
                                                        <th class="none">車輛狀況</th>
                                                        <th class="none">備註</th>
                                                        <th class="none">施工項目</th>
                                                        <th class="none">動作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for($i = 1; $i<=20;$i++)
                                                        <tr>
                                                            <td>2021/12/20</td>
                                                            <td>13:20</td>
                                                            <td>BMW E300</td>
                                                            <td>轎車</td>
                                                            <td>BMW-0758</td>
                                                            <td>22000</td>
                                                            <td>WDDGF54X49F235308</td>
                                                            <td>400</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td>正常</td>
                                                            <td>來店客 刷卡</td>
                                                            <td>
                                                                <ul>
                                                                    <li>位置: 前檔 / 隔熱紙: V30</li>
                                                                    <li>位置: 車身 / 隔熱紙: WW10</li>
                                                                    <li>位置: 天窗 / 隔熱紙: X68</li>
                                                                </ul>
                                                            </td>
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
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group col-md-3 border-left">
                                                <div class="form-group col-12  pre-scrollable border-bottom">
                                                    <div class="card-header">
                                                        <h3 class="card-title">相關紀錄</h3>
                                                    </div>
                                                    @foreach($user->CommentLog->where('type','2') as $comment)
                                                        <div class="card-body bg-gray-light border rounded border-white mb-1 pb-1">
                                                            <span>{{$comment->content}}</span>
                                                            <small class="d-block text-right">By {{$comment->authorData->name}} {{$comment->dateTime}}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group col-12 pt-5">
                                                    <form id="admin-form" class="admin-form" action="{{ route('admin.comment.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <input type="hidden" name="type" value="2">
                                                        <div class="card-header">
                                                            <h3 class="card-title">新增紀錄</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="comment">內容</label>
                                                                <textarea name="comment" rows="4" id="comment" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn btn-success">送出</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade " id="type-design" role="tabpanel" aria-labelledby="type-design-tab">
                                        <div class="form-group row">
                                            <div class="form-group col-md-9 navbar-nav-scroll">
                                                <a href="{{route('admin.user.create')}}"><button type="button" class="btn btn-outline-primary">新增-家傳室內設計資料</button></a>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>施工日期</th>
                                                        <th>進廠時間</th>
                                                        <th>車輛品牌型號</th>
                                                        <th>車型</th>
                                                        <th>車牌號碼</th>
                                                        <th>價格</th>
                                                        <th class="none">車輛識別號碼</th>
                                                        <th class="none">里程數</th>
                                                        <th class="none">贈品</th>
                                                        <th class="none">如何得知超級名模</th>
                                                        <th class="none">車輛狀況</th>
                                                        <th class="none">備註</th>
                                                        <th class="none">施工項目</th>
                                                        <th class="none">動作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for($i = 1; $i<=20;$i++)
                                                        <tr>
                                                            <td>2021/12/20</td>
                                                            <td>13:20</td>
                                                            <td>BMW E300</td>
                                                            <td>轎車</td>
                                                            <td>BMW-0758</td>
                                                            <td>22000</td>
                                                            <td>WDDGF54X49F235308</td>
                                                            <td>400</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td>正常</td>
                                                            <td>來店客 刷卡</td>
                                                            <td>
                                                                <ul>
                                                                    <li>位置: 前檔 / 隔熱紙: V30</li>
                                                                    <li>位置: 車身 / 隔熱紙: WW10</li>
                                                                    <li>位置: 天窗 / 隔熱紙: X68</li>
                                                                </ul>
                                                            </td>
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
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="form-group col-md-3 border-left">
                                                <div class="form-group col-12  pre-scrollable border-bottom">
                                                    <div class="card-header">
                                                        <h3 class="card-title">相關紀錄</h3>
                                                    </div>
                                                    @foreach($user->CommentLog->where('type','3') as $comment)
                                                        <div class="card-body bg-gray-light border rounded border-white mb-1 pb-1">
                                                            <span>{{$comment->content}}</span>
                                                            <small class="d-block text-right">By {{$comment->authorData->name}} {{$comment->dateTime}}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group col-12 pt-5">
                                                    <form id="admin-form" class="admin-form" action="{{ route('admin.comment.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <input type="hidden" name="type" value="3">
                                                        <div class="card-header">
                                                            <h3 class="card-title">新增紀錄</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="comment">內容</label>
                                                                <textarea name="comment" rows="4" id="comment" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn btn-success">送出</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade " id="type-pretty" role="tabpanel" aria-labelledby="type-pretty-tab">
                                        <div class="form-group row">
                                            <div class="form-group col-md-9 navbar-nav-scroll">
                                                <a href="{{route('admin.user.create')}}"><button type="button" class="btn btn-outline-primary">新增-白潤美資料</button></a>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>施工日期</th>
                                                        <th>進廠時間</th>
                                                        <th>車輛品牌型號</th>
                                                        <th>車型</th>
                                                        <th>車牌號碼</th>
                                                        <th>價格</th>
                                                        <th class="none">車輛識別號碼</th>
                                                        <th class="none">里程數</th>
                                                        <th class="none">贈品</th>
                                                        <th class="none">如何得知超級名模</th>
                                                        <th class="none">車輛狀況</th>
                                                        <th class="none">備註</th>
                                                        <th class="none">施工項目</th>
                                                        <th class="none">動作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for($i = 1; $i<=20;$i++)
                                                        <tr>
                                                            <td>2021/12/20</td>
                                                            <td>13:20</td>
                                                            <td>BMW E300</td>
                                                            <td>轎車</td>
                                                            <td>BMW-0758</td>
                                                            <td>22000</td>
                                                            <td>WDDGF54X49F235308</td>
                                                            <td>400</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td>正常</td>
                                                            <td>來店客 刷卡</td>
                                                            <td>
                                                                <ul>
                                                                    <li>位置: 前檔 / 隔熱紙: V30</li>
                                                                    <li>位置: 車身 / 隔熱紙: WW10</li>
                                                                    <li>位置: 天窗 / 隔熱紙: X68</li>
                                                                </ul>
                                                            </td>
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
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group col-md-3 border-left">
                                                <div class="form-group col-12  pre-scrollable border-bottom">
                                                    <div class="card-header">
                                                        <h3 class="card-title">相關紀錄</h3>
                                                    </div>
                                                    @foreach($user->CommentLog->where('type','4') as $comment)
                                                        <div class="card-body bg-gray-light border rounded border-white mb-1 pb-1">
                                                            <span>{{$comment->content}}</span>
                                                            <small class="d-block text-right">By {{$comment->authorData->name}} {{$comment->dateTime}}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group col-12 pt-5">
                                                    <form id="admin-form" class="admin-form" action="{{ route('admin.comment.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <input type="hidden" name="type" value="4">
                                                        <div class="card-header">
                                                            <h3 class="card-title">新增紀錄</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="comment">內容</label>
                                                                <textarea name="comment" rows="4" id="content" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn btn-success">送出</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade " id="type-house" role="tabpanel" aria-labelledby="type-house-tab">
                                        <div class="form-group row">
                                            <div class="form-group col-md-9 navbar-nav-scroll">
                                                <a href="{{route('admin.user.create')}}"><button type="button" class="btn btn-outline-primary">新增-房地產資料</button></a>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>施工日期</th>
                                                        <th>進廠時間</th>
                                                        <th>車輛品牌型號</th>
                                                        <th>車型</th>
                                                        <th>車牌號碼</th>
                                                        <th>價格</th>
                                                        <th class="none">車輛識別號碼</th>
                                                        <th class="none">里程數</th>
                                                        <th class="none">贈品</th>
                                                        <th class="none">如何得知超級名模</th>
                                                        <th class="none">車輛狀況</th>
                                                        <th class="none">備註</th>
                                                        <th class="none">施工項目</th>
                                                        <th class="none">動作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for($i = 1; $i<=20;$i++)
                                                        <tr>
                                                            <td>2021/12/20</td>
                                                            <td>13:20</td>
                                                            <td>BMW E300</td>
                                                            <td>轎車</td>
                                                            <td>BMW-0758</td>
                                                            <td>22000</td>
                                                            <td>WDDGF54X49F235308</td>
                                                            <td>400</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td>正常</td>
                                                            <td>來店客 刷卡</td>
                                                            <td>
                                                                <ul>
                                                                    <li>位置: 前檔 / 隔熱紙: V30</li>
                                                                    <li>位置: 車身 / 隔熱紙: WW10</li>
                                                                    <li>位置: 天窗 / 隔熱紙: X68</li>
                                                                </ul>
                                                            </td>
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
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group col-md-3 border-left">
                                                <div class="form-group col-12  pre-scrollable border-bottom">
                                                    <div class="card-header">
                                                        <h3 class="card-title">相關紀錄</h3>
                                                    </div>
                                                    @foreach($user->CommentLog->where('type','5') as $comment)
                                                        <div class="card-body bg-gray-light border rounded border-white mb-1 pb-1">
                                                            <span>{{$comment->content}}</span>
                                                            <small class="d-block text-right">By {{$comment->authorData->name}} {{$comment->dateTime}}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group col-12 pt-5">
                                                    <form id="admin-form" class="admin-form" action="{{ route('admin.comment.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <input type="hidden" name="type" value="4">
                                                        <div class="card-header">
                                                            <h3 class="card-title">新增紀錄</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="comment">內容</label>
                                                                <textarea name="comment" rows="4" id="content" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn btn-success">送出</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

@endsection

