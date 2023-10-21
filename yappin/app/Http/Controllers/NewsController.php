<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\News;

use Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy("created_at","desc")->paginate(10);
        return view('news.index', compact('news'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);

        $news = new News;
        $news->title = $validated['title'];
        $news->content = $validated['content'];
        $news->user_id = Auth::user()->id;
        $news->save();

        return redirect()->route('index')->with('status', 'Yapp added');
    }
}
