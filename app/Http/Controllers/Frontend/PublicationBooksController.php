<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationBooksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = Publication::query()
            ->where('slug', request()->route()->parameters()['slug'])
            ->with('books')
            ->first(['id', 'name']);
        $booksPaginator = $data->books()->paginate(12);
        return view('frontend.common.book', compact( 'booksPaginator'));
    }
}
