<?php

namespace App\Http\Controllers;
use App\models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all(); // Retrieve all products from the database
return view('admin.product', compact('products'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);
        
        $product = Product::create($request->only(['title', 'content', 'price', 'stock']));

        return response()->json(['product'=> $product], 201);
     
    }


    
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produit supprimé avec succès']);
    }
}

