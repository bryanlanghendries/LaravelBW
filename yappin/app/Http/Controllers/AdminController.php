<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;

class AdminController extends Controller
{

    public function __construct()
    {
        // Protect all
        $this->middleware('auth');
    }
    public function index()
    {
        $messages = Message::all();
        return view('admin.index', compact('messages'));
    }
}