@extends('laracms::themes.default.layouts.master')

@section('title')
    Register
@endsection

@section('navigation')
    @include('laracms::themes.default.layouts.navigation', ['navbar' => \LaraCMS\LaraCMS::getNavbar()])
@endsection

@section('content')
    @if(session()->get('error'))
        <div class="alert alert-warning">
            {{ session()->get('error') }}
        </div>
    @endif
    <form class="form col-lg-6" name="register_form" action="{{ route('post.auth/register') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Name
                </span>
            </div>
            <input type="text" name="name" class="form-control" placeholder="Name..." value="{{ session()->get('name') }}" required />
        </div><div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Email
                </span>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Email address..." value="{{ session()->get('email') }}" required />
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
                    Confirm Password
                </span>
            </div>
            <input type="password" name="password_confirm" class="form-control" placeholder="Confirm password..." required />
        </div>
        <div class="input-group input-group-sm">
            <button type="submit" class="btn btn-sm btn-success">
                Register
            </button>
        </div>
    </form>
@endsection
