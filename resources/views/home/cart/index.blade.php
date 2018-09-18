@extends('layouts.home')


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>商城后台</h2>
            {!! Breadcrumbs::render('good'); !!}
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><input class="icheck_input_all" type="checkbox"></th>
                                <th>id</th>
                                <th>图片</th>
                                <th>商品名称</th>
                                <th>数量</th>
                                <th>价格</th>
                                <th>设置</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($good_list as $k=>$v)
                                <tr>
                                    <td><input class="icheck_input good_input" type="checkbox" value="{{$v['attr_id']}}"></td>
                                    <td>{{$v['attr_id']}}</td>
                                    <td>
                                        <a href="{{url($v->good->files[0]['path'])}}" data-lightbox="{{$k}}">
                                            <img src="{{asset($v->good->files[0]['path'])}}" style="max-width: 60px;max-height: 60px;">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url('good/'.$v->good['id'])}}">
                                            {{$v->good['name']}} {{$v->attr['model_number']}} {{$v['attr']['color']['name']}}
                                        </a>
                                    </td>
                                    <td>
                                        <input type="text" class="amount" value="{{$v['amount']}}">
                                    </td>
                                    <td>{{$v['attr']['price']}} 元</td>
                                    <td>
                                        {{--<span class="btn btn-xs btn-info" title="详情信息" onclick="showGood('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-wrench"></i> 详情</span>--}}
                                        {{--<a class="btn btn-xs btn-info" title="修改信息" href="{{url('admin/good/'.$v['id'].'/edit')}}"><i class="fa fa-wrench"></i> 修改</a>--}}
                                        <span class="btn btn-xs btn-danger" title="删除商品" onclick="deleteGood(this,'{{$v['id']}}')"><i class="fa fa-trash-o" ></i> 删除</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <p>收货地址</p>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    {{--<input class="icheck_input_all" type="radio">--}}
                                </th>
                                <th>id</th>
                                <th>收件人</th>
                                <th>手机号</th>
                                <th>所属地区</th>
                                <th>详情地址</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($address_list as $k=>$v)
                                <tr>
                                    <td><input class="icheck_input address_input" type="radio" name="address_id" value="{{$v['id']}}"></td>
                                    <td>{{$v['id']}}</td>
                                    <td>{{$v['consignee']}}</td>
                                    <td>{{$v['phone']}}</td>
                                    <td>{{$v['province']}}/{{$v['city']}}/{{$v['district']}}</td>
                                    <td>{{$v['address']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form-group">
                            <label for="password_answer" class="col-md-1 control-label">备注</label>
                            <div class="col-md-11">
                                <textarea class="remark" id="" cols="60" rows="5" style="resize:none;padding: 5px;"></textarea>
                            </div>
                        </div>

                        <button type="button" class="btn btn-info" onclick="add(this)">下单</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" >

        $(document).ready(function(){
            $('.icheck_input,.icheck_input_all,.address_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
            }).iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            //全选
            $('.icheck_input_all').on('ifChecked', function(event){
                $('.icheck_input').iCheck('check')
            });

            //全不选
            $('.icheck_input_all').on('ifUnchecked', function(event){
                $('.icheck_input').iCheck('uncheck')
            });
        });

        function add(obj) {
            var checkStatus = $("tbody input[type='checkbox']:checked");
            if(checkStatus.length >= 1){
                var attr_ids = [];
                $.each(checkStatus,function(i,v){
                    attr_ids.push(v.value);
                });
                attr_ids = attr_ids.toString();
            }else{
                swal("请选择至少一件商品！", "", "warning");
                return;
            }

            $.ajax({
                type: "post",
                url: "{{url('member/order')}}",
//                data: $('.form-horizontal').serialize(),
                data: {
                    '_token': "{{csrf_token()}}",
                    'attr_id': attr_ids,
                    'address_id' : $("input[name='address_id']").val(),
                    'remark' : $(".remark").val()
                },
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
//                            window.location.reload();
                            window.location.href = "{{url('member/order/to_pay')}}/"+data.order_id;
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


        $("#simple-search").on('click',function () {
            window.location.href = "{{url('admin/good')}}?search="+$("#search-text").val();
        });



    </script>
@endsection