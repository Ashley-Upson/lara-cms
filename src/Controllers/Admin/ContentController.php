<?php

namespace LaraCMS\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaraCMS\Models\Content;
use LaraCMS\Models\Page;

class ContentController extends Controller
{
    public function create(Page $page)
    {
        return view('laracms::themes.default.admin.content.create', [
            'page' => $page
        ]);
    }

    public function store(Request $request, Page $page)
    {
        $data = $request->all();
        $data['is_hidden'] = isset($data['is_hidden']) && $data['is_hidden'] === 'on';
        // todo: move this to the content creation screen.
        $data['order'] = count($page->content) + 1;
        $data['content'] = $data['content_' . $data['type']];

        // Handle content types that require more processing.
        if(in_array($data['type'], [
            'image',
            'form',
            'file'
        ])) {

        } else {
            if($data['type'] === 'text') {
                $data['is_html'] = true;
            }

            $page->content()->create($data);
        }

        return redirect()->route('laracms::get.admin/pages/content/create', $page->id)->with('success', 'Content added successfully.');
    }

    public function edit(Content $content)
    {
        $page->load('content');

        return view('laracms::themes.default.admin.pages.edit', [
            'page' => $page
        ]);
    }

    public function update()
    {

    }

    public function destroy(Content $content)
    {
        $page->delete();

        return redirect()->route('laracms::get.admin/pages/index')->with([
            'success' => 'Page successfully deleted.'
        ]);
    }
}
