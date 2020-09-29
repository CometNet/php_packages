@if(isset($item['children']))
    <li class="dd-item" data-id="{{$item['id']}}">
        <div class="dd-handle">
            <i class="fa {{$item['icon']}}"></i>
            <strong>{{$item['title']}}</strong>
            <span class="float-right dd-nodrag">
                <a href="/admin/auth/menu/{{ $item['id'] }}/edit"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" data-id="1" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
            </span>
        </div>
        <ol class="dd-list">
            @foreach($item['children'] as $item)
                @include('admin::menus.dd-item', $item)
            @endforeach
        </ol>
    </li>
@else
    <li class="dd-item" data-id="{{$item['id']}}">
        <div class="dd-handle">
            <i class="fa {{$item['icon']}}"></i>
            <strong>{{$item['title']}}</strong>
            <span class="float-right dd-nodrag">
                <a href="/admin/auth/menu/{{ $item['id'] }}/edit"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" data-id="1" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
            </span>
        </div>
    </li>
@endif