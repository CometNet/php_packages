@extends('admin::layout')

@section('css')
    <link rel="stylesheet" href="/vendor/admin/bootstrap-table/bootstrap-table.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <div class="btn-group pull-right grid-create-btn" style="margin-right: 10px">
                        <a href="/admin/auth/permissions/create" class="btn btn-sm btn-success" title="新增">
                            <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;新增</span>
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table id="table"></table>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
@section('script')
    <script src="/vendor/admin/bootstrap-table/bootstrap-table.min.js"></script>
    <script>
        $('#table').bootstrapTable({
            url: "{{ admin_base_path('api/permissions/list') }}",
            columns: {!! json_encode($table_columns) !!}
        });
    </script>
@endsection