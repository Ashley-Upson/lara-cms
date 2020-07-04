@extends('laracms::themes.default.layouts.master')

@section('title')
    {{ $page->title }}
@endsection

@section('navigation')
    @if($page->show_navigation == 1)
        @include('laracms::themes.default.layouts.navigation', ['navbar' => $navbar])
    @endif
@endsection

@section('content')
    @foreach($page->content as $content)
        <div class="row">
            <div class="col-lg-12">
                @include(($content->type == 'view' ? ('laracms::themes.default.' . $content->content) : ('laracms::themes.default.content.' . $content->type)), ['content' => $content])
            </div>
        </div>
    @endforeach
@endsection