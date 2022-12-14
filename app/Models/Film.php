<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year_of_release',
        'cover_image_url',
        'user_id'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_films', 'films_id', 'categories_id');
    }
}
