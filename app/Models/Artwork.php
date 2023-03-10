<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Artwork extends Model
{
    use HasFactory;

    public $fillable = ['name', 'image', 'artwork_category_id'];

    public function artworkCategory(): BelongsTo
    {
        return $this->belongsTo(ArtworkCategory::class);
    }
}
