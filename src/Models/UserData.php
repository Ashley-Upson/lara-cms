<?php

namespace LaraCMS\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserData extends Model
{
    use SoftDeletes;

    public $table = 'user_data';

    protected $fillable = [
        'user_id',
        'is_admin'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];
}
