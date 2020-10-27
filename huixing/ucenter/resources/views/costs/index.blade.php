@extends(Request::instance()->layout)

@section('content')
    <link rel="stylesheet" href="/vendor/admin/bootstrap-table/bootstrap-table.min.css">
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

@endsection