@extends('admin::layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">修改 <small>菜单</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ admin_url("auth/menu/$menu->id") }}" id="quickForm" novalidate="novalidate">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="id" type="hidden" value="{{ $menu->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">父级菜单</label>
                                    <div class="col-sm-10">
                                        <select name="parent_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                                            <option value="0">ROOT</option>
                                            @foreach($menus as $item)
                                                @if ($item['id'] == $menu->parent_id)
                                                    <option selected value="{{$item['id']}}">{{$item['title']}}</option>
                                                @else
                                                    <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">*标题</label>
                                    <div class="col-sm-10">
                                        <input name="title" value="{{ $menu->title }}" type="text" class="form-control" id="inputPassword3" placeholder="Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">*图标</label>
                                    <div class="col-sm-10">
                                        <input name="icon" value="{{ $menu->icon }}" type="text" class="form-control" id="inputPassword3" placeholder="icon">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">路径</label>
                                    <div class="col-sm-10">
                                        <input name="uri" value="{{ $menu->uri }}" type="text" class="form-control" id="inputPassword3" placeholder="uri">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">角色</label>
                                    <div class="col-sm-10">
                                        <select name="roles[]" class="form-control select2 select2-hidden-accessible" multiple="multiple" style="width: 100%;" data-select2-id="2" tabindex="-2" aria-hidden="true">
                                            @foreach($menu->roles as $item)
                                                @php($_roles[] = $item->id)
                                            @endforeach
                                            @foreach($roles as $item)
                                                @if(in_array($item['id'],$_roles))
                                                    <option selected value="{{$item['id']}}">{{$item['name']}}</option>
                                                @else
                                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">权限</label>
                                    <div class="col-sm-10">
                                        <select name="permission" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0">ROOT</option>
                                            @foreach($permissions as $item)
                                                @if($menu->permission == $item['id'])
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