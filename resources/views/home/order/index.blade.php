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
                                <th>订单流水号</th>
                                <th>订单总金额</th>
                                <th>支付方式</th>
                                <th>物流状态</th>
                                <th>设置</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_list as $k=>$v)
                                <tr>
                                    <td><input class="icheck_input good_input" type="checkbox" value="{{$v['id']}}"></td>
                                    <td>{{$v['id']}}</td>
                                    <td>
                                        <a href="javascript:;" title="详情信息" onclick="showOrder('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-lg">
                                            {{$v['no']}}
                                            @if($v['closed'])
                                                <span class="label label-warning">订单已关闭</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td>{{$v['total_amount']}} 元</td>
                                    <td>{{$v['payment_method']?$v['payment_method']:'暂无支付'}}</td>
                                    <td>
                                        @if($v['ship_status']==0)
                                            <span class="label label-primary">未发货</span>
                                        @elseif($v['ship_status']==1)
                                            <span class="label label-info">已发货</span>
                                        @else
                                            <span class="label label-success">已签收</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$v['payment_no'])
                                            <a class="btn btn-xs btn-primary" title="支付" href="{{ route('payment.alipay', ['order' => $v['id']]) }}"><i class="fa fa-cny"></i> 支付</a>
                                        @endif
                                        <span class="btn btn-xs btn-info" title="详情信息" onclick="showOrder('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-wrench"></i> 详情</span>
                                        @if($v['ship_status']==1)
                                            <span class="btn btn-xs btn-success" title="确认签收" onclick="deliversOrder(this,'{{$v['id']}}')">确认签收</span>
                                            @if($v['refund_status']<1)
                                                <span class="btn btn-xs btn-success" title="申请退货" onclick="returnOrder('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-md">申请退货</span>
                                            @endif
                                        @elseif($v['ship_status']==2 && !$v['evaluate_id'])
                                            <span class="btn btn-xs btn-info" title="评价" onclick="reviewed('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-wrench"></i> 评价</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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
                    'remark' : $(".remark").html()
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
                            window.location.reload();
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

        function deliversOrder(obj,id) {
            swal({
                    title: '确认签收？',
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "取消",
                    confirmButtonText: "确认",
                    closeOnConfirm: false
                },
                function () {
                    $.ajax({
                        type: "post",
                        url: "{{url('member/order/delivers')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'order_id': id
                        },
                        dataType: "json",
                        beforeSend: function () {
                            // 禁用按钮防止重复提交
                            $(obj).attr({disabled: "disabled"});
                            blog.loading('正在提交，请稍等...');
                        },
                        success: function (data) {
                            if (data.code == 1) {
                                swal({
                                    title: "",
                                    text: data.message,
                                    type: "success",
                                    timer: 1000,
                                }, function () {
                                    window.location.reload();
                                });
                            } else {
                                swal("", data.message, "error");
                            }
                        },
                        complete: function () {
                            $(obj).removeAttr("disabled");
                            removeLoading('loading');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            blog.errorPrompt(jqXHR, textStatus, errorThrown);
                        }
                    });
                });
        }


        function showOrder(id) {
            $(".bs-example-modal-lg .modal-content").html();
            $.ajax({
                url: "{{ url('member/order') }}/"+id,
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $(".bs-example-modal-lg .modal-content").html(data);
                }
            });
        }

        function returnOrder(id) {
            $(".bs-example-modal-md .modal-content").html();
            $.ajax({
                url: "{{ url('member/order/to_refund') }}/"+id,
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $(".bs-example-modal-md .modal-content").html(data);
                }
            });
        }

        //订单评价
        function reviewed(id) {
            $(".bs-example-modal-md .modal-content").html();
            $.ajax({
                url: "{{ url('member/order/to_evaluate') }}/"+id,
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $(".bs-example-modal-md .modal-content").html(data);
                }
            });
        }

        $("#simple-search").on('click',function () {
            window.location.href = "{{url('admin/good')}}?search="+$("#search-text").val();
        });



    </script>
@endsection