<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $authors = Author::query()->active()->withCount('books')->get();

        return $this->respondWithResourceCollection(AuthorResource::collection($authors), 'Authors fetched successfully');
    }
}
