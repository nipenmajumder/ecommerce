<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileService
{
    public static function imageStore($file, $directory, $filename, $oldImage = null): string
    {
        if ($oldImage && File::exists($oldImage)) {
            File::delete($oldImage);
        }

        $file_name = $filename.'_'.Str::uuid();
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $file_name.'.'.$ext;
        $image_url = $directory.$image_full_name;
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

    public static function base64FileStore($file, $directory, $filename, $oldImage = null): string
    {
        $image_name = $filename.'_'.Str::uuid();
        $base64Image = explode(';base64,', $file);
        $explodeImage = explode('/', $base64Image[0]);
        $extension = $explodeImage[1];
        $image_base64 = base64_decode($base64Image[1]);
        $image = $directory.$image_name.'.'.$extension;
        file_put_contents($image, $image_base64);

        // Optionally delete the old image if provided
        if ($oldImage) {
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        return $image;
    }
}
