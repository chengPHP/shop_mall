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
                        {{--<h5>文章管理列表</h5>--}}
                        @permission('create.article')
                        <a href="{{ url('admin/article/create') }}"  class="btn btn-m btn-primary" id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                        @endpermission
                        @permission('destroy.article')
                        <button onclick="delArticles()" class="btn btn-m btn-danger" id="add-btn"><i class="fa fa-trash-o"></i> 删除</button>
                        @endpermission
                        <div class="col-sm-5" style="float: right;" >
                            <div class="input-group">
                                <input type="text" id="search-text" placeholder="文章标题名称" value="{{$search}}" class="form-control">
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
                                    <th>标题名称</th>
                                    <th>关键词</th>
                                    <th>所属类别</th>
                                    <th>作者</th>
                                    <th>图片</th>
                                    <th>阅读量</th>
                                    @permission('article')
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
                                                关闭
                                            @else
                                                开启
                                            @endif
                                        </td>
                                        <td>{{$v['title']}}</td>
                                        <td>{{$v['tags']}}</td>
                                        <td>{{$v['category']['name']}}</td>
                                        <td>{{$v['user']['name']}}</td>
                                        <td>
                                            @foreach($v['files'] as $v_file)
                                                <a href="{{url($v_file['path'])}}" data-lightbox="roadtrip">
                                                    <image src="{{url($v_file['path'])}}" style="max-width: 50px;max-height: 50px;" ></image>
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>{{$v['read_num']}}</td>
                                        @permission('article')
                                        <td>
                                            @permission('edit.article')
                                            <a class="btn btn-xs btn-info" title="修改文章" href="{{url('admin/article/'.$v['id'].'/edit')}}" ><i class="fa fa-wrench"></i> 修改</a>
                                            @endpermission
                                            @permission('destroy.article')
                                            <span class="btn btn-xs btn-danger" title="删除文章" onclick="deleteArticle('{{$v['id']}}')"><i class="fa fa-trash-o"></i> 删除</span>
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

        function updateArticle(id) {
            $.ajax({
                url: "{{url('admin/article')}}/"+id+'/edit',
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

        function deleteArticle(id) {
            deleteItems(id,"{{url('admin/article')}}","确定删除该文章吗？");
        }

        function delArticles() {
            var checkStatus = $("tbody input[type='checkbox']:checked");
            if(checkStatus.length >= 1){
                var ids = [];
                $.each(checkStatus,function(i,v){
                    ids.push(v.value);
                });
                ids = ids.toString();
                deleteItems(ids,"{{url('admin/article')}}","确定删除这些文章吗？");

            }else{
                swal("请选择至少一条数据！", "", "warning");
            }

        }

        $("#simple-search").on('click',function () {
            window.location.href = "{{url('admin/article')}}?search="+$("#search-text").val();
        });

    </script>

@endsection