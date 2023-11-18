<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->latest()->paginate(10);

        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->validated();
            $requestData = Arr::set(
                $requestData,
                'slug',
                Str::slug($requestData['name'])
            );
            $image = $request->file('image');
            if ($image) {
                $requestData = Arr::set(
                    $requestData,
                    'image',
                    FileService::imageStore($image, 'images/category/', rand(1, 1000))
                );
            }
            $category->fill($requestData)->save();
            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category created successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if ($category->status == Category::STATUS['active']) {
            $category->status = Category::STATUS['inactive'];
        } else {
            $category->status = Category::STATUS['active'];
        }
        $category->save();

        return redirect()->back()->with('success', 'Category status changed successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->validated();
            $requestData = Arr::set(
                $requestData,
                'slug',
                Str::slug($requestData['name'])
            );
            $image = $request->file('image');
            if ($image) {
                $requestData = Arr::set(
                    $requestData,
                    'image',
                    FileService::imageStore($image, 'images/category/', rand(1, 1000))
                );
            }
            $category->fill($requestData)->save();
            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category updated successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
