<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">添加推荐链接</h4>
</div>
<form method="post" class="form-horizontal" action="{{url('admin/link')}}">
    <div class="modal-body">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">链接名称</label>
            <div class="col-sm-10">
                <input id="name" type="text" name="name" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">链接标题</label>
            <div class="col-sm-10">
                <input id="title" type="text" name="title" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">链接url</label>
            <div class="col-sm-10">
                <input id="url" type="text" name="url" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="orders" class="col-sm-2 control-label">排序</label>
            <div class="col-sm-10">
                <input id="orders" type="text" name="orders" class="form-control">
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

    $(document).ready(function() {
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
            url: "{{url('admin/link')}}",
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

    function loading3() {
        $('body').loading({
            loadingWidth:120,
            title:'',
            name:'test',
            discription:'',
            direction:'column',
            type:'origin',
            // originBg:'#71EA71',
            originDivWidth:40,
            originDivHeight:40,
            originWidth:6,
            originHeight:6,
            smallLoading:false,
            loadingMaskBg:'rgba(0,0,0,0.2)'
        });

        setTimeout(function(){
            removeLoading('test');
        },3000);
    }

</script>

