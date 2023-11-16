<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
        // Protect all
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.index');
    }
}