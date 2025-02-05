<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
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
        return view('dashboard2',compact('products'));
    }
    /**
     * Show the form for creating a new resource.
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
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required',
            'content' => 'required',
        ]);
        $product = $this->productRepostitory->createProduct($validatedData);
        return response()->json(['message' => 'Validation réussie !','product' => $product], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
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
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->productRepostitory->deleteProduct($id);
    }
}
