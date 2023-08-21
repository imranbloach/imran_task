<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    protected $hidden = ['password'];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => bcrypt($value)
        );
    }
}
