<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\PublicationResource;
use App\Models\Product;
use App\Models\Publication;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::query()->paginate(40);
        return $this->respondWithResourceCollection(BookResource::collection($products), 'Books fetched successfully');
    }
}
