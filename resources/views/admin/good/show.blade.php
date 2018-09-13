<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">商品详情信息</h4>
</div>
<form id="signupForm" method="post" class="form-horizontal" >
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">商品名称<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="name" type="text" name="name" value="{{$info->name}}" disabled class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="category_id" class="col-sm-4 control-label">商品类别<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <select id="category_id" class="form-control m-b select2" disabled name="category_id">
                            {!! category_select(1, 0, $info->category_id) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="sn" class="col-sm-4 control-label">商品编号<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="sn" type="text" name="sn" value="{{$info->sn}}" disabled class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="brand_id" class="col-sm-4 control-label">商品品牌<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <select id="brand_id" class="form-control m-b select2" name="brand_id" disabled>
                            {!! brand_select(1,0,$info->brand_id) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="keywords" class="col-sm-4 control-label">商品关键字</label>
                    <div class="col-sm-8">
                        <input id="keywords" type="text" name="keywords" value="{{$info->keywords}}" disabled placeholder="商品关键字" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="brief" class="col-sm-4 control-label">简短描述</label>
                    <div class="col-sm-8">
                        <input id="brief" type="text" name="brief" value="{{$info->brief}}" disabled placeholder="简短描述" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="weight" class="col-sm-4 control-label">商品重量</label>
                    <div class="col-sm-8">
                        <input id="weight" type="text" name="weight" value="{{$info->weight}}" disabled placeholder="商品重量" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="give_integral" class="col-sm-4 control-label">赠送积分</label>
                    <div class="col-sm-8">
                        <input id="give_integral" type="text" name="give_integral" value="{{$info->give_integral}}" disabled placeholder="赠送积分数量" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="storage_time" class="col-sm-4 control-label">入库时间</label>
                    <div class="col-sm-8">
                        <input id="plan_start_time" type="text" name="storage_time" placeholder="入库时间" value="{{$info->storage_time}}" disabled data-error-container="#error-block" class="form-control jeinput" data-date-date = "0d">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label class="col-sm-3 control-label">是否实物</label>
                    <div class="col-sm-9">
                        <div class="radio radio-info radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_real" disabled {{$info->is_real==1?'checked':''}}>
                            <label for="inlineRadio1">是 </label>
                        </div>
                        <div class="radio radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_real" disabled {{$info->is_real==0?'checked':''}}>
                            <label for="inlineRadio2">否 </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label class="col-sm-3 control-label">是否精品</label>
                    <div class="col-sm-9">
                        <div class="radio radio-info radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_best" disabled {{$info->is_best==1?'checked':''}}>
                            <label for="inlineRadio1">是 </label>
                        </div>
                        <div class="radio radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_best" disabled {{$info->is_best==0?'checked':''}}>
                            <label for="inlineRadio2">否 </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label class="col-sm-3 control-label">是否新品</label>
                    <div class="col-sm-9">
                        <div class="radio radio-info radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_new" disabled {{$info->is_new==1?'checked':''}}>
                            <label for="inlineRadio1">是 </label>
                        </div>
                        <div class="radio radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_new" disabled {{$info->is_new==0?'checked':''}}>
                            <label for="inlineRadio2">否 </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label class="col-sm-3 control-label">是否促销</label>
                    <div class="col-sm-9">
                        <div class="radio radio-info radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_hot" disabled {{$info->is_hot==1?'checked':''}}>
                            <label for="inlineRadio1">是 </label>
                        </div>
                        <div class="radio radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_hot" disabled {{$info->is_hot==0?'checked':''}}>
                            <label for="inlineRadio2">否 </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-10">
                        <div class="radio radio-info radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio1" value="1" name="status" disabled {{$info->status==1?'checked':''}}>
                            <label for="inlineRadio1">启用 </label>
                        </div>
                        <div class="radio radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio2" value="0" name="status" disabled {{$info->status==0?'checked':''}}>
                            <label for="inlineRadio2">禁用 </label>
                        </div>
                    </div>
                </div>
            </div>

            @if($info->attr)
            <div class="col-md-12" >
                <table class="table table-striped  table-bordered" id="good_list" >
                    <thead>
                        <tr role="row">
                            <td><input type="checkbox" class="icheck_input" id="checkAll"></td>
                            <th>版本、型号<span style="color: red;" >*</span></th>
                            <th style="min-width: 160px;" >颜色<span style="color: red;" >*</span></th>
                            <th>库存量<span style="color: red;" >*</span></th>
                            <th>单价(元)<span style="color: red;" >*</span></th>
                            <th>优惠单价(元)</th>
                            <th>状态<span style="color: red;" >*</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info->attr as $k=>$v)
                            <tr>
                                <td><input type="checkbox" class="icheck_input" value="{{$v['id']}}"></td>
                                <td>{{$v['model_number']}}</td>
                                <td>{{$v->color['name']}}</td>
                                <td>{{$v['stock']}}</td>
                                <td>{{$v['price']}}</td>
                                <td>{{$v['promote_price']}}</td>
                                <td>
                                    @if($v['status']==-1)
                                        <span class="btn btn-xs btn-error">已删除</span>
                                    @elseif($v['status']==0)
                                        <span class="btn btn-xs btn-warning">暂时缺货</span>
                                    @elseif($v['status']==1)
                                        <span class="btn btn-xs btn-info">正常</span>
                                    @else
                                        <span class="btn btn-xs btn-success">新品</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
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

