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
                                <th>id</th>
                                <th>图片</th>
                                <th>商品名称</th>
                                <th>数量</th>
                                <th>价格</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_attr_list as $k=>$v)
                                <tr>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <p>收件地址详情： {{$order_info->address['consignee']}} {{$order_info->address['phone']}} {{$order_info->address['address']}}</p>

                        <div class="form-group">
                            <label for="password_answer" class="col-md-1 control-label">备注</label>
                            <div class="col-md-11">
                                <textarea class="remark" disabled cols="60" rows="5" style="resize:none;padding: 5px;">{{$order_info->remark}}</textarea>
                            </div>
                        </div>

                        <button type="button" class="btn btn-info" onclick="pay(this)">确认支付</button>
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

        function pay(obj) {
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