<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">添加会员等级</h4>
</div>
<form id="signupForm" method="post" class="form-horizontal" action="{{url('admin/rank')}}">
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
            <label for="name" class="col-sm-2 control-label">等级名称</label>
            <div class="col-sm-10">
                <input id="name" type="text" name="name" placeholder="等级名称" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label for="code" class="col-sm-2 control-label">等级编号</label>
            <div class="col-sm-10">
                <input id="code" type="text" name="code" placeholder="等级编号" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label for="min_points" class="col-sm-2 control-label">最低积分</label>
            <div class="col-sm-10">
                <input id="min_points" type="text" name="min_points" placeholder="该等级的最低积分" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label for="max_points" class="col-sm-2 control-label">最高积分</label>
            <div class="col-sm-10">
                <input id="max_points" type="text" name="max_points" placeholder="该等级的最高积分" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label for="discount" class="col-sm-2 control-label">商品折扣</label>
            <div class="col-sm-10 ">
                <div class="input-group">
                    <input id="discount" type="text" name="discount" placeholder="该会员等级的商品折扣，范围:0-100" class="form-control">
                    <span class="input-group-addon">折</span>
                </div>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-sm-2 control-label">特殊会员等级组</label>
            <div class="col-sm-10">
                <div class="radio radio-info radio-inline">
                    <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="special_rank">
                    <label for="inlineRadio3">是 </label>
                </div>
                <div class="radio radio-inline">
                    <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="special_rank" checked>
                    <label for="inlineRadio4">否 </label>
                </div>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">
                <div class="radio radio-info radio-inline">
                    <input class="icheck_input" type="radio" id="inlineRadio1" value="1" name="status" checked="">
                    <label for="inlineRadio1">启用 </label>
                </div>
                <div class="radio radio-inline">
                    <input class="icheck_input" type="radio" id="inlineRadio2" value="0" name="status">
                    <label for="inlineRadio2">禁用 </label>
                </div>
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
            url: "{{url('admin/rank')}}",
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

