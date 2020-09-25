@extends('admin::layout')

@section('css')
    <link rel="stylesheet" href="https://s3.pstatp.com/cdn/expire-1-M/nestable2/1.6.0/jquery.nestable.min.css">
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">

                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm dd-tree-tools" data-action="expand" title="展开">
                            <i class="fa fa-plus-square-o"></i>&nbsp;展开
                        </a>
                        <a class="btn btn-primary btn-sm dd-tree-tools" data-action="collapse" title="收起">
                            <i class="fa fa-minus-square-o"></i>&nbsp;收起
                        </a>
                    </div>

                    <div class="btn-group">
                        <a class="btn btn-info btn-sm dd-save" title="保存"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;保存</span></a>
                    </div>

                    <div class="btn-group">
                        <a class="btn btn-warning btn-sm dd-refresh" title="刷新"><i class="fa fa-refresh"></i><span class="hidden-xs">&nbsp;刷新</span></a>
                    </div>
                    <div class="btn-group">
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <div class="dd">
                        <ol class="dd-list">
                            @each('admin::menus.dd-item', Admin::menu(), 'item')
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">新增</h3></div>
                <form method="post" action="{{admin_base_path('auth/menu')}}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">父级菜单</label>
                            <div class="col-sm-10">
                                <select name="parent_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="0">ROOT</option>
                                    @foreach($menus as $item)
                                        <option value="{{$item['id']}}">{{$item['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3">*标题</label>
                            <input name="title" type="text" class="form-control" id="inputPassword3" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3">*图标</label>
                            <input name="icon" type="text" class="form-control" id="inputPassword3" placeholder="icon">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3">路径</label>
                            <input name="uri" type="text" class="form-control" id="inputPassword3" placeholder="uri">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3">角色</label>
                            <select name="roles[]" class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width: 100%;" data-select2-id="2" tabindex="-2" aria-hidden="true">
                                @foreach($roles as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3">权限</label>
                            <select name="permission" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option value="0">ROOT</option>
                                @foreach($permissions as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">重置</button>
                        <button type="submit" class="btn btn-default float-right">提交</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script src="https://s2.pstatp.com/cdn/expire-1-M/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script>
        $('body .dd').nestable([]);
        // 删除
        $('.tree_branch_delete').click(function() {
            var id = $(this).data('id');
            swal({
                title: "确认删除?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认",
                showLoaderOnConfirm: true,
                cancelButtonText: "取消",
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            method: 'post',
                            url: '/admin/auth/menu/' + id,
                            data: {
                                _method:'delete',
                                _token:LA.token,
                            },
                            success: function (data) {
                                $.pjax.reload('#pjax-container');
                                toastr.success('删除成功 !');
                                resolve(data);
                            }
                        });
                    });
                }
            }).then(function(result) {
                var data = result.value;
                if (typeof data === 'object') {
                    if (data.status) {
                        swal(data.message, '', 'success');
                    } else {
                        swal(data.message, '', 'error');
                    }
                }
            });
        });
        // 保存
        $('body .dd-save').on('click',function () {
            var serialize = $('.dd').nestable('serialize');

            $.post('/admin/auth/menu', {
                    _token: LA.token,
                    _order: JSON.stringify(serialize)
                },
                function(data){
                    $.pjax.reload('#pjax-container');
                    toastr.success('保存成功 !');
                });
        });
        // 刷新
        $('body .dd-refresh').on('click', function () {
            $.pjax.reload('#pjax-container');
            toastr.success('刷新成功 !');
        });
        // 展开
        $('body .dd-tree-tools').on('click', function(e){
            var action = $(this).data('action');
            if (action === 'expand') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse') {
                $('.dd').nestable('collapseAll');
            }
        });
    </script>
@endsection