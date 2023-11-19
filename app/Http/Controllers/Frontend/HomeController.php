<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Settings;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sliders = Slider::query()->active()->get();
        $categories = Category::query()
            ->active()
            ->withWhereHas('books')
            ->with([
                'books:id,name,slug,sku,barcode,sell_price,category_id,author_id,image',
                'books.author:id,name,slug',
                'fragmentBooks:id,name,slug,sku,barcode,sell_price,category_id,author_id,image',
                'fragmentBooks.author:id,name,slug',
            ])
            ->get([
                'id',
                'name',
                'slug',
                'image',
            ]);

        return view('frontend.layouts.home', compact('sliders', 'categories'));
    }
}
