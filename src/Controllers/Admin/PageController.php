<?php

namespace LaraCMS\Controllers\Admin;

use App\Http\Controllers\Controller;
use LaraCMS\Models\CustomRoute;
use LaraCMS\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with(['theme'])->get();

        return view('laracms::themes.default.admin.pages.index', [
            'pages' => $pages
        ]);
    }

    public function create()
    {
        return view('laracms::themes.default.admin.pages.create');
    }

    public function store(Request $request)
    {
        $type = $request->get('type');
        $name = $request->get('name');
        $title = $request->get('title');
        $published = $request->get('is_published');
        $navigation = $request->get('show_navigation');
        $route = $request->get('custom_route');

        $page = Page::create([
            'type' => $type,
            'name' => $name,
            'title' => $title,
            'is_published' => $published != null ? 1 : 0,
            'show_navigation' => $navigation != null ? 1 : 0
        ]);

        if($route != null) {
            CustomRoute::create([
                'page_id' => $page->id,
                'request_method' => 'get',
                'custom_route' => $route,
                'is_published' => $published != null ? 1 : 0
            ]);
        }

        return redirect()->route('laracms::get.admin/pages/create')->with('success', 'Page (' . $name . ') created successfully');
    }
}
