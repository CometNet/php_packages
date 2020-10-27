@extends(Request::instance()->layout)

@section('content')
    @include('admin::partials.content-header',['title' => '用户管理'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">创建 <small>用户</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ admin_url('auth/users') }}" id="quickForm" novalidate="novalidate">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">用户名</label>
                                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">名称</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">头像</label>
                                    <input type="text" name="avatar" class="form-control" id="exampleInputPassword1" placeholder="avatar">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">密码</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">权限</label>
                                    <select name="http_method[]" class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach($permissions as $item)
                                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">角色</label>
                                    <div class="col-sm-10">
                                        <select name="roles[]" class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width: 100%;" data-select2-id="2" tabindex="-2" aria-hidden="true">
                                            @foreach($roles as $item)
                                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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