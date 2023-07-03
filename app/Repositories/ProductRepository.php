<?php

namespace App\Repositories;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

    
     public function allProducts()
    {
        return Product::all(); // latest()->paginate(10);
    }

    public function storeProduct($data)
    {
        return Product::create($data);
    }

    public function findProduct($id)
    {
        return Product::find($id);
    }

    public function updateProduct($data, $id)
    {
        $product = Product::where('id', $id)->first();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->save();
    }

    public function destroyProduct($id)
    {
        $product = Product::find($id);
        return $product->delete();
    }
}
