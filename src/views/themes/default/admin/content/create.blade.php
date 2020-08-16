@extends('laracms::themes.default.layouts.master')

@section('title')
    Admin - Add page content - {{ $page->name }}
@endsection

@section('navigation')
    @include('laracms::themes.default.layouts.navigation', ['navbar' => \LaraCMS\LaraCMS::getNavbar()])
@endsection

@section('header')
    <style type="text/css">
        .hidden {
            display: none;
        }
    </style>
@endsection

@section('content')
    @if(session('success') != null)
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="float-right">
        <a href="{{ route('laracms::get.admin/pages/edit', $page->id) }}" class="btn btn-sm btn-success">
            View content
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form name="create_page_content" class="form" action="{{ route('laracms::post.admin/pages/content/store', $page->id) }}" method="post">
                {{ csrf_field() }}
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            Title *
                        </span>
                    </div>
                    <input type="text" name="title" class="form-control" placeholder="Title..." required />
                </div>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" name="is_hidden" id="is_hidden">
                        </span>
                    </div>
                    <label class="form-control" for="is_hidden">
                        Hide
                    </label>
                </div>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            Type *
                        </span>
                    </div>
                    <select name="type" class="form-control" onchange="changeContentType(this.value)" required>
                        @foreach(\LaraCMS\LaraCMS::getContentTypes() as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="content_text" class="content_editors">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Content
                            </span>
                        </div>
                    </div>
                    <textarea name="content_text" class="form-control" id="content_editor_text"></textarea>
                </div>
                <div id="content_paragraph" class="content_editors hidden">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Content
                            </span>
                        </div>
                        <textarea name="content_paragraph" class="form-control" rows="5" placeholder="Content..."></textarea>
                    </div>
                </div>
                <div id="content_html" class="content_editors hidden">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Content
                            </span>
                        </div>
                    </div>
                    <textarea name="content_html" class="form-control" id="content_editor_html"></textarea>
                </div>
                <div id="content_blade" class="content_editors hidden">
                    <p class="alert alert-info">
                        Please note, some functions are disabled through this UI that are available through standard blade files.
                    </p>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Blade
                            </span>
                        </div>
                    </div>
                    <textarea name="content_blade" class="form-control" id="content_editor_blade"></textarea>
                </div>
                <div id="content_image" class="content_editors hidden">
                    image
                </div>
                <div id="content_table" class="content_editors hidden">
                    table
                </div>
                <div id="content_form" class="content_editors hidden">
                    form
                </div>
                <div id="content_link" class="content_editors hidden">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                URL
                            </span>
                        </div>
                        <input type="url" name="content_link_url" class="form-control" placeholder="https://example.com/your-link" />
                    </div>
                    Or...
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                CMS Page
                            </span>
                        </div>
                        <select name="content_link_page_id" class="form-control">
                            <option selected disabled>Page...</option>
                            @forelse($pages as $entry)
                                <option value="{{ $entry->id }}">{{ $entry->title }}</option>
                            @empty
                                <option disabled>No pages.</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div id="content_file" class="content_editors hidden">
                    file
                </div>
                <div id="content_image_carousel" class="content_editors hidden">
                    image carousel
                </div>
                <div id="content_video" class="content_editors hidden">
                    video
                </div>
                <div class="input-group input-group-sm">
                    <button type="submit" class="btn btn-sm btn-success">
                        Add content
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.56.0/codemirror.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.56.0/theme/material-darker.css" />

    <script src="https://cdn.tiny.cloud/1/myzx8qzp1ptmimdk1gqmk80idu52mq5pas1v09wcyda9iwpa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.56.0/codemirror.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.56.0/mode/xml/xml.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.56.0/mode/htmlmixed/htmlmixed.js"></script>

    <script type="text/javascript">
        let components = {
            text: null,
            html: null,
            blade: null,
        }

        // Initialise the default type.
        components.text = tinymce.init({
            selector: '#content_editor_text',
            height: 250,
            placeholder: 'Content...',
        });

        function changeContentType(type) {
            const editors = document.getElementsByClassName('content_editors');

            for(let i = 0; i < editors.length; i++) {
                const element = editors[i];

                if(element.id === ('content_' + type)) {
                    element.classList.remove('hidden');
                } else {
                    element.classList.add('hidden');
                }

                if(type === 'text' && components.text === null) {
                    components.text = tinymce.init({
                        selector: '#content_editor_text'
                    });
                }

                if((type === 'html' && components.html === null) || (type === 'blade' && components.blade === null)) {
                    components[type] = CodeMirror.fromTextArea(document.getElementById('content_editor_' + type), {
                        lineNumbers: true,
                        tabSize: 4,
                        mode: {
                            name: "htmlmixed",
                            scriptTypes: [
                                {
                                    matches: /\/x-handlebars-template|\/x-mustache/i,
                                    mode: null
                                },
                                {
                                    matches: /(text|application)\/(x-)?vb(a|script)/i,
                                    mode: "vbscript"
                                }
                            ]
                        },
                        lineSeparator: '\n'
                    });
                    components[type].setOption('theme', 'material-darker');
                }
            }
        }
    </script>
@endsection
