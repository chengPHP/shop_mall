<div class="ibox-title">
    <h5>添加类别</h5>
</div>
<div class="ibox-content">
    <form method="post" class="form-horizontal" action="{{url('admin/category')}}">
        <div class="modal-body">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">类别名称</label>
                <div class="col-sm-10">
                    <input id="name" type="text" name="name" value="" class="form-control">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">类别别名</label>
                <div class="col-sm-10">
                    <input id="name" type="text" name="alias" value="" class="form-control">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="pid" class="col-sm-2 control-label">父级类别</label>
                <div class="col-sm-10">
                    <select id="pid" class="form-control m-b select2" name="pid">
                        {!! category_select() !!}
                    </select>
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
            <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
        </div>
    </form>
</div>



