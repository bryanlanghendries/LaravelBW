<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\FAQItem;
use App\Models\FAQCategory;

class FAQItemController extends Controller
{

    public function __construct()
    {
        // Protect all except index and category
        $this->middleware('auth', ['except' => ['index', 'category']]);
    }


    public function index()
    {
        // Get all faq items ordered by date (DESC)
        $faqitems = FAQItem::latest()->get();
        // Get all faq categories
        $categories = FAQCategory::all();
        return view("faq.index", compact("faqitems", "categories"));
    }

    public function category($category)
    {
        // get all categories via the controller
        $categoryController = new FAQCategoryController();
        $categories = $categoryController->index();

        // Get faq items for the specified category
        $faqitems = FAQItem::whereHas('category', function ($query) use ($category) {
            $query->where('name', $category);
        })->get();

        return view('faq.category', compact('faqitems', 'categories', 'category'));
    }

    public function store(Request $request)
    {

        // Check if authorized
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        // Validate all data
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'required|string',
        ]);

        // Find or create category
        $category = FAQCategory::where('name', '=', $request->category)->firstorfail();

        // Create a faqitem
        $faq = FAQItem::create([
            'user_id' => Auth::user()->id,
            'question' => $request->question,
            'answer' => $request->answer,
            'category_id' => $category->id,
        ]);

        $faq->save();

        return redirect()->route("faq")->with('status', 'FAQ posted');
    }

    public function destroy(FAQItem $faqitem)
    {
        // Check if authorized
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        // Delete the faq item
        $faqitem->delete();

        return redirect()->back()->with('status', 'FAQ item deleted');
    }

    public function edit(FAQItem $faqitem)
    {
        return view('faq.edit', compact('faqitem'));
    }

    public function update(Request $request, FAQItem $faqitem)
    {
        // Check if authorized
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        // Update the FAQ item data
        $faqitem->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        return redirect()->route('faq.category', ['category' => $faqitem->category->name])->with('status', 'FAQ item updated');
    }

}
