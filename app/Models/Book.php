<?php

namespace App\Models;

use App\Enums\EditionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'edition'];

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class);
    }

    protected $casts = [
        'edition' => EditionEnum::class
    ];
}
