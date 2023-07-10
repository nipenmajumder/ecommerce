<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Settings;
use App\Services\FileService;
use Illuminate\Http\Request;

/**
 *
 */
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.settings.create', ['settings' => Settings::getSettingsArray()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $image = $request->file('site_logo');
        if ($image) {
            $image_name = rand();
            $upload_path = 'images/settings/';
            $site_logo = FileService::imageStore($image, $upload_path, $image_name, Settings::get('site_logo'));
            \Arr::set($data,'site_logo',$site_logo);
        }
        Settings::updateSettings($data);
        session()->flash('message', 'Setting Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingsRequest $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
