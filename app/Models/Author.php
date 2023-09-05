<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Author extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = ['first_name', 'second_name', 'login', 'password'];

    protected $hidden = ['login', 'password'];

    public function books () {
        return $this->hasMany(Book::class);
    }
}
