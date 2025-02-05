<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected $productRepostitory;

    public function __construct()
    {
        $this->productRepostitory = new ProductRepository;
    }
    public function index()
    {
        $products = $this->productRepostitory->getAll();
        return response()->json($products);
    }
    /**
     * Show the form fo$r creating a new resource.
    */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                'title' => 'required',
                'price' => 'required|numeric',
                'stock' => 'required',
                'content' => 'required',
            ]);
            try{
                $product = $this->productRepostitory->createProduct($validatedData);
                return response()->json(['message' => 'Produit ajouté avec succès','product' => $product], 200);
            }catch(\Exception $e){
                return response()->json(['message' => $e->getMessage()], 500);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json(['message'=>'Produit trouvé avec succès','product' => $product], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Produit non trouvé'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required',
        ]);
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return response()->json(['message' => 'Produit mis à jour avec succès!', 'product' => $product]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Produit non trouvé'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->productRepostitory->deleteProduct($id);
    }
}
