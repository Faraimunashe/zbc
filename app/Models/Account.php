<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'fname',
        'lname',
        'phone',
        'address',
        'city',
        'accnum'
    ];
}
