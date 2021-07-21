<?php

namespace App\Traits;

use Storage, Str;
use Illuminate\Http\UploadedFile;

trait UploadTrait
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'uploads', $filename = null)
    {
        $name = !is_null($filename) ? $filename : date('Y-m-d-h-i-s').Str::random(25);
        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

    public function deleteOne($folder = null, $disk = 'uploads', $filename = null)
    {
        Storage::disk($disk)->delete($folder.$filename);
    }
}