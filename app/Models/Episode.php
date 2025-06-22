<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'title',
        'slug',
        'description',
        'download_links',
        'stream_links'
    ];

    protected $casts = [
        'download_links' => 'array',
        'stream_links' => 'array',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
