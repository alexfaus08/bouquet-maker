<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtworkResource;
use App\Models\Artwork;
use App\Models\ArtworkCategory;

class ArtworkByCategoryController extends Controller
{
    public function __invoke(ArtworkCategory $artworkCategory)
    {
        return ArtworkResource::collection(Artwork::where('artwork_category_id', $artworkCategory->id)->get());
    }
}
