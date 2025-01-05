<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait UploadTrait
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('image')) {
            //
        }
    }
}
