<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'products' =>  $this->productRepository->allProducts()
        ], Response::HTTP_OK);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
    
        return response()->json([
            'success' => true,
            'product' =>  $this->productRepository->storeProduct($request->all())
        ], Response::HTTP_OK);
    }
    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        return response()->json([
            'success' => true,
            'product' => $this->productRepository->findProduct($product)
        ], Response::HTTP_OK);
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
    public function update(Request $request, $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        
        return response()->json([
            'success' => true,
            'product' =>  $this->productRepository->updateProduct($request->all(), $product)
        ], Response::HTTP_OK);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        if($this->productRepository->destroyProduct($product)) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ], Response::HTTP_OK);
        } else {

            return response()->json(['error' => true,
                'message' => 'Product deleted successfully'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}