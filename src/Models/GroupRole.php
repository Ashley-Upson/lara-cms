<?php

namespace LaraCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupRole extends Model
{
    use SoftDeletes;

    public $table = 'group_roles';

    protected $fillable = [
        'group_id',
        'role_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
