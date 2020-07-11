<?php

namespace LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomRoute extends Model
{
    use SoftDeletes;

    public $table = 'custom_routes';

    protected $fillable = [
        'page_id',
        'request_method',
        'custom_route',
        'custom_handler',
        'is_published'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function page()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
}
