<?php

namespace AshleyUpson\LaraCMS\Controllers;

use App\Http\Controllers\Controller;
use AshleyUpson\LaraCMS\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request, Page $page = null)
    {
        $page = $page ?? Page::find($request->route()->getAction()['page']);

        if($page == null) abort(404);

        return \AshleyUpson\LaraCMS\LaraCMS::renderPage($page);
    }
}
