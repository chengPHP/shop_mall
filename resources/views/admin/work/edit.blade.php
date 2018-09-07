@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('article'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="{{ url('admin/work/create') }}" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-m btn-primary" id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('admin/work/'.$info['id'])}}" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="editor" class="col-sm-2 control-label">工作名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="contents" value="{{$info['contents']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="work_details" class="col-sm-2 control-label">工作详情计划</label>
                                    <div class="col-sm-10">
                                        <script id="work_details" type="text/plain" style="width:100%;height:200px;">
                                            @php
                                                echo htmlspecialchars_decode($info['work_details']);
                                            @endphp
                                        </script>
                                        <script type="text/javascript">
                                        //实例化编辑器
                                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                        var ue2 = UE.getEditor('work_details');
                                        </script>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="plan_start_time" class="col-sm-2 control-label">工作计划开始时间</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="jeinput form-control" id="plan_start_time" name="plan_start_time" value="{{$info['plan_start_time']}}">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="plan_end_time" class="col-sm-2 control-label">工作计划完成时间</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="jeinput form-control" id="plan_end_time" name="plan_end_time" value="{{$info['plan_end_time']}}">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="fanhui()" class="btn btn-default" >取消</button>
                                <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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


            jeDate("#plan_start_time",{
                festival:true,
                minDate:"1900-01-01",              //最小日期
                maxDate:"2099-12-31",              //最大日期
                method:{
                    choose:function (params) {

                    }
                },
                format: "YYYY-MM-DD hh:mm:ss"
            });

            jeDate("#plan_end_time",{
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
                url: "{{url('admin/work')}}/{{$info->id}}",
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
                            window.location.href="{{url('admin/work')}}";
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

@endsection
