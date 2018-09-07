@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('work'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{--<h5>文章管理列表</h5>--}}
                        {{--@permission('create.work')--}}
                        <a href="{{ url('admin/work/create') }}"  class="btn btn-m btn-primary" id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                        {{--@endpermission--}}
                        {{--@permission('destroy.work')--}}
                        <button onclick="delWorks()" class="btn btn-m btn-danger" id="add-btn"><i class="fa fa-trash-o"></i> 关闭</button>
                        {{--@endpermission--}}
                        <div class="col-sm-5" style="float: right;" >
                            <div class="input-group">
                                <input type="text" id="search-text" placeholder="工作名称" value="" class="form-control">
                                <span class="input-group-btn">
                                  <button type="button" class="btn blue" id="simple-search"><i class="fa fa-search"></i> 查询</button>
                                  <a href="javascript:;" class="btn btn-outline btn-default" id="refreshTable"><i class="fa fa-refresh"></i> 刷新</a>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="ibox-content">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="{{$status==0?'active':''}}"><a href="{{ url('admin/work?status=0') }}"> 新建工作</a></li>
                            <li class="{{$status==1?'active':''}}"><a href="{{ url('admin/work?status=1') }}"> 正在进行中</a></li>
                            <li class="{{$status==2?'active':''}}"><a href="{{ url('admin/work?status=2') }}"> 已完成</a></li>
                            <li class="{{$status==3?'active':''}}"><a href="{{ url('admin/work?status=3') }}"> 未完成</a></li>
                            <li class="{{$status==-1?'active':''}}"><a href="{{ url('admin/work?status=-1') }}"> 已关闭</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" style="margin-top: 20px;">
                            <div id="tab-1" class="tab-pane active">
                                <div class="table-responsive m-b-md">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th><input class="icheck_input_all" type="checkbox" onclick="sltAll(this)"></th>
                                            <th>id</th>
                                            <th>状态</th>
                                            <th>contents工作内容</th>
                                            <th>工作计划开始时间</th>
                                            <th>工作计划完成时间</th>
                                            @if($status>1)
                                            <th>工作真实开始时间</th>
                                            <th>工作真实完成时间</th>
                                            @endif
                                            @if($status>=2)
                                            <th>工作结果详情</th>
                                            @endif
                                            <th>设置</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($work_list as $v)
                                                <td><input class="icheck_input" type="checkbox" value="{{$v['id']}}"></td>
                                                <td>{{$v['id']}}</td>

                                                <td>
                                                    @if($v['status']==-1)
                                                        <span class="label label-danger" >已取消</span>
                                                    @elseif($v['status']==0)
                                                        <span class="label label-info" >新建</span>
                                                    @elseif($v['status']==1)
                                                        <span class="label label-info" >进行中</span>
                                                    @elseif($v['status']==2)
                                                        <span class="label label-success" >已完成</span>
                                                    @elseif($v['status']==3)
                                                        <span class="label label-warning" >未完成</span>
                                                    @endif
                                                </td>

                                                <td>{{$v['contents']}}</td>
                                                <td>{{$v['plan_start_time']}}</td>
                                                <td>{{$v['plan_end_time']}}</td>
                                                @if($status>1)
                                                <td>{{$v['start_time']}}</td>
                                                <td>{{$v['end_time']}}</td>
                                                @endif
                                                @if($status>=2)
                                                <td>{{$v['work_result']}}</td>
                                                @endif
                                                <td>
                                                    <span class="btn btn-xs btn-info" onclick="showInfo('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-lg">详情</span>
                                                    @if($status==0)
                                                    <a class="btn btn-xs btn-primary" href="{{url('admin/work/'.$v['id'].'/edit')}}" >修改</a>
                                                    <span class="btn btn-xs btn-primary" onclick="start_work('{{$v['id']}}')">开始</span>
                                                    @endif
                                                    @if($status==1)
                                                    <span class="btn btn-xs btn-success" onclick="complete_work('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-lg" >完成</span>
                                                    @endif
                                                    <span class="btn btn-xs btn-danger" onclick="deleteWork('{{$v['id']}}')" >关闭</span>
                                                </td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function(){
            $('.icheck_input,.icheck_input_all').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
            }).iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            //全选
            $('.icheck_input_all').on('ifChecked', function(event){
                $('.icheck_input').iCheck('check')
            });

            //全不选
            $('.icheck_input_all').on('ifUnchecked', function(event){
                $('.icheck_input').iCheck('uncheck')
            });
        });


        function start_work(id) {
            $.ajax({
                url: "{{route('work.start_work')}}",
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": '{{csrf_token()}}',
                    'id': id
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
        }

        function complete_work(id) {
            $.ajax({
                url: "{{url('admin/work/do_complete_work')}}/"+id,
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $(".bs-example-modal-lg .modal-content").html(data);
                }
            });
        }



        function showInfo(id) {
            $.ajax({
                url: "{{url('admin/work')}}/"+id,
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $(".bs-example-modal-lg .modal-content").html(data);
                }
            });
        }

        //全选/全不选
        function sltAll(object) {
            if(object.checked){
                $("table tbody input[type=checkbox]").attr("checked",true);
            }else{
                $("table tbody input[type=checkbox]").attr("checked",false);
            }
        }

        function deleteItems(ids,url,title) {
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
                        url: url+'/'+ids,
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

        function deleteWork(id) {
            deleteItems(id,"{{url('admin/work')}}","确定关闭该工作计划吗？");
        }

        function delWorks() {
            var checkStatus = $("tbody input[type='checkbox']:checked");
            if(checkStatus.length >= 1){
                var ids = [];
                $.each(checkStatus,function(i,v){
                    ids.push(v.value);
                });
                ids = ids.toString();
                deleteItems(ids,"{{url('admin/work')}}","确定关闭这些工作计划吗？");

            }else{
                swal("请选择至少一条数据！", "", "warning");
            }

        }

        $("#simple-search").on('click',function () {
            var status = "{{$status}}";
            window.location.href = "{{url('admin/work?status=0')}}&?search="+$("#search-text").val();

        });

    </script>

@endsection