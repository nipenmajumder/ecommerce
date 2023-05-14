<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Services\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::query()->paginate(10);
        return view('backend.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request, Author $author)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->validated();
            $image = $request->file('avatar');
            if ($image) {
                $requestData = Arr::set(
                    $requestData,
                    'avatar',
                    FileService::imageStore($image, 'images/author/', rand(1, 1000))
                );
            }
            $author->fill($requestData)->save();
            DB::commit();
            return redirect()->route('author.index')->with('success', 'Author created successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        if ($author->status == Author::STATUS['active']) {
            $author->status = Author::STATUS['inactive'];
        } else {
            $author->status = Author::STATUS['active'];
        }
        $author->save();
        return redirect()->back()->with('success', 'Author status changed successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('backend.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->validated();
            $image = $request->file('avatar');
            if ($image) {
                $requestData = Arr::set(
                    $requestData,
                    'avatar',
                    FileService::imageStore($image, 'images/author/', rand(1, 1000))
                );
            }
            $author->fill($requestData)->save();
            DB::commit();
            return redirect()->route('author.index')->with('success', 'Author updated successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
