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
                                        <div class="input-group bootstrap-touchspin">
                                            <span class="input-group-btn">
                                                <button class="btn btn-white bootstrap-touchspin-down reduce-amount" type="button" onclick="reduce_amount(this,'{{$v['id']}}')">-</button>
                                            </span>
                                            <input class="touchspin1 form-control" type="text" value="{{$v['amount']}}" disabled>
                                            <span class="input-group-btn">
                                                <button class="btn btn-white bootstrap-touchspin-up add-amount" type="button" onclick="add_amount(this,'{{$v['id']}}')">+</button>
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{$v['attr']['price']}} 元</td>
                                    <td>
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
            //数量增
            function add_amount(obj,cart_ite_id) {
                var touchspin1 = $(obj).parents('.bootstrap-touchspin').find('.touchspin1');
                var amount = touchspin1.val();
                //当前cart_item_id
                //amount值
                $.ajax({
                    type: "post",
                    url: "{{url('member/cart/amount')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'type' : 'add',
                        'cart_item_id' : cart_ite_id
                    },
                    dataType:"json",
                    beforeSend:function () {
                        // 禁用按钮防止重复提交
                        $(obj).attr({ disabled: "disabled" });
                    },
                    success: function (data) {
                        if(data.code==1){
                            amount++;
                            touchspin1.val(amount);
                            if(touchspin1.val() >1 ){
                                $(obj).parents('.bootstrap-touchspin').find('.reduce-amount').attr('disabled',false);
                            }
                        }else{
                            swal("", data.message, "error");
                        }
                    },
                    complete:function () {
                        $(obj).removeAttr("disabled");
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        blog.errorPrompt(jqXHR, textStatus, errorThrown);
                    }
                });

            }
            //数量减
            function reduce_amount(obj,cart_ite_id) {
//                $(this).parents('.bootstrap-touchspin').find('').val();
                var touchspin1 = $(obj).parents('.bootstrap-touchspin').find('.touchspin1');
                var amount = touchspin1.val();

                if(amount <= 1){
                    $(obj).attr('disabled',true);
                }else{

                    //当前cart_item_id
                    //amount值
                    $.ajax({
                        type: "post",
                        url: "{{url('member/cart/amount')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'type': 'reduce',
                            'cart_item_id' : cart_ite_id
                        },
                        dataType:"json",
                        beforeSend:function () {
                            // 禁用按钮防止重复提交
                            $(obj).attr({ disabled: "disabled" });
                        },
                        success: function (data) {
                            if(data.code==1){
                                amount--;
                                console.log(amount);
                                touchspin1.val(amount);
                            }else{
                                swal("", data.message, "error");
                            }
                        },
                        complete:function () {
                            $(obj).removeAttr("disabled");
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            blog.errorPrompt(jqXHR, textStatus, errorThrown);
                        }
                    });


                }
            }



        function add(obj) {

            var checkStatus = $("tbody input[type='checkbox']:checked");

            var address_id = $("input[name='address_id']:checked").val();

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

            if(!address_id){
                swal("请选择收货地址！", "", "warning");
                return;
            }

            $.ajax({
                type: "post",
                url: "{{url('member/order')}}",
//                data: $('.form-horizontal').serialize(),
                data: {
                    '_token': "{{csrf_token()}}",
                    'attr_id': attr_ids,
                    'address_id' : address_id,
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