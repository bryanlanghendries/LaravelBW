<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\News;

use Auth;

class NewsController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $news = News::latest()->get();
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

        return redirect()->route('index')->with('status', 'Yapp posted');
    }

    public function edit($id) {
        $news = News::findOrFail($id);

        if($news->user_id != Auth::user()->id){
            abort(403);
        }

        return view('news.edit', compact('news'));
    }

    public function update($id, Request $request) {
        $news = News::findOrFail($id);
    
        if ($news->user_id != Auth::user()->id) {
            abort(403);
        }
    
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);
    
        // Check if the content has changed
        if ($news->title != $validated['title'] || $news->content != $validated['content']) {
            $news->title = $validated['title'];
            $news->content = $validated['content'];
            $news->is_edited = true;
            $news->save();
            return redirect()->route('index')->with('status', 'Yapp edited');
        } else {
            // Content hasn't changed, so no need to update
            return redirect()->route('index')->with('status', 'No changes were made');
        }
    }
    
}
