<?php

namespace LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    public $table = 'content';

    protected $fillable = [
        'page_id',
        'title',
        'type',
        'content',
        'is_html',
        'is_hidden',
        'order'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function attributes()
    {
        return $this->hasMany(FormAttribute::class, 'content_id', 'id');
    }

    public function formComponents()
    {
        return $this->hasMany(FormComponent::class, 'content_id', 'id')->orderBy('order');
    }
}
