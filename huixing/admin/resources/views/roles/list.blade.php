@extends('admin::layout')

@section('css')
    <link rel="stylesheet" href="/vendor/admin/bootstrap-table/bootstrap-table.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="card">
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
    <script data-exec-on-popstate>
        $(document).on('pjax:complete', function (xhr) {
            $('#table').bootstrapTable({
                url: "{{ admin_base_path('api/roles/list') }}",
                columns: {!! json_encode($table_columns) !!}
            });
        });
    </script>
@endsection