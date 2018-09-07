<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">工作计划详情</h4>
</div>
<form method="post" class="form-horizontal">
    <div class="modal-body">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">工作名称</label>
            <div class="col-sm-10">
                <input id="name" type="text" value="{{$work_info['contents']}}" disabled class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">工作任务详情</label>
            <div class="col-sm-10">
                <textarea name="" id="" cols="80" rows="5" style="resize: none" disabled>
                    @php
                        echo html_entity_decode($work_info['work_details']);
                    @endphp
                </textarea>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">计划开始时间</label>
            <div class="col-sm-10">
                <input type="text" value="{{$work_info['plan_start_time']}}" disabled class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">计划结束时间</label>
            <div class="col-sm-10">
                <input type="text" value="{{$work_info['plan_end_time']}}" disabled class="form-control">
            </div>
        </div>
        @if($work_info['start_time'])
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">真实开始时间</label>
            <div class="col-sm-10">
                <input type="text" value="{{$work_info['start_time']}}" disabled class="form-control">
            </div>
        </div>
        @endif
        @if($work_info['end_time'])
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="url" class="col-sm-2 control-label">真实结束时间</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$work_info['end_time']}}" disabled class="form-control">
                </div>
            </div>
        @endif
        @if($work_info['work_result'])
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="url" class="col-sm-2 control-label">工作总结</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$work_info['work_result']}}" disabled class="form-control">
                </div>
            </div>
        @endif
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label for="orders" class="col-sm-2 control-label">当前状态</label>
            <div class="col-sm-10">
                @if($work_info['status']==-1)
                    <input type="text" value="已取消" disabled class="form-control">
                @elseif($work_info['status']==0)
                    <input type="text" value="新建" disabled class="form-control">
                @elseif($work_info['status']==1)
                    <input type="text" value="进行中" disabled class="form-control">
                @elseif($work_info['status']==2)
                    <input type="text" value="已完成" disabled class="form-control">
                @elseif($work_info['status']==3)
                    <input type="text" value="未完成" disabled class="form-control">
                @endif
            </div>
        </div>
        <div class="hr-line-dashed"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    </div>
</form>
