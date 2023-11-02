<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ContactFormController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
}
