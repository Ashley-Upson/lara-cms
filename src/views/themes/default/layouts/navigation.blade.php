<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">
        {{ env('APP_NAME') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            @foreach($navbar as $item)
                @if($item->type == 'dropdown')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="nav-dropdown-{{ $item->id }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $item->text }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="nav-dropdown-{{ $item->id }}">
                            @foreach($item->children as $child)
                                @if($child->type == 'link')
                                    <a class="dropdown-item" href="{{ $child->page_id != null ? route('get.page', $child->page_id) : ($child->route_name == null ? $child->url : route($child->route_name)) }}">{{ $child->text }}</a>
                                @elseif($child->type == 'text')
                                    <span class="dropdown-item disabled">{{ $child->text }}</span>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @elseif($item->type == 'link')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $item->page_id != null ? route('get.page', $item->page_id) : ($item->route_name == null ? $item->url : route($item->route_name)) }}">{{ $item->text }}</a>
                    </li>
                @elseif($item->type == 'text')
                    <li class="nav-item">
                        <span class="nav-link disabled">{{ $item->text }}</span>
                    </li>
                @endif
            @endforeach
{{--            <li class="nav-item active">--}}
{{--                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">Pricing</a>--}}
{{--            </li>--}}
        </ul>
    </div>
</nav>
