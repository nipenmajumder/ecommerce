<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\FragmentProduct;
use App\Models\Product;
use App\Models\Stock;
use App\Services\FileService;

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
            ->get();
        $fragmentProduct = FragmentProduct::query()
            ->withCount(['fragmentStocks as total_stock' => function ($query) {
                return $query->where('stock_status', Stock::STATUS['Stock']);
            }])
            ->withCount(['fragmentStocks as total_sold' => function ($query) {
                return $query->where('stock_status', Stock::STATUS['Sale']);
            }])
            ->get();

        $products = collect([$products, $fragmentProduct])
            ->flatten(1)
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
    public function store(StoreProductRequest $request, Product $product, FragmentProduct $fragmentProduct)
    {
        try {
            $requestedData = $request->validated();
            if ($request->image !== null) {
                $requestedData['image'] = FileService::base64FileStore($request->image, 'images/product/', random_int(1, 1000));
            }
//            if ( in_array($request->category_id,[1,2,3]) ) {
            if ($request->category_id == 1) {
                $product->fill($requestedData)->save();
            } else {
                $fragmentProduct->fill($requestedData)->save();
            }

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
        if ($product->status == Product::STATUS['active']) {
            $product->status = Product::STATUS['inactive'];
        } else {
            $product->status = Product::STATUS['active'];
        }
        $product->save();

        return redirect()->back()->with('success', 'Product status changed successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        abort(403, 'product edit is not available');
        //        return view('backend.product.edit', compact('product'));
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
