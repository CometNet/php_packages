@extends(Request::instance()->layout)

@section('content')
    @include('admin::partials.content-header',['title' => '权限管理'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">创建 <small>权限</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ admin_url('auth/permissions') }}" id="quickForm" novalidate="novalidate">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">标识</label>
                                    <input type="text" name="slug" class="form-control" id="exampleInputEmail1" placeholder="Enter slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">名称</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">HTTP方法</label>
                                    <select name="http_method[]" class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach($http_methods as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">HTTP路径</label>
                                    <input type="text" name="http_path" class="form-control" id="exampleInputPassword1" placeholder="http_path">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection