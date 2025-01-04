<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index()
    {

        // return response( view , json , redirect , showFile)

        $user = 'Abdallh Elzayat';

        return view('dashboard.index', compact('user'));

        //or
        // return response()->view('dashboard', [
        //     'user' => $user,
        // ]);

        // //or
        // return Response::view('dashboard', [
        //     'user' => $user,
        // ]);

        // // or
        // return View::make('dashboard', [
        //     'user' => $user
        // ]);

        // // or
        // return view('dashboard', [
        //     'user' => $user
        // ]);

        // // or
        // return view('dashboard')->with([
        //     'user' => $user,
        // ]);

    }
}
