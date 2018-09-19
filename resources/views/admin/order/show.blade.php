<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">订单详情信息</h4>
</div>
<form id="signupForm" method="post" class="form-horizontal" >
    <div class="modal-body">


        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false"> 订单详情</a></li>
                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="true">物流详情</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="row" >
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">订单流水号</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" value="{{$order_info['no']}}" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">订单总金额</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" name="name" value="{{$order_info['total_amount']}} 元" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">支付方式</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" name="name" value="{{$order_info['payment_method']}}" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">会员名</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" name="name" value="{{$order_info->member['name']}}" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">收件人</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" name="name" value="{{$order_info->address['consignee']}}" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">收件电话</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" name="name" value="{{$order_info->address['phone']}}" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">收件地址</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" name="name" value="{{$order_info->address['address']}}" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 control-label">物流状态</label>
                                    <div class="col-sm-8">
                                        @if($order_info['ship_status']==0)
                                            <input id="name" type="text" name="name" value="未发货" disabled class="form-control">
                                        @elseif($order_info['ship_status']==1)
                                            <input id="name" type="text" name="name" value="已发货" disabled class="form-control">
                                        @else
                                            <input id="name" type="text" name="name" value="已收货" disabled class="form-control">
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <table class="table table-striped  table-bordered" id="good_list" >
                                    <thead>
                                    <tr role="row">
                                        <td><input type="checkbox" class="icheck_input" id="checkAll"></td>
                                        <th>id</th>
                                        <th>商品名称</th>
                                        <th>数量</th>
                                        <th>单价</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_item_list as $k=>$v)
                                            <tr>
                                                <td><input type="checkbox" class="icheck_input" value=""></td>
                                                <td>{{$v['id']}}</td>
                                                <td>{{$v->good['name']}} {{$v->attr['model_number']}} {{$v->attr->color['name']}}</td>
                                                <td>{{$v['amount']}}</td>
                                                <td>{{$v->attr['price']}} 元</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($order_info['refund_status']>0)
                                <div class="col-md-8" >
                                    <div class="form-group">
                                        <label for="name" class="col-sm-3 control-label">退款状态</label>
                                        <div class="col-sm-9">
                                            @if($order_info['refund_status']==0)
                                                <span class="label label-primary">未退款</span>
                                            @elseif($order_info['refund_status']==1)
                                                <span class="label label-info">已申请退款</span>
                                            @elseif($order_info['refund_status']==2)
                                                <span class="label label-default">退款中</span>
                                            @elseif($order_info['refund_status']==3)
                                                <span class="label label-success">退款成功</span>
                                            @else
                                                <span class="label label-danger">拒绝退款</span>
                                            @endif
                                            <span class="block" >退款理由：{{$order_info->refund['refund_reason']}}</span>
                                            @if($order_info->refund['refuse_reason'])
                                                <span class="block" >拒绝退款理由：{{$order_info->refund['refuse_reason']}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                @if($order_info['refund_status']==1)
                                    <a class="btn btn-success" id="btn-refund-agree" title="同意" >同意</a>
                                    <a class="btn btn-danger" title="拒绝" onclick="refuseOrder('{{$order_info['id']}}')" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-trash-o"></i> 拒绝</a>
                                @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                    @if( count($logistic_list)==0 )
                            <p>暂无物流数据</p>
                        @else
                            @foreach($logistic_list as $v)
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-3 date">
                                            <i class="fa fa-briefcase"></i>
                                            {{$v['created_at']}}
                                        </div>
                                        <div class="col-xs-7 content no-top-border">
                                            {{--<p class="m-b-xs"><strong>Meeting</strong></p>--}}

                                            <p>
                                                {{$v['record']}}
                                                @if($v['duty_name'])
                                                    派送负责人：{{$v['duty_name']}} , 联系电话：{{$v['duty_phone']}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>


        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
    </div>
</form>
<script type="text/javascript" >
    //页面加载完成后初始化select2控件
    $(document).ready(function() {
        blog.handleSelect2();

        $('.datepicker').datepicker({
            language: "zh-CN",
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('.icheck_input,.icheck_input_all').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
        }).iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });


        $('#btn-refund-agree').on("click",function() {
            $.ajax({
                type: "post",
                url: "{{url('admin/order/refund')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'order_id': "{{$order_info['id']}}"
                },
                dataType: "json",
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
                }
            });
        });


    });



    function refuseOrder(id) {
//        $(".bs-example-modal-md .modal-content").html();
        $.ajax({
            url: "{{ url('admin/order/to_refuse') }}/"+id,
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

</script>

