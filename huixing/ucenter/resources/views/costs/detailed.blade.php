@extends(Request::instance()->layout)

@section('content')
    <link rel="stylesheet" href="/vendor/admin/bootstrap-table/bootstrap-table.min.css">
    @include('ucenter::partials.content-header',['title' => '充值明细'])
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="pull-right">
                        <div class="btn-group pull-right grid-create-btn" style="margin-right: 10px">
                            <a href="/admin/auth/users/create" class="btn btn-sm btn-success" title="新增">
                                <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;新增</span>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-hover table-striped table-sm"></table>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
@section('script')
    <script src="/vendor/admin/bootstrap-table/bootstrap-table.min.js"></script>
    <script>
        function operateFormatter(value, row, index) {
            return [
                '<a class="mod" href="javascript:void(0)" title="修改">',
                '<i class="fa fa-user-edit"></i>',
                '</a>  ',
                '<a class="remove" href="javascript:void(0)" title="删除">',
                '<i class="fa fa-user-minus"></i>',
                '</a>'
            ].join('');
        }
        window.operateEvents = {
            'click .mod': function (e, value, row, index) {
                window.location.href = window.location.href + '/' + row.id + '/edit';
            },
            'click .remove': function (e, value, row, index) {
                var r = confirm("是否确定删除？")
                if (r == true) {
                    var cId = [row.cId];
                    $.post("apiContacterStatus.php", {
                        cId: cId,
                        status: 3
                    }, function (data) {
                        if (data) {
//                            $('#tb_departments').bootstrapTable(('refresh'));
                            $table.bootstrapTable(('refresh'));
                        }
                    });
                    $("#selectClient").prop('disabled', true);
                    $remove.prop('disabled', true);
                }
            }
        };
        $(document).ready(function() {
            $('#table').bootstrapTable({
                {{--url: "{{ admin_base_path('api/users/list') }}",--}}
                {{--columns: {!! json_encode($table_columns) !!}--}}
            });
        });
    </script>
@endsection