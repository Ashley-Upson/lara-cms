@extends('laracms::themes.default.layouts.master')

@section('title')
    Admin - View Pages
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
        <div class="col-lg-12">
            <table class="table table-responsive table-condensed">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Theme
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Published
                        </th>
                        <th>
                            Show Navigation
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>
                                {{ $page->id }}
                            </td>
                            <td>
                                {{ $page->theme === null ? 'Default' : $page->theme->name }}
                            </td>
                            <td>
                                {{ $page->name }}
                            </td>
                            <td>
                                {{ $page->title }}
                            </td>
                            <td>
                                {{ $page->is_published === true ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                {{ $page->show_navigation === true ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                {{ $page->type }}
                            </td>
                            <td>
                                <a href="{{ route('laracms::get.admin/pages/edit', $page->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                |

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                No pages.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection