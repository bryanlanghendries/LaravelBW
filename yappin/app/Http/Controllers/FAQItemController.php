<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQItem;
use App\Models\FAQCategory;

class FAQItemController extends Controller
{
    public function index()
    {
        // Get all faq items ordered by date (DESC)
        $faqitems = FAQItem::latest()->get();
        // Get all faq categories
        $categories = FAQCategory::all();
        return view("faq.index", compact("faqitems", "categories"));
    }

    public function store(Request $request)
    {
        // Validate all data
        $request->validate([
            'user_id' => 'required|integer',
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'required|string',
        ]);

        // Create a faqitem
        $faq = FAQItem::create([
            'user_id' => $request->user_id,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        // Find or create category
        $category = FAQCategory::firstOrCreate(['name' => $request->category]);

        // Give faq a category
        $faq->category_id = $category->id;

        $faq->save();

        return redirect()->route("faq.index")->with('status', 'FAQ posted');
    }
}
