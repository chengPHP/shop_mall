<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">工作计划完成</h4>
</div>
<form method="post" class="form-horizontal">
    <div class="modal-body">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">工作名称</label>
            <div class="col-sm-10">
                <input id="name" type="text" value="{{$info['contents']}}" disabled class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">工作详情</label>
            <div class="col-sm-10">
                <textarea name="" id="" cols="80" rows="5" style="resize: none" disabled>
                    @php
                        echo html_entity_decode($info['work_details']);
                    @endphp
                </textarea>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">计划开始时间</label>
            <div class="col-sm-10">
                <input type="text" value="{{$info['plan_start_time']}}" disabled class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">计划结束时间</label>
            <div class="col-sm-10">
                <input type="text" value="{{$info['plan_end_time']}}" disabled class="form-control">
            </div>
        </div>
        @if($info['status']==1)
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">真实开始时间</label>
            <div class="col-sm-10">
                <input type="text" value="{{$info['start_time']}}" disabled class="form-control">
            </div>
        </div>
        @endif
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">真实结束时间</label>
            <div class="col-sm-10">
                <input type="text" id="end_time" name="end_time" value="{{date('Y-m-d H:i:s')}}" class="jeinput form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">工作总结</label>
            <div class="col-sm-10">
                <div class="col-sm-10">
                    <script id="work_result" type="text/plain" style="width:100%;height:200px;"></script>
                    <script type="text/javascript">
                    //实例化编辑器
                    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                    var ue2 = UE.getEditor('work_result');
                    </script>
                </div>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="orders" class="col-sm-2 control-label">当前状态</label>
            <div class="col-sm-10">
                @if($info['status']==-1)
                    <input type="text" value="已取消" disabled class="form-control">
                @elseif($info['status']==0)
                    <input type="text" value="新建" disabled class="form-control">
                @elseif($info['status']==1)
                    <input type="text" value="进行中" disabled class="form-control">
                @elseif($info['status']==2)
                    <input type="text" value="已完成" disabled class="form-control">
                @elseif($info['status']==3)
                    <input type="text" value="未完成" disabled class="form-control">
                @endif
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <input type="hidden" name="id" value="{{$id}}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
    </div>
</form>

<script>

    //页面加载完成后初始化select2控件
    $(document).ready(function() {
        blog.handleSelect2();

        $('.icheck_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
        }).iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });


        jeDate("#end_time",{
            festival:true,
            minDate:"1900-01-01",              //最小日期
            maxDate:"2099-12-31",              //最大日期
            method:{
                choose:function (params) {

                }
            },
            format: "YYYY-MM-DD hh:mm:ss"
        });

    });

</script>

<script type="text/javascript" >

    function tijiao(obj) {
        $.ajax({
            type: "post",
            url: "{{url('admin/work/complete_work')}}",
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
                        window.location.href="{{url('admin/work?status=1')}}";
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

    function fanhui() {
        window.location.href="{{url('admin/work')}}";
    }

</script>
