@extends('admin.layouts.app')

{{--@section('title', 'System Status')--}}

@section('admin-page-content')
    @inject('html', 'App\Presenters\Html\HtmlPresenter')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">建立隔熱紙紀錄 會員 : {{$user->name}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">首頁</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">顧客資料管理</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.user.edit',['user'=>$user->id])}}">會員:{{$user->name}}</a></li>
                        <li class="breadcrumb-item active">建立隔熱紙紀錄</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <form id="admin-form" class="admin-form" action="{{ route('admin.carData.store') }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
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
                                    <div class="form-group col-md-3">
                                        <label for="date">施工日期*</label>
                                        <input type="date" class="form-control form-required" name="date" id="date" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="time">來電時間*</label>
                                        <input type="time" class="form-control form-required" name="time" id="time">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="car_type">車輛品牌型號*</label>
                                        <select class="form-control select2" id="car_type" name="car_type">
                                            <option value="">請選擇</option>
                                            <option value="add-select2">找不到選項，自己新增</option>
                                            @foreach($carTypes as $carType)
                                                <optgroup label="{{$carType->name}}">
                                                    @foreach($carType->childrenType() as $children)
                                                        <option value="{{$children->id}}">{{$carType->name}} {{$children->name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="car_model">車型</label>
                                        <select class="form-control select2" id="car_model" name="car_model">
                                            <option value="">請選擇</option>
                                            <option value="add-select2">找不到選項，自己新增</option>
                                            @foreach($carModels as $carModel)
                                                <option value="{{$carModel->id}}">{{$carModel->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="VIN">車輛識別號碼</label>
                                        <input type="text" id="VIN" class="form-control" name="VIN">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="car_code">車牌號碼*</label>
                                        <input type="text" id="car_code" class="form-control form-required" name="car_code">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="milage">里程數</label>
                                        <input type="text" id="milage" class="form-control" name="milage">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="price">價格</label>
                                        <input type="text" id="price" class="form-control" name="price">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="giveaway">贈品</label>
                                        <textarea class="form-control" id="giveaway" name="giveaway" rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="how_to_know">如何得知超級名膜</label>
                                        <textarea class="form-control" id="how_to_know" name="how_to_know" rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="car_situation">車輛狀況</label>
                                        <textarea class="form-control" id="car_situation" name="car_situation" rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="notes">備註</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-header bg-white border-top border-bottom-0">
                                <h3 class="card-title">項目</h3>
                                <a href="javascript:void(0);" class="add-item btn btn-sm btn-outline-primary ml-5">
                                    增加項目 <i class="fa fa-plus-square-o"></i>
                                </a>
                            </div>
                            <div class="card-body" id="item-section">
                                <div class="form-group row border-bottom item_wrapper">
                                    <div class="form-group col-md-3">
                                        <label for="location">位置</label>
                                        <input type="text" class="form-control form-required" name="location[]" id="location" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="paper_type">隔熱紙型號</label>
                                        <input type="text" class="form-control form-required" name="paper_type[]" id="paper_type">
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


@push('admin-app-scripts')
    <script type="text/javascript">
        $('.add-item').click(function () {
            let itemHtml = $('#template-item').html();
            $('#item-section').append(itemHtml);
        });
        $("body").on("click",".delete-item",function () {
            let del_div = $(this).closest('.item_wrapper');
            del_div.remove();
        });
        $(".select2").on('select2:close', function() {
                var option = $(this),
                    model = option.closest('.select2').attr('id'),
                    text = '';
                if (model === 'car_type'){
                    text = '請輸入新廠牌與型號 (格式為: "廠牌 型號"):';
                }else if (model === 'car_model'){
                    text = '請輸入新車型:';
                }
                if(option.val()==="add-select2") {
                    var newval = prompt(text);
                    if(newval !== null) {
                        $.ajax({
                            type:"POST",
                            url:"/setNewCarData",
                            dataType:"json",
                            data:{
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'model': model,
                                'value': newval,
                            },success:function(object){
                                if(object['result'] === true) {
                                    alert('新增成功!');
                                    option.append('<option value="'+object['id']+'">' + newval + '</option>')
                                        .val(object['id']);
                                }else{
                                    alert(object['content']);
                                    option.val('');
                                }
                            }
                        });
                    }
                }
            });

    </script>

    <script type="text/template" id="template-item">
        <div class="form-group row border-bottom item_wrapper">
            <div class="form-group col-md-3">
                <label for="location">位置</label>
                <input type="text" class="form-control form-required" name="location[]" id="location" >
            </div>
            <div class="form-group col-md-3">
                <label for="paper_type">隔熱紙型號</label>
                <input type="text" class="form-control form-required" name="paper_type[]" id="paper_type">
            </div>
            <div class="form-group col-md-3">
                <button type="button" class="btn btn-sm btn-outline-danger delete-item">刪除</button>
            </div>
        </div>
    </script>
@endpush
