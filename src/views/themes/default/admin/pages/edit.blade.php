@extends('laracms::themes.default.layouts.master')

@section('title')
    Admin - Edit Page - {{ $page->name }}
@endsection

@section('header')

@endsection

@section('navigation')
    @include('laracms::themes.default.layouts.navigation', ['navbar' => \LaraCMS\LaraCMS::getNavbar()])
@endsection

@section('content')
    @if(session('success') != null)
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <form name="edit_page_{{ $page->id }}" class="form" action="{{ route('laracms::put.admin/pages/update', $page->id) }}" method="post">
                {{ csrf_field() }}
                @method('put')
                <p>
                    Page Details
                </p>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            Name *
                        </span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Name..."  value="{{ $page->name }}" required />
                </div>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            Title *
                        </span>
                    </div>
                    <input type="text" name="title" class="form-control" placeholder="Title..."  value="{{ $page->title }}" required />
                </div>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            Page Type *
                        </span>
                    </div>
                    <select name="type" class="form-control">
                        @foreach(\LaraCMS\LaraCMS::getPageTypes() as $type)
                            <option value="{{ $type->value }}">{{ $type->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" name="is_published" id="is_published" {{ $page->is_published === true ? 'checked' : '' }}>
                        </span>
                    </div>
                    <label class="form-control" for="is_published">
                        Published
                    </label>
                </div>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" name="show_navigation" id="show_navigation" {{ $page->show_navigation === true ? 'checked' : '' }}>
                        </span>
                    </div>
                    <label class="form-control" for="show_navigation">
                        Show Navigation
                    </label>
                </div>
                <div class="input-group input-group-sm">
                    <button type="submit" class="btn btn-sm btn-success">
                        Update Page
                    </button>
                </div>
            </form>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <p>
                Routes assigned to this page:
            </p>

            <ul>
                @forelse($page->routes as $route)
                    <li>
                        <a href="{{ url($route->custom_route) }}">
                            {{ url($route->custom_route) }}
                        </a>
                    </li>
                @empty
                    <li>
                        No custom routes.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="float-right">
                <a href="{{ route('laracms::get.admin/pages/content/create', $page->id) }}" class="btn btn-sm btn-success">
                    Add New Content
                </a>
            </div>
            <p>
                Page Content
            </p>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            HTML
                        </th>
                        <th>
                            Hidden
                        </th>
                        <th>
                            Order
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($page->content as $content)
                        <tr>
                            <td>
                                {{ $content->id }}
                            </td>
                            <td>
                                {{ $content->title }}
                            </td>
                            <td>
                                {{ $content->type }}
                            </td>
                            <td>
                                {{ $content->is_html === true ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                {{ $content->is_hidden === true ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                {{ $content->order }}
                            </td>
                            <td>
                                <a href="{{ route('laracms::get.admin/pages/content/edit', ['page' => $page->id, 'content' => $content->id]) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                No page content.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
