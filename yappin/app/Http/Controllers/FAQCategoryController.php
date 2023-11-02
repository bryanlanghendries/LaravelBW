<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FAQCategory;
use Auth;
use Illuminate\Http\Request;

class FAQCategoryController extends Controller
{
    public function store(Request $request)
    {
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

        // Delete the category
        $category->delete();

        return redirect()->back()->with('status', 'Category deleted');
    }

}
