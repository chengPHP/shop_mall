<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">添加收件地址</h4>
</div>
<form id="signupForm" method="post" class="form-horizontal" action="{{url('member/address')}}">
    <div class="modal-body">

        {{--错误信息提示--}}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{csrf_field()}}
        <div class="form-group">
            <label for="consignee" class="col-sm-2 control-label">收件人姓名</label>
            <div class="col-sm-10">
                <input id="consignee" type="text" name="consignee" placeholder="收件人姓名" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">收件人电话</label>
            <div class="col-sm-10">
                <input id="phone" type="text" name="phone" placeholder="收件人电话" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="province" class="col-sm-2 control-label">所属省</label>
            <div class="col-sm-10">
                <input id="province" type="text" name="province" placeholder="所属省" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="city" class="col-sm-2 control-label">所属市</label>
            <div class="col-sm-10">
                <input id="city" type="text" name="city" placeholder="所属市" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="district" class="col-sm-2 control-label">所属区(县)</label>
            <div class="col-sm-10">
                <input id="district" type="text" name="district" placeholder="所属区(县)" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">详细地址</label>
            <div class="col-sm-10">
                <input id="address" type="text" name="address" placeholder="详细地址" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
    </div>
</form>
<script type="text/javascript" >
    //页面加载完成后初始化select2控件
    $(document).ready(function() {
        blog.handleSelect2();

        $('.icheck_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
        }).iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });

    });


    function tijiao(obj) {
        $.ajax({
            type: "post",
            url: "{{url('member/address')}}",
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

</script>

