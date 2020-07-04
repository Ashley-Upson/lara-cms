<div class="input-group input-group-sm">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <input type="checkbox" name="{{ $component->name }}" id="{{ $component->name }}" {!! \AshleyUpson\LaraCMS\LaraCMS::attributeString($component->attributes) !!} placeholder="{{ $component->placeholder }}" {{ $component->is_required == 1 ? 'required' : '' }} {{ $component->is_disabled == 1 ? 'disabled' : '' }} />
        </span>
    </div>
    <label class="form-control" for="{{ $component->name }}">
        {{ $component->label }}
    </label>
</div>