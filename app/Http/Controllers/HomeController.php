<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latest = Product::latest()->take(10)->get();
        return view('front.home', [
            'latest' => $latest,
        ]);
    }
}
