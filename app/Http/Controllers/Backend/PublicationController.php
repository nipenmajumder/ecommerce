<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\Publication;
use App\Services\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::query()->paginate(10);

        return view('backend.publication.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.publication.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublicationRequest $request, Publication $publication)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->validated();
            $image = $request->file('image');
            if ($image) {
                $requestData = Arr::set(
                    $requestData,
                    'image',
                    FileService::imageStore($image, 'images/publication/', rand(1, 1000))
                );
            }
            $publication->fill($requestData)->save();
            DB::commit();

            return redirect()->route('publication.index')->with('success', 'Publication created successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        if ($publication->status == Publication::STATUS['active']) {
            $publication->status = Publication::STATUS['inactive'];
        } else {
            $publication->status = Publication::STATUS['active'];
        }
        $publication->save();

        return redirect()->back()->with('success', 'Publication status changed successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        return view('backend.publication.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublicationRequest $request, Publication $publication)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->validated();
            $image = $request->file('image');
            if ($image) {
                $requestData = Arr::set(
                    $requestData,
                    'image',
                    FileService::imageStore($image, 'images/publication/', rand(1, 1000))
                );
            }
            $publication->fill($requestData)->save();
            DB::commit();

            return redirect()->route('publication.index')->with('success', 'Publication created successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
