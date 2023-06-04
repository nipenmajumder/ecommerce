<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Author;
use App\Models\Product;
use App\Models\Publication;
use App\Models\Stock;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()
            ->withCount(['stocks as total_stock' => function ($query) {
                return $query->where('stock_status', Stock::STATUS['Stock']);
            }])
            ->withCount(['stocks as total_sold' => function ($query) {
                return $query->where('stock_status', Stock::STATUS['Sale']);
            }])
            ->paginate(10);
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, Product $product)
    {
        try {
            $product->fill($request->validated())->save();
            return $this->respondCreated($product, 'Product created successfully');
        } catch (\Throwable $exception) {
            return $this->respondError($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('backend.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
