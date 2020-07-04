<div class="input-group input-group-sm">
    <button {!! \AshleyUpson\LaraCMS\LaraCMS::attributeString($component->attributes) !!} {{ $component->is_disabled == 1 ? 'disabled' : '' }}>
        {{ $component->label }}
    </button>
</div>