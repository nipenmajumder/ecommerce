<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->get('search');
        $books = Product::query()
            ->search($search)
            ->limit(10)
            ->with(['author', 'category', 'publication'])
            ->get();
        return $this->respondSuccess($books, 'Search result fetched successfully.');
    }
}
