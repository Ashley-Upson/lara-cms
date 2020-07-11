<form {!! \LaraCMS\LaraCMS::attributeString($content->attributes) !!}>
    {{ csrf_field() }}
    @foreach($content->formComponents as $component)
        @include('laracms::themes.default.content.forms.' . $component->type, ['component' => $component])
    @endforeach
</form>