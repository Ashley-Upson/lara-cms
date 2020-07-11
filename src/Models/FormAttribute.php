<?php

namespace LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormAttribute extends Model
{
    use SoftDeletes;

    public $table = 'form_attributes';

    protected $fillable = [
        'content_id',
        'component_id',
        'option_id',
        'attribute',
        'value'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
