<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductDetailCollection;

class ProductProductDetailsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $productDetails = $product
            ->productDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductDetailCollection($productDetails);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->authorize('create', ProductDetail::class);

        $validated = $request->validate([
            'price' => ['required', 'numeric'],
            'color' => ['required'],
            'size' => ['required', 'max:255', 'string'],
            'discount_type' => ['nullable', 'in:percentage,flat'],
            'discount' => ['required', 'numeric'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $productDetail = $product->productDetails()->create($validated);

        return new ProductDetailResource($productDetail);
    }
}
