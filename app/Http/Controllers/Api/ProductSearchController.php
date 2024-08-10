<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;

class ProductSearchController extends Controller
{
    public function search(Request $request)
    {
        dd('hi');
        $query = $request->input('query');

        // Define a cache key based on the search query
        $cacheKey = 'products_search_' . md5($query);

        // Check if results are cached
        $products = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($query) {
            return Product::where('name', 'LIKE', "%{$query}%")
                ->get();
        });

        return response()->json($products);
    }
}
