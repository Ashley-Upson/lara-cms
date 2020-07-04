<div class="input-group input-group-sm">
    <div class="input-group-prepend">
        <span class="input-group-text">
            {{ $component->label }}
        </span>
    </div>
    <input type="password" name="{{ $component->name }}" {!! \AshleyUpson\LaraCMS\LaraCMS::attributeString($component->attributes) !!} placeholder="{{ $component->placeholder }}" {{ $component->is_required == 1 ? 'required' : '' }} {{ $component->is_disabled == 1 ? 'disabled' : '' }} />
</div>