<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQItem;

class FAQItemController extends Controller
{
    public function index() {
        $faqitems = FAQItem::latest()->get();
        return view("faq.index", compact("faqitems"));
    }

    public function store(Request $request) {
        $faq = new FAQItem;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->category_id = 0;

        $faq->save();

        return redirect()->route("faq.index")->with('status', 'FAQ posted');
    }
}
