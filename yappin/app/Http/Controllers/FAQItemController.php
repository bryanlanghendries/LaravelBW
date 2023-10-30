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
}
