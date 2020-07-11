@extends('laracms::themes.default.layouts.master')

@section('title')
    Admin - Index
@endsection

@section('header')

@endsection

@section('navigation')
    @include('laracms::themes.default.layouts.navigation', ['navbar' => \LaraCMS\LaraCMS::getNavbar()])
@endsection

@section('left-sidebar')
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('laracms::get.admin/pages/index') }}">
                View Pages
            </a>
            <br />
            <a href="{{ route('laracms::get.admin/pages/create') }}">
                Add Page
            </a>
            <br />
            View Custom Routes
            <br />
            Add Custom Route
            <br />
            View Forms
            <br />
            Create New Form
            <br />
            Manage Navigation
        </div>
    </div>
@endsection

@section('content')
    @if(session('success') != null)
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <h3>
                Welcome to LaraCMS by Auraware Development!
            </h3>
            <p>
                Please see some options to your side, and below are some statistics from the CMS
            </p>
        </div>
    </div>
@endsection