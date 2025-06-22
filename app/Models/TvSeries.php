<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TvSeries extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'synopsis', 'poster_path'];

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }
}
