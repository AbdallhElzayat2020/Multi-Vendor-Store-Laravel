<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{

    // check auth if user is not authed then redirect to login
    public function __construct()
    {
        $this->middleware('auth');
    }

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
