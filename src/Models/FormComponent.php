<?php

namespace LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormComponent extends Model
{
    use SoftDeletes;

    public $table = 'form_components';

    protected $fillable = [
        'content_id',
        'order',
        'type',
        'name',
        'label',
        'placeholder',
        'is_disabled',
        'is_required'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function attributes()
    {
        return $this->hasMany(FormAttribute::class, 'component_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(FormOption::class, 'component_id', 'id');
    }
}
