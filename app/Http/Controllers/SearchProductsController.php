<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchProductsController extends Controller
{
    public function index()
    {
        $queryStr = \request('query');
        $items = Product::when($queryStr, function ($q) use ($queryStr) {
            return $q->where('name', 'LIKE', "%{$queryStr}%");
        })->get();

        return view('search', compact('items', 'queryStr'));
    }
}
