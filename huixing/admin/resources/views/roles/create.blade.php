@extends(Request::instance()->layout)

@section('content')
    @include('admin::partials.content-header',['title' => '角色管理'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">创建 <small>角色</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ admin_url('auth/roles') }}" id="quickForm" novalidate="novalidate">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="slug">标识</label>
                                    <input type="text" name="slug" class="form-control" id="exampleInputEmail1" placeholder="Enter slug">
                                </div>
                                <div class="form-group">
                                    <label for="name">名称</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="http_method">权限</label>
                                    <select name="http_method[]" class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach($permissions as $item)
                                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
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
        </div><!-- /.container-fluid -->
    </section>
@endsection
