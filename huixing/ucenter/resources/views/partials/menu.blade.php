@if(isset($item['children']))
    <li class="nav-item treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas {{$item['icon']}}"></i>
            <p>
                {{ $item['title'] }}
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview treeview-menu">
            @foreach($item['children'] as $item)
                @include('ucenter::partials.menu', $item)
            @endforeach
        </ul>
    </li>
@else
    <li class="nav-item treeview">
        @if(url()->isValidUrl($item['uri']))
            <a class="nav-link" href="{{ $item['uri'] }}" target="_blank">
        @else
            <a class="nav-link" href="{{ "/ucenter/" . $item['uri'] }}">
        @endif
        <i class="nav-icon fas {{$item['icon']}}"></i>
        <p>
            {{ $item['title'] }}
        </p>
        </a>
    </li>
@endif