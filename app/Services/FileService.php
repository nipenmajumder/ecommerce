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

    public static function base64FileStore($file, $directory, $filename, $oldImage = null): string
    {
        self::fileDelete($oldImage);
        $image_name = $filename . '_' . Str::uuid();
        $base64Image = explode(";base64,", $file);
        $explodeImage = explode("image/", $base64Image[0]);
        $extension = $explodeImage[1];
        $image_base64 = base64_decode($base64Image[1]);
        $image = $directory . $image_name . '.' . $extension;

        $file->move($directory, $image_base64);
//        if (App::environment('local')) {
//            $disk = Storage::disk('public');
//        } else {
//            $disk = Storage::disk('digitalocean');
//        }
//        $disk->put($image, $image_base64);
        return $image;
    }

}
