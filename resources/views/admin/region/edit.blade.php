
<div class="ibox-title">
    <h5>修改城市信息</h5>
</div>
<div class="ibox-content">
    <form method="post" class="form-horizontal" action="{{url('admin/region')}}/{{$info->id}}">
        <div class="modal-body">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">城市名称</label>
                <div class="col-sm-10">
                    <input id="name" type="text" name="name" value="{{$info->name}}" class="form-control">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="code" class="col-sm-2 control-label">城市编号</label>
                <div class="col-sm-10">
                    <input id="code" type="text" name="code" value="{{$info->code}}" placeholder="城市编号" class="form-control">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="pid" class="col-sm-2 control-label">父级名称</label>
                <div class="col-sm-10">
                    <select id="pid" class="form-control m-b select2" name="pid">
                        {!! region_select($info->pid,1,$info->id) !!}
                    </select>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input class="icheck_input" type="radio" id="inlineRadio1" value="1" name="status" {{$info->status==1 ? 'checked': ''}}>
                        <label for="inlineRadio1">启用 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input class="icheck_input" type="radio" id="inlineRadio2" value="0" name="status" {{$info->status==0 ? 'checked': ''}}>
                        <label for="inlineRadio2">禁用 </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="deleteRegion('{{$info->id}}')">删除</button>
            <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
        </div>
    </form>
</div>



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
            url: "{{url('admin/region')}}/{{$info->id}}",
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

    function deleteRegion(id) {
        swal({
                title: '确定要删除此城市信息吗？',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "取消",
                confirmButtonText: "确认",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: "{{url('admin/region')}}"+'/'+id,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": '{{csrf_token()}}',
                        '_method': 'delete'
                    },
                    beforeSend: function () {
                    },
                    success: function (data, textStatus, xhr) {
                        if(data.code==1){
                            swal({
                                title: "",
                                text: data.message,
                                type: "success",
                                timer: 1000
                            },function () {
                                window.location.reload();
                            });
                        }else if (data.code==0){
                            swal({
                                title: "",
                                text: data.message,
                                type: 'error',
                                confirmButtonText: "确定"
                            },function () {
                                window.location.reload();
                            });
                        }
                    }
                });
            });
    }

</script>

