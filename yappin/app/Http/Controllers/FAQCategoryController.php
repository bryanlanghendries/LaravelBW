<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FAQCategory;
use Auth;
use Illuminate\Http\Request;

class FAQCategoryController extends Controller
{

    public function __construct()
    {
        // Protect all
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        // Get all faq categories
        $categories = FAQCategory::all();

        return $categories;
    }

    public function store(Request $request)
    {
        // Check if authorized
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        // Validate the category input
        $request->validate([
            'category' => 'required|string',
        ]);

        // Create a new category
        FAQCategory::create([
            'name' => $request->category,
        ]);

        return redirect()->route("faq")->with("status", "Category added!");
    }

    public function destroy(FAQCategory $category)
    {

        // Check if authorized
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        // Delete items in the category
        $category->faqitems()->delete();

        // Delete the category
        $category->delete();

        return redirect()->back()->with('status', 'Category deleted');
    }

}
