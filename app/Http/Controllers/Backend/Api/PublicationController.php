<?php

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $publications = Publication::query()->get(['id', 'name']);
        return $this->respondSuccess($publications, 'Publications fetched successfully');
    }
}
