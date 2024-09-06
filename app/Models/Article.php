<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'category_id', 'title', 'slug', 'body', 'img', 'views', 'status', 'tag', 'publish_date'];

    //  relasi ke Categoris

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
