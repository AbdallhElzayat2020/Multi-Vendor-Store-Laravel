<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait UploadTrait
{
    public function uploadFile(Request $request, $inputname, $foldername, $disk)
    {
        if ($request->hasFile('image')) {

            $file = $request->file('imgae');

            $path = $file->storeAs('uploads', $foldername, $disk);

            $request->merge([

                $inputname => $path

            ]);
        }
    }
}
