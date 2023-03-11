<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtworkResource;
use App\Models\Artwork;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function index()
    {
        return ArtworkResource::collection(Artwork::all());
    }

    public function show(Artwork $artwork)
    {
        //
    }
}
