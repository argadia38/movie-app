<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'synopsis',
        'release_year',
        'poster_path',
        'download_links',
        'stream_links',
        'is_featured',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'download_links' => 'array',
        'stream_links' => 'array',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the genres for the movie.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }
}
