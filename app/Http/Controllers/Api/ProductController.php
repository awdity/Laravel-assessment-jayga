<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'attributes')->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'attributes' => 'array',
            'attributes.*' => 'exists:attributes,id',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        if ($request->has('attributes')) {
            $product->attributes()->attach($request->attributes);
        }

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product->load('category', 'attributes');
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'attributes' => 'array',
            'attributes.*' => 'exists:attributes,id',
        ]);

        $product->update($request->only(['name', 'category_id']));

        if ($request->has('attributes')) {
            $product->attributes()->sync($request->attributes);
        }

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product->attributes()->detach();
        $product->delete();
        return response()->json(null, 204);
    }
}
