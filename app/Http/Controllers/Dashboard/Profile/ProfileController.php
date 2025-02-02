<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Interfaces\Profile\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profile;

    public function __construct(ProfileRepositoryInterface $profile)
    {
        $this->profile = $profile;
    }

    public function edit()
    {
        return $this->profile->edit();
    }

    public function update(Request $request)
    {
        return $this->profile->update($request);
    }
}
