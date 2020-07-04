@extends('laracms::themes.default.layouts.master')

@section('title')
    Login
@endsection

@section('navigation')
    @include('laracms::themes.default.layouts.navigation', ['navbar' => \AshleyUpson\LaraCMS\LaraCMS::getNavbar()])
@endsection

@section('content')
    @if(session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    <form class="form col-lg-6" name="login_form" action="{{ route('laracms::post.auth/login') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="next" value="{{ session('next') }}" />
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Email
                </span>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Email address..." value="{{ session('email') }}" required />
        </div>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Password
                </span>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Password..." required />
        </div>
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <input type="checkbox" name="remember" id="remember" {{ session('remember') != null ? 'checked' : '' }} />
                </span>
            </div>
            <label class="form-control" for="remember">
                Remember me
            </label>
        </div>
        <div class="input-group input-group-sm">
            <button type="submit" class="btn btn-sm btn-success">
                Login
            </button>
        </div>
    </form>
@endsection
