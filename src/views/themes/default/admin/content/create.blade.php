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
                    html
                </div>
                <div id="content_blade" class="content_editors hidden">
                    blade
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
                    link
                </div>
                <div id="content_file" class="content_editors hidden">
                    file
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
    <script src="https://cdn.tiny.cloud/1/myzx8qzp1ptmimdk1gqmk80idu52mq5pas1v09wcyda9iwpa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script type="text/javascript">
        let components = {
            text: null
        }

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
            }
        }
    </script>
@endsection
