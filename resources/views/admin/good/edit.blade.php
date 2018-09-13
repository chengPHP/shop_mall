@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('good'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>修改商品信息</h5>
                        <a style="position: absolute;right: 30px;top: 8px;" class="btn btn-outline btn-default" title="返回" href="{{url('admin/good')}}" ><i class="fa fa-mail-reply" ></i> 返回</a>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('admin/good')}}/{{$info->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row" >
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label">商品名称<span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <input id="name" type="text" name="name" value="{{$info->name}}" disabled class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="category_id" class="col-sm-4 control-label">商品类别<span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="category_id" class="form-control m-b select2" disabled name="category_id">
                                                {!! category_select(1, 0, $info->category_id) !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="sn" class="col-sm-4 control-label">商品编号<span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <input id="sn" type="text" name="sn" value="{{$info->sn}}" disabled class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="brand_id" class="col-sm-4 control-label">商品品牌<span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="brand_id" class="form-control m-b select2" name="brand_id" disabled>
                                                {!! brand_select(1,0,$info->brand_id) !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="keywords" class="col-sm-4 control-label">商品关键字</label>
                                        <div class="col-sm-8">
                                            <input id="keywords" type="text" name="keywords" value="{{$info->keywords}}" disabled placeholder="商品关键字" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="brief" class="col-sm-4 control-label">简短描述</label>
                                        <div class="col-sm-8">
                                            <input id="brief" type="text" name="brief" value="{{$info->brief}}" disabled placeholder="简短描述" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="weight" class="col-sm-4 control-label">商品重量</label>
                                        <div class="col-sm-8">
                                            <input id="weight" type="text" name="weight" value="{{$info->weight}}" disabled placeholder="商品重量" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="give_integral" class="col-sm-4 control-label">赠送积分</label>
                                        <div class="col-sm-8">
                                            <input id="give_integral" type="text" name="give_integral" value="{{$info->give_integral}}" disabled placeholder="赠送积分数量" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="storage_time" class="col-sm-4 control-label">入库时间</label>
                                        <div class="col-sm-8">
                                            <input id="plan_start_time" type="text" name="storage_time" placeholder="入库时间" value="{{$info->storage_time}}" disabled data-error-container="#error-block" class="form-control jeinput" data-date-date = "0d">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">是否实物</label>
                                        <div class="col-sm-9">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_real" disabled {{$info->is_real==1?'checked':''}}>
                                                <label for="inlineRadio1">是 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_real" disabled {{$info->is_real==0?'checked':''}}>
                                                <label for="inlineRadio2">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">是否精品</label>
                                        <div class="col-sm-9">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_best" disabled {{$info->is_best==1?'checked':''}}>
                                                <label for="inlineRadio1">是 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_best" disabled {{$info->is_best==0?'checked':''}}>
                                                <label for="inlineRadio2">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">是否新品</label>
                                        <div class="col-sm-9">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_new" disabled {{$info->is_new==1?'checked':''}}>
                                                <label for="inlineRadio1">是 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_new" disabled {{$info->is_new==0?'checked':''}}>
                                                <label for="inlineRadio2">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">是否促销</label>
                                        <div class="col-sm-9">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_hot" disabled {{$info->is_hot==1?'checked':''}}>
                                                <label for="inlineRadio1">是 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_hot" disabled {{$info->is_hot==0?'checked':''}}>
                                                <label for="inlineRadio2">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">状态</label>
                                        <div class="col-sm-10">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio1" value="1" name="status" disabled {{$info->status==1?'checked':''}}>
                                                <label for="inlineRadio1">启用 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio2" value="0" name="status" disabled {{$info->status==0?'checked':''}}>
                                                <label for="inlineRadio2">禁用 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-md-12" >
                                    <a href="javascript:;" onclick="addStr()" class="add btn btn-md btn-success" >增加一栏</a>
                                    <a href="javascript:;" class="reduce btn btn-md btn-danger" >减去指定栏</a>
                                    <table class="table table-striped  table-bordered" id="good_list" >
                                        <thead>
                                        <tr role="row">
                                            <td><input type="checkbox" class="icheck_input" id="checkAll"></td>
                                            <th>版本、型号<span style="color: red;" >*</span></th>
                                            <th style="min-width: 160px;" >颜色<span style="color: red;" >*</span></th>
                                            <th>库存量<span style="color: red;" >*</span></th>
                                            <th>单价(元)<span style="color: red;" >*</span></th>
                                            <th>优惠单价(元)</th>
                                            <th>状态<span style="color: red;" >*</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($info->attr as $k=>$v)
                                            <tr>
                                                <td><input type="checkbox" name="checks" class="icheck_input" value="{{$v['id']}}"></td>
                                                <td><input class="form-control" type="text" name="model_number[]" value="{{$v['model_number']}}" data-error-container="#error-block" ></td>
                                                <td>
                                                    <select class="form-control select2 color_select" name="color_id[]" data-error-container="#error-block">
                                                        {!! color_select(1,0,$v['color_id']) !!}
                                                    </select>
                                                </td>
                                                <td><input class="form-control" type="text" name="stock[]" value="{{$v['stock']}}" data-error-container="#error-block" ></td>
                                                <td><input class="form-control" type="text" name="price[]" value="{{$v['price']}}" data-error-container="#error-block" ></td>
                                                <td><input class="form-control" type="text" name="promote_price[]" value="{{$v['promote_price']}}" data-error-container="#error-block" ></td>
                                                <td>
                                                    <select class="form-control select2" name="status[]" data-error-container="#error-block" id="category_id">
                                                        <option value="-1" {{$v['status']==-1 ?'selected' :''}} >下架</option>
                                                        <option value="0" {{$v['status']==0 ?'selected' :''}} >暂时缺货</option>
                                                        <option value="1" {{$v['status']==1 ?'selected' :''}} >正常</option>
                                                        <option value="2" {{$v['status']==2 ?'selected' :''}} >新品</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                            <div class="modal-footer">
                                <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
                                <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" >

        function addStr() {
            $(".table-bordered tbody").append(
                '<tr>' +
                '<td><input type="checkbox" name="checks"></td>' +
                '<td><input class="form-control" type="text" name="model_number[]" data-error-container="#error-block" ></td>'+
                '<td><select class="form-control select2" name="color_id[]" data-error-container="#error-block">'
                +'{!! color_select() !!}'+
                '</select> </td>'+
                '<td><input class="form-control" type="text" name="stock[]" data-error-container="#error-block" ></td>'+
                '<td><input class="form-control" type="text" name="price[]" data-error-container="#error-block" ></td>'+
                '<td><input class="form-control" type="text" name="promote_price[]" data-error-container="#error-block" ></td>'+
                '<td> <select class="form-control select2" name="status[]" data-error-container="#error-block" id="category_id">'+
                ' <option value="-1">下架</option> <option value="0">暂时缺货</option> <option value="1">正常</option>'+
                ' <option value="2">新品</option> </select> </td>'+
                '</tr>'
            );

            $('.datepicker').datepicker({
                language: "zh-CN",
                format: 'yyyy-mm-dd',
                autoclose:true
            });
            $(".select2").select2();
        }

        $("document").ready(function () {
            $(".reduce").click(function () {
                $(".table-bordered tbody tr input:checked").parents("tr").remove();
            });
            $("#checkAll").click(function () {
                var userids=this.checked;
                //获取name=box的复选框 遍历输出复选框
                $(".table-bordered tbody input:checkbox").each(function(){
                    this.checked=userids;
                });
            });
        });
    </script>

    <script type="text/javascript" >

        $(document).ready(function() {
            blog.handleSelect2();

            $('.icheck_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
            }).iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            $('.datepicker').datepicker({
                language: "zh-CN",
                format: 'yyyy-mm-dd HH:ii:sss',
                autoclose:true
            });

            jeDate("#plan_start_time",{
                festival:true,
                minDate:"1900-01-01",              //最小日期
                maxDate:"2099-12-31",              //最大日期
                method:{
                    choose:function (params) {

                    }
                },
                format: "YYYY-MM-DD hh:mm:ss"
            });
        });

        function tijiao(obj) {
            $.ajax({
                type: "post",
                url: "{{url('admin/good')}}/{{$info->id}}",
                data: $('.form-horizontal').serialize(),
                dataType:"json",
                beforeSend:function () {
                    // 禁用按钮防止重复提交
                    $(obj).attr({ disabled: "disabled" });
                    blog.loading('正在提交，请稍等...');
                },
                success: function (data) {
                    if(data.code==1){
                        swal({
                            title: "",
                            text: data.message,
                            type: "success",
                            timer: 1000,
                        },function () {
                            window.location.href = "{{url('admin/good')}}";
                        });
                    }else{
                        swal("", data.message, "error");
                    }
                },
                complete:function () {
                    $(obj).removeAttr("disabled");
                    removeLoading('loading');
                },
                error:function (jqXHR, textStatus, errorThrown) {
                    blog.errorPrompt(jqXHR, textStatus, errorThrown);
                }
            });
        }

    </script>
@endsection