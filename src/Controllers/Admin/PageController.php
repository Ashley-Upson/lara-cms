<?php

namespace AshleyUpson\LaraCMS\Controllers\Admin;

use App\Http\Controllers\Controller;
use AshleyUpson\LaraCMS\Models\CustomRoute;
use AshleyUpson\LaraCMS\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function create()
    {
        return 'creating a page';
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

        return redirect()->route('get.admin/add-page')->with('success', 'Page (' . $name . ') created successfully');
    }
}
