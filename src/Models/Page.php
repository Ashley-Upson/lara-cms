<?php

namespace LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Routing\Route;

class Page extends Model
{
    use SoftDeletes;

    public $table = 'pages';

    protected $fillable = [
        'theme_id',
        'name',
        'title',
        'is_published',
        'show_navigation',
        'type',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'show_navigation' => 'boolean'
    ];

    public function theme()
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id');
    }

    public function content()
    {
        return $this->hasMany(Content::class, 'page_id', 'id')->orderBy('order');
    }

    public function routes()
    {
        return $this->hasMany(CustomRoute::class, 'page_id', 'id');
    }
}
