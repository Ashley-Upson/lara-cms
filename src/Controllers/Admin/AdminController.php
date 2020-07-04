<?php

namespace AshleyUpson\LaraCMS\Controllers\Admin;

use App\Http\Controllers\Controller;
use AshleyUpson\LaraCMS\Models\CustomRoute;
use AshleyUpson\LaraCMS\Models\Page;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('laracms::themes.default.admin.index', [
            'page' => (object)[
                'show_navigation' => 1
            ]
        ]);
    }

    public function create()
    {
        return view('laracms::themes.default.admin.pages.create', [
            'page' => (object)[
                'show_navigation' => 1
            ]
        ]);
    }
}
