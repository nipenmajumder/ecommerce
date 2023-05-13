<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use App\Services\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::query()->latest()->paginate(100);
        return view('backend.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request, Slider $slider)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->validated();
            $image = $request->file('image');
            if ($image) {
                $requestData = Arr::set(
                    $requestData,
                    'image',
                    FileService::imageStore($image, 'images/slider/', rand(1, 1000))
                );
            }
            $slider->fill($requestData)->save();
            DB::commit();
            return redirect()->route('slider.index')->with('success', 'Slider created successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        if ($slider->status == Slider::STATUS['active']) {
            $slider->status = Slider::STATUS['inactive'];
        } else {
            $slider->status = Slider::STATUS['active'];
        }
        $slider->save();
        return redirect()->back()->with('success', 'Slider status changed successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('backend.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->validated();
            $image = $request->file('image');
            if ($image) {
                $requestData = Arr::set(
                    $requestData,
                    'image',
                    FileService::imageStore($image, 'images/slider/', rand(1, 1000))
                );
            }
            $slider->fill($requestData)->save();
            DB::commit();
            return redirect()->route('slider.index')->with('success', 'Slider created successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //
    }
}
