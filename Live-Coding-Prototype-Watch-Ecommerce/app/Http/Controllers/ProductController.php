<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product', compact('products')); // Correct view path
    }

    public function store(Request $request)
    {
        // Add validation
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Create the product
        $product = Product::create($request->only(['title', 'content', 'price', 'stock']));
        
        // Return a response (could also redirect or return JSON)
        return response()->json(['product' => $product], 201);
    }

    public function destroy($id)
    {
        // Find the product and delete it
        $product = Product::findOrFail($id);
        $product->delete();

        // Return a response
        return response()->json(['message' => 'Produit supprimé avec succès.'], 200);
    }
}
