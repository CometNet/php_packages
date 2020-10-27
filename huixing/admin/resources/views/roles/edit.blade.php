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
                            <h3 class="card-title">修改 <small>角色</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ admin_url("auth/roles/$role->id") }}" id="quickForm" novalidate="novalidate">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="id" type="hidden" value="{{ $role->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">*标识</label>
                                    <div class="col-sm-10">
                                        <input name="slug" value="{{ $role->slug }}" type="text" class="form-control" id="inputPassword3" placeholder="Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">*名称</label>
                                    <div class="col-sm-10">
                                        <input name="name" value="{{ $role->name }}" type="text" class="form-control" id="inputPassword3" placeholder="icon">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="http_method" class="col-sm-2 col-form-label">权限</label>
                                    <div class="col-sm-10">
                                        <select name="http_method[]" class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            @foreach($role->permissions as $item)
                                                @php($_permissions[] = $item->id)
                                            @endforeach
                                            @foreach($permissions as $item)
                                                @if(isset($_permissions) && in_array($item['id'],$_permissions))
                                                    <option selected value="{{$item['id']}}">{{$item['name']}}</option>
                                                @else
                                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                @endif
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