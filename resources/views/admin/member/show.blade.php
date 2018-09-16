<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">会员用户详情信息</h4>
</div>
<form id="signupForm" method="post" class="form-horizontal" >
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="nickname" class="col-sm-4 control-label">会员昵称<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="nickname" type="text" name="nickname" value="{{$info->nickname}}" disabled class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">会员名称<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="name" type="text" name="name" disabled value="{{$info->name}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="phone" class="col-sm-4 control-label">手机号<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="phone" type="text" name="phone" value="{{$info->phone}}" disabled class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="office_phone" class="col-sm-4 control-label">会员等级</label>
                    <div class="col-sm-8">
                        <input id="rank" type="text" name="rank" value="{{$info->rank->name}}" disabled class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="password_question" class="col-sm-4 control-label">密码提问</label>
                    <div class="col-sm-8">
                        <input id="password_question" type="text" name="password_question" value="{{$info->password_question}}" disabled class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="password_answer" class="col-sm-4 control-label">密码回答</label>
                    <div class="col-sm-8">
                        <input id="password_answer" type="text" name="password_answer" value="{{$info->password_answer}}" disabled class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label class="col-sm-4 control-label">性别</label>
                    <div class="col-sm-8">
                        <select id="sex" class="form-control m-b select2" name="sex" disabled>
                            <option value="0" {{$info->sex==0?'selected':''}} >保密</option>
                            <option value="1" {{$info->sex==1?'selected':''}} >男</option>
                            <option value="2" {{$info->sex==2?'selected':''}} >女</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="birthday" class="col-sm-4 control-label">出生日期</label>
                    <div class="col-sm-8">
                        <input id="birthday" type="text" name="birthday" disabled value="{{$info->birthday}}" data-error-container="#error-block" class="form-control datepicker" data-date-date = "0d">
                    </div>
                </div>
            </div>

            {{--<div class="col-md-4" >
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">邮箱<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="email" type="email" name="email" value="{{$info->email}}" disabled class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="qq" class="col-sm-4 control-label">qq账号</label>
                    <div class="col-sm-8">
                        <input id="qq" type="text" name="qq" value="{{$info->qq}}" disabled class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="office_phone" class="col-sm-4 control-label">办公电话</label>
                    <div class="col-sm-8">
                        <input id="office_phone" type="text" name="office_phone" value="{{$info->office_phone}}" disabled class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="home_phone" class="col-sm-4 control-label">家庭电话</label>
                    <div class="col-sm-8">
                        <input id="home_phone" type="text" name="home_phone" value="{{$info->home_phone}}" disabled class="form-control">
                    </div>
                </div>
            </div>--}}

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="home_phone" class="col-sm-4 control-label">头像</label>
                    <div class="col-sm-8">
                        <a href="{{url($info->get_member_head['path'])}}" data-lightbox="roadtrip">
                            <img src="{{asset($info->get_member_head['path'])}}" style="max-width: 30px;max-height: 30px;">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-10">
                        <div class="radio radio-info radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio1" value="1" name="status" {{$info->status==1?'checked':''}} disabled>
                            <label for="inlineRadio1">启用</label>
                        </div>
                        <div class="radio radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio2" value="0" name="status" {{$info->status==0?'checked':''}} disabled>
                            <label for="inlineRadio2">禁用</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--所有的收货地址--}}

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input class="icheck_input_all" type="checkbox"></th>
                    <th>id</th>
                    <th>收件人</th>
                    <th>电话</th>
                    <th>所在位置</th>
                    <th>详情地址</th>
                    <th>最佳收货时间</th>
                </tr>
            </thead>
            <tbody>
                @foreach($info->address as $k=>$v)
                    <td><input class="icheck_input" type="checkbox" value="{{$v['id']}}"></td>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['consignee']}}</td>
                    <td>{{$v['phone']}}</td>
                    <td>{!! get_region_name($v->region['path'].$v['region_id'], 'name') !!}</td>
                    <td>{{$v['address']}}</td>
                    <td>{{$v['best_time']}}</td>
                @endforeach
            </tbody>
        </table>

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

