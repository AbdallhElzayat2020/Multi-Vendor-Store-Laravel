<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait UploadTrait
{
    public function uploadFile(Request $request, $foldername, $inputname, $disk)
    {
        // if (!$request->hasFile($inputname)) {
        //     return null;
        // }

        // $file = $request->file($inputname);

        // $path = $file->store($foldername, $disk);

        // $request->merge([

        //     $inputname => $path

        // ]);

        if ($request->hasFile($inputname)) {

            $file = $request->file($inputname);

            $filename = time().'.'.$file->getClientOriginalExtension();

            $path = $file->storeAs($foldername, $filename, $disk);
        }

        return $request->file($path);
    }
}
