<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->q;
        $category = $request->category; // slug category (opsional)
        $sort = $request->sort;

        $products = Product::query()
            ->available() // is_active + stock > 0
            ->search($keyword) // pakai scopeSearch
            ->when($category, function ($query) use ($category) {
                $query->byCategory($category); // scopeByCategory
            })
            ->sortBy($sort) // scopeSortBy
            ->with(['primaryImage']) // biar gak N+1
            ->paginate(12)
            ->withQueryString();

        return view('search.products', compact(
            'products',
            'keyword',
            'category',
            'sort'
        ));
    }
}
