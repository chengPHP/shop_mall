<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">订单详情信息</h4>
</div>
<form id="signupForm" method="post" class="form-horizontal" >
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">订单流水号</label>
                    <div class="col-sm-8">
                        <input id="name" type="text" value="{{$order_info['no']}}" disabled class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">订单总金额</label>
                    <div class="col-sm-8">
                        <input id="name" type="text" name="name" value="{{$order_info['total_amount']}}" disabled class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">支付方式</label>
                    <div class="col-sm-8">
                        <input id="name" type="text" name="name" value="{{$order_info['payment_method']}}" disabled class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">物流状态</label>
                    <div class="col-sm-8">
                        <input id="name" type="text" name="name" value="{{$order_info['ship_status']}}" disabled class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">物流数据</label>
                    <div class="col-sm-8">
                        <input id="name" type="text" name="name" value="{{$order_info['ship_data']}}" disabled class="form-control">
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

    });

</script>

