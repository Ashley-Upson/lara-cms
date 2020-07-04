<?php

namespace AshleyUpson\LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends Model
{
    use SoftDeletes;

    public $table = 'navigation';

    protected $fillable = [
        'name',
        'type',
        'navigation_id',
        'text',
        'url',
        'route_name',
        'order',
        'is_published'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function parent()
    {
        return $this->hasOne(Navigation::class, 'id', 'navigation_id');
    }

    public function children()
    {
        return $this->hasMany(Navigation::class, 'navigation_id', 'id')->orderBy('order');
    }
}
