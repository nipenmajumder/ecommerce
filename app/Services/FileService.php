<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function imageStore($file, $directory, $filename, $oldImage = null): string
    {
        if ($oldImage && File::exists($oldImage)) {
            File::delete($oldImage);
        }

        $file_name = $filename . '_' . Str::uuid();
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $file_name . '.' . $ext;
        $image_url = $directory . $image_full_name;
        $file->move($directory, $image_full_name);

        return $image_url;
    }

    public static function imageDelete($image)
    {
        if (File::exists($image)) {
            File::delete($image);
        }

        return null;
    }
}