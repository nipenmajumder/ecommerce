<?php

namespace App\Http\Controllers\Backend\Api;

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
        $authors = Author::query()->get(['id', 'name']);

        return $this->respondSuccess($authors, 'Authors fetched successfully');
    }
}
