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
                        {{--<h5>修改文章信息</h5>--}}
                        {{--<a href="{{ url('admin/article/create') }}" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn blue " id="add-btn"><i class="fa fa-plus"></i> 添加</a>--}}
                        <a href="{{ url('admin/article/create') }}" class="btn btn-m btn-primary" id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('admin/article')}}/{{$info->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">标题名称</label>
                                <div class="col-sm-10">
                                    <input id="title" type="text" name="title" value="{{$info->title}}" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label for="category_id" class="col-sm-2 control-label">文章类别</label>
                                <div class="col-sm-10">
                                    <select id="category_id" class="form-control m-b select2" name="category_id">
                                        <option value="0">请选择</option>
                                        @foreach($category as $v)
                                            <option value="{{$v['id']}}" {{$v['id']==$info->category_id? 'selected' :''}} >{{$v['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label for="descr" class="col-sm-2 control-label">文章简介</label>
                                <div class="col-sm-10">
                                    <input id="descr" type="text" name="descr" value="{{$info->descr}}" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label for="editor" class="col-sm-2 control-label">文章内容</label>
                                <div class="col-sm-10">
                                    <script id="editor" type="text/plain" style="width:100%;height:200px;">
                                        @php
                                            echo htmlspecialchars_decode($info->art);
                                        @endphp

                                    </script>
                                    <script type="text/javascript">

                                    //实例化编辑器
                                    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                    var ue = UE.getEditor('editor');
                                    </script>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label for="tags" class="col-sm-2 control-label">关键词</label>
                                <div class="col-sm-10">
                                    <input id="tags" type="text" name="tags" value="{{$info->tags}}" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">
                                    <div class="radio radio-info radio-inline">
                                        <input class="icheck_input" type="radio" id="inlineRadio1" value="1" name="status" {{$info->status==1 ? 'checked': ''}}>
                                        <label for="inlineRadio1">启用 </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input class="icheck_input" type="radio" id="inlineRadio2" value="0" name="status" {{$info->status==0 ? 'checked': ''}}>
                                        <label for="inlineRadio2">禁用 </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{--<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>--}}
                                <button type="button" onclick="fanhui()" class="btn btn-default">取消</button>
                                <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                url: "{{url('admin/article')}}/{{$info->id}}",
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

        function fanhui() {
            window.location.href="{{url('admin/article')}}";
        }

    </script>

@endsection
