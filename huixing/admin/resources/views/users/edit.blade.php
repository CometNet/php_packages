@extends('admin::layout')

@section('css')
    <link rel="stylesheet" href="/vendor/admin/select2/dist/css/select2.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">更新 <small>用户</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ admin_url("auth/users/$user->id") }}" id="quickForm" novalidate="novalidate">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="id" type="hidden" value="{{ $user->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">用户名</label>
                                    <input type="text" name="username" class="form-control" value="{{$user->username}}" id="exampleInputEmail1" placeholder="Enter slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">名称</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" id="exampleInputPassword1" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">头像</label>
                                    <input type="text" name="avatar" class="form-control" value="{{$user->avatar}}" id="exampleInputPassword1" placeholder="avatar">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">密码</label>
                                    <input type="password" name="password" class="form-control" value="{{$user->password}}" id="exampleInputPassword1" placeholder="password">
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">角色</label>
                                    <select name="roles[]" class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width: 100%;" data-select2-id="2" tabindex="-2" aria-hidden="true">
                                        @foreach($user->roles as $item)
                                            @php($_roles[] = $item->id)
                                        @endforeach
                                        @foreach($roles as $item)
                                            @if(isset($_roles) && in_array($item['id'],$_roles))
                                                <option selected value="{{$item['id']}}">{{$item['name']}}</option>
                                            @else
                                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">权限</label>
                                    <select name="permission" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="0">ROOT</option>
                                        @foreach($permissions as $item)
                                            @if($user->permission == $item['id'])
                                                <option selected value="{{$item['id']}}">{{$item['name']}}</option>
                                            @else
                                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endif
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
@section('script')
    <script src="/vendor/admin/select2/dist/js/select2.min.js"></script>
    <script>
        $(".select2").select2({
            placeholder: "Select a state",
            allowClear: true,
        });
    </script>
@endsection