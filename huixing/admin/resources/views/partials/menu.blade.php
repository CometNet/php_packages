@if(Admin::user()->visible(\Illuminate\Support\Arr::get($item, 'roles', [])) && Admin::user()->can(\Illuminate\Support\Arr::get($item, 'permission')))
    @if(isset($item['children']))
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas {{$item['icon']}}"></i>
                <p>
                    {{ $item['title'] }}
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">6</span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @foreach($item['children'] as $item)
                    @include('admin::partials.menu', $item)
                @endforeach
            </ul>
        </li>
    @else
        <li class="nav-item">
            @if(url()->isValidUrl($item['uri']))
                <a class="nav-link" href="{{ $item['uri'] }}" target="_blank">
            @else
                <a class="nav-link" href="{{ admin_url($item['uri']) }}">
            @endif
            <i class="nav-icon fas {{$item['icon']}}"></i>
            <p>
                {{ $item['title'] }}
                <span class="right badge badge-danger">New</span>
            </p>
            </a>
        </li>
    @endif
@endif