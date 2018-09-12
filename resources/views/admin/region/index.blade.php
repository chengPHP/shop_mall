@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('region'); !!}
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a onclick="add()" class="btn btn-primary blue border-radius-none"><i class="fa fa-plus"></i> 新增</a>

                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle border-radius-none" type="button" aria-expanded="false">
                                    <i class="fa fa-list"></i> 更多操作 <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-left">
                                    <li><a class="btn btn-default" id="print download" href="{{url('area/add_import')}}" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-sign-in"></i> 导入</a></li>
                                    <li><a class="btn btn-default" id="print download" href="{{url('area/export')}}"><i class="fa fa-sign-out"></i> 导出</a></li>
                                    <li><a class="btn btn-default" id="print download" href="{{url('area/select_area')}}"><i class="fa fa-sign-out"></i> 批量导出场地Excel</a></li>
                                    <li><a class="btn btn-default" id="print download" href="{{url('area/print_all')}}"><i class="fa fa-sign-out"></i> 全部导出场地Excel</a></li>
                                </ul>
                            </span>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <ul id="departments-tree" class="ztree">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="right-content" class="ibox">
                    <div class="ibox-title">
                        <h5>添加城市</h5>
                    </div>
                    <div  class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('admin/region')}}">
                            <div class="modal-body">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">城市名称</label>
                                    <div class="col-sm-10">
                                        <input id="name" type="text" name="name" placeholder="城市名称" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="code" class="col-sm-2 control-label">城市编号</label>
                                    <div class="col-sm-10">
                                        <input id="code" type="text" name="code" placeholder="城市编号" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="pid" class="col-sm-2 control-label">父级类别</label>
                                    <div class="col-sm-10">
                                        <select id="pid" class="form-control m-b select2" name="pid">

                                            {!! region_select() !!}

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
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        idKey: "id",
                        pIdKey: "pid"
                    },
                    key: {
                        name: "name"
                    }
                },
                view:{
                    showIcon:true,
                    dblClickExpand:false,
                    showLine: false
                },
                callback: {
//                    beforeClick: beforeClick,
                    onClick: onClick
                }
            };
            var powerNodes = {!! json_encode($tempData) !!};


            function onClick(event, treeId, treeNode, clickFlag) {
                var id = treeNode.id;
                $.ajax({
                    url: "{{url('admin/region')}}/"+id+'/edit',
                    type: 'GET',
                    dataType: 'HTML',
                    cache:false,
                    beforeSend: function () {
                    },
                    success: function (data, textStatus, xhr) {
                        $("#right-content").html(data);
                    }
                });
            }

            $.fn.zTree.init($("#departments-tree"), setting, powerNodes);

            $("#search-dep").click(function(){
                var treeObj = $.fn.zTree.getZTreeObj("departments-tree");
                treeObj.reAsyncChildNodes(null, "refresh");
            });

        });

    </script>


    <script type="text/javascript">

        function add() {
            $.ajax({
                url: "{{ url('admin/region/create') }}",
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $("#right-content").html(data);
                }
            });
        }

        function deleteRegion(id) {
            swal({
                    title: title,
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
                url: "{{url('admin/region')}}",
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

@endsection