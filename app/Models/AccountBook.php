<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountBook extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_default',
    ];
}
