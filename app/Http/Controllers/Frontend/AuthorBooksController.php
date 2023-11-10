<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorBooksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = Author::query()
            ->where('slug', request()->route()->parameters()['slug'])
            ->with('books')
            ->first(['id', 'name']);
        $booksPaginator = $data->books()->paginate(12);

        return view('frontend.common.book', compact('booksPaginator'));
    }
}
