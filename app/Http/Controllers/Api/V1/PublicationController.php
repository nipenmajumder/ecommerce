<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\PublicationResource;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $publications = Publication::query()->active()->withCount('books')->get();
        return $this->respondWithResourceCollection(PublicationResource::collection($publications), 'Publications fetched successfully');
    }
}
