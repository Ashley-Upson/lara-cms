@extends('laracms::themes.default.layouts.master')

@section('title')
    Admin - Create page
@endsection

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/codemirror.css') }}">
    <script type="text/javascript" src="{{ asset('js/codemirror.js') }}"></script>
    <script type="text/javascript">
        var editor = CodeMirror.fromTextArea(myTextarea, {
            lineNumbers: true
        });
    </script>
@endsection

@section('navigation')
    @if($page->show_navigation == 1)
        @include('laracms::themes.default.layouts.navigation', ['navbar' => \AshleyUpson\LaraCMS\LaraCMS::getNavbar()])
    @endif
@endsection

@section('content')
    @if(session('success') != null)
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form name="create_page" class="form col-lg-6" action="{{ route('laracms::post.admin/pages/store') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Type *
                </span>
            </div>
            <select name="type" class="form-control" required>
                <option selected="selected" disabled>Page type...</option>
                @foreach(\AshleyUpson\LaraCMS\LaraCMS::getPageTypes() as $type)
                    <option value="{{ $type->value }}">{{ $type->label }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Name *
                </span>
            </div>
            <input type="text" name="name" class="form-control" required placeholder="Name..." />
        </div>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Title *
                </span>
            </div>
            <input type="text" name="title" class="form-control" required placeholder="Title..." />
        </div>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <input type="checkbox" name="is_published" id="is_published">
                </span>
            </div>
            <label class="form-control" for="is_published">
                Publish
            </label>
        </div>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <input type="checkbox" name="show_navigation" id="show_navigation">
                </span>
            </div>
            <label class="form-control" for="show_navigation">
                Show Navigation Bar
            </label>
        </div>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Custom route
                </span>
            </div>
            <input type="text" name="custom_route" class="form-control" placeholder="Custom route..." />
        </div>
        <div class="input-group input-group-sm">
            <button type="submit" class="btn btn-sm btn-success">
                Add page
            </button>
        </div>
    </form>
@endsection