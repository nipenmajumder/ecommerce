<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = Author::query()
            ->when(request()->get('name'), function ($query) {
                return $query->search(request()->get('name'));
            })
            ->active()
            ->get();

        return view('frontend.common.common', compact('data'));
    }
}
