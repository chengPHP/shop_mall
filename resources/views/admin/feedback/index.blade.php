@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('feedback'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{--<h5>个人日记管理</h5>--}}
                        @permission('create.feedback')
                        <a href="{{ url('admin/feedback/create') }}" class="btn btn-m btn-primary" id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                        @endpermission
                        @permission('destroy.feedback')
                        <button onclick="delFeedbacks()" class="btn btn-m btn-danger" id="add-btn"><i class="fa fa-trash-o"></i> 删除</button>
                        @endpermission
                        <div class="col-sm-5" style="float: right;" >
                            <div class="input-group">
                                <input type="text" id="search-text" placeholder="留言内容" value="{{$search}}" class="form-control">
                                <span class="input-group-btn">
                                  <button type="button" class="btn blue" id="simple-search"><i class="fa fa-search"></i> 查询</button>
                                  <a href="javascript:;" class="btn btn-outline btn-default" id="refreshTable"><i class="fa fa-refresh"></i> 刷新</a>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input class="icheck_input_all" type="checkbox"></th>
                                    <th>id</th>
                                    <th>状态</th>
                                    <th>留言内容</th>
                                    <th>时间</th>
                                    @permission('feedback')
                                    <th>设置</th>
                                    @endpermission
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $v)
                                    <tr>
                                        <td><input class="icheck_input" type="checkbox" value="{{$v['id']}}"></td>
                                        <td>{{$v['id']}}</td>
                                        <td>
                                            @if($v['status']==0)
                                                禁用
                                            @else
                                                启用
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                echo $v['content'];
                                            @endphp
                                        </td>
                                        <td>{{$v['created_at']}}</td>
                                        @permission('feedback')
                                        <td>
                                            @permission('edit.feedback')
                                            <a class="btn btn-xs btn-info" title="修改信息" href="{{url('admin/feedback')}}/{{$v['id']}}/edit" ><i class="fa fa-wrench"></i> 修改</a>
                                            @endpermission
                                            @permission('reply.feedback')
                                            <a class="btn btn-xs btn-success" title="回复留言" href="{{url('admin/feedback/reply')}}/{{$v['id']}}" ><i class="fa fa-mail-reply" ></i> 回复</a>
                                            @endpermission
                                            @permission('destroy.feedback')
                                            <span class="btn btn-xs btn-danger" title="删除类别" onclick="deleteFeedback('{{$v['id']}}')"><i class="fa fa-trash-o" ></i> 删除</span>
                                            @endpermission
                                        </td>
                                        @endpermission
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$list->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

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
        function updateFeedback(id) {
            $.ajax({
                url: "{{url('admin/feedback')}}/"+id+'/edit',
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $(".bs-example-modal-md .modal-content").html(data);
                }
            });
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

        function deleteFeedback(id) {
            deleteItems(id,"{{url('admin/feedback')}}","确定删除该留言吗？");
        }

        function delFeedbacks() {
            var checkStatus = $("tbody input[type='checkbox']:checked");
            if(checkStatus.length >= 1){
                var ids = [];
                $.each(checkStatus,function(i,v){
                    ids.push(v.value);
                });
                ids = ids.toString();
                deleteItems(ids,"{{url('admin/feedback')}}","确定删除这些留言吗？");

            }else{
                swal("请选择至少一条数据！", "", "warning");
            }
        }
        $("#simple-search").on('click',function () {
            window.location.href = "{{url('admin/feedback')}}?search="+$("#search-text").val();
        });
    </script>

@endsection