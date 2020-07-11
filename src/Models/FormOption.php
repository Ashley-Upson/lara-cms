<?php

namespace LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormOption extends Model
{
    use SoftDeletes;

    public $table = 'form_options';

    protected $fillable = [
        'component_id',
        'order',
        'label',
        'value',
        'is_disabled'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function attributes()
    {
        return $this->hasMany(FormAttribute::class, 'option_id', 'id');
    }
}
