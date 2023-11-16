<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        // Validate data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'question' => 'required',
        ]);

        // If not validated return with failed.
        if (!$validated) {
            return redirect()->route('contact')->with('status', 'Message not sent!');
        }

        // Else create new message
        $message = new Message;

        // Add validated data to message
        $message->first_name = $validated['first_name'];
        $message->last_name = $validated['last_name'];
        $message->email = $validated['email'];
        $message->question = $validated['question'];

        // Save message
        $message->save();

        return redirect()->route('contact')->with('status', 'Message sent');
    }
}