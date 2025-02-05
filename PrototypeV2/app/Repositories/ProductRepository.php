<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository
{
    public function getAll()
    {
        $products = Product::all();
        return $products;
    }
    public function createProduct(array $data)
    {
        return Product::create($data);
    }
    public function deleteProduct(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'failed',
                'id' => $id,
                'message' => 'Le produit avec cet ID n\'existe pas.'
            ]);
        }
        $product->delete();
        return response()->json([
            'status'=>'success',
            'id' => $id,
            'message' => 'Produit supprimé avec succès.'
        ]);
    }




}













