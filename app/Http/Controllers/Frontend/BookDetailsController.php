<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class BookDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $book = Product::query()
            ->where('slug', $slug)
            ->with(['author', 'publication', 'category'])
            ->withCount(['stocks as total_stock' => function ($query) {
                return $query->where('stock_status', Stock::STATUS['Stock']);
            }])
            ->first();
        $relatedBooks = Product::query()
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->with(['author', 'publication', 'stocks', 'category'])
            ->withCount(['stocks as total_stock' => function ($query) {
                return $query->where('stock_status', Stock::STATUS['Stock']);
            }])
            ->inRandomOrder()
            ->take(6)
            ->get();
        $publicationBooks = Product::query()
            ->where('id', '!=', $book->id)
            ->where('publication_id', $book->publication_id)
            ->with(['author', 'publication', 'stocks', 'category'])
            ->withCount(['stocks as total_stock' => function ($query) {
                return $query->where('stock_status', Stock::STATUS['Stock']);
            }])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('frontend.common.details', compact('book', 'relatedBooks', 'publicationBooks'));
    }
}
