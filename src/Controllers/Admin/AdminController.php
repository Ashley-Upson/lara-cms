<?php

namespace LaraCMS\Controllers\Admin;

use App\Http\Controllers\Controller;
use LaraCMS\Models\CustomRoute;
use LaraCMS\Models\Page;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('laracms::themes.default.admin.index');
    }

    public function create()
    {
        return view('laracms::themes.default.admin.pages.create');
    }
}
