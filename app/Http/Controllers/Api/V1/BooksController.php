<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Product;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::query()
            ->when($request->get('category'), function ($query) use ($request) {
                $query->whereIn('category_id', explode(',', $request->get('category')));
            })
            ->when($request->get('author'), function ($query) use ($request) {
                $query->whereIn('author_id', explode(',', $request->get('author')));
            })
            ->when($request->get('publication'), function ($query) use ($request) {
                $query->whereIn('publication_id', explode(',', $request->get('publication')));
            })
//            ->when($request->get('search'), function ($query) use ($request) {
//                $query->search($request->get('search'));
//            })
//            ->when($request->get('sort'), function ($query) use ($request) {
//                $query->orderBy($request->get('sort'), $request->get('order', 'asc'));
//            })
            ->with('author')
            ->paginate(40);

        return $this->respondWithResourceCollection(BookResource::collection($products), 'Books fetched successfully');
    }
}
