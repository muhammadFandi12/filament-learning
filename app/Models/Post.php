<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'kategori_id',
        'author_id',
        'judul',
        'konten',
        'publish_date',
    ];

    protected $cast = [
        'publish_date' => 'date',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
