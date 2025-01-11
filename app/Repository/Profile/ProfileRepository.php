<?php

namespace App\Repository\Profile;

use App\Interfaces\Profile\ProfileRepositoryInterface;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileRepository implements ProfileRepositoryInterface
{


    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.Profile.edit', [
            'user' => $user,
            'countries' => array_map('strval', Countries::getNames()),
            'locales' => array_map('strval', Languages::getNames()),
        ]);
    }

    public function update($request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['required', 'string'],
            'local' => ['required', 'string'],
        ]);

        $user = $request->user();

        $user->profile->fill($request->all())->save();

        return redirect()->route('dashboard.profile.edit')
            ->with('success', 'Profile updated successfully');
    }

    // public function update($request)
    // {
    //     $request->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'birthday' => ['nullable', 'date', 'before:today'],
    //         'gender' => ['in:male,female'],
    //         'country' => ['required', 'string', 'size:2'],
    //         'local' => ['required', 'string', 'size:2'],
    //     ]);

    //     $user = $request->user();

    //     $user->profile->fill($request->all())->save();

    //     return redirect()->route('dashboard.categories.index')
    //         ->with('success', 'Profile updated successfully');
    // }
}
