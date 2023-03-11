<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtworkCategoryResource;
use App\Models\ArtworkCategory;
use Illuminate\Http\Request;

class ArtworkCategoryController extends Controller
{
    public function index()
    {
        return ArtworkCategoryResource::collection(ArtworkCategory::all());
    }
}
