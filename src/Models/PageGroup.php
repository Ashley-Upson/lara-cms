<?php

namespace LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageGroup extends Model
{
    use SoftDeletes;

    public $table = 'page_groups';

    protected $fillable = [
        'page_id',
        'group_id'
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

    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
