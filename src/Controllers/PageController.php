<?php

namespace LaraCMS\Controllers;

use App\Http\Controllers\Controller;
use LaraCMS\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request, Page $page = null)
    {
        $page = $page ?? Page::find($request->route()->getAction()['page']);

        if($page == null) abort(404);

        return \LaraCMS\LaraCMS::renderPage($page);
    }
}
