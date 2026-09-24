<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function eco_tips()
    {
        return view('eco_tips');
    }

    public function add_device()
    {
        return view('add_device');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function analytics()
    {
        return view('analytics');
    }

    public function history()
    {
        return view('history');
    }

}
