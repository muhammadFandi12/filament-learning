<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'author';

    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'no_hp',
    ];

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }
}
