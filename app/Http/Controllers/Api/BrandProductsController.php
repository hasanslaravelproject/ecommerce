<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class BrandProductsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Brand $brand)
    {
        $this->authorize('view', $brand);

        $search = $request->get('search', '');

        $products = $brand
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Brand $brand)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'slug' => ['nullable', 'max:255', 'string'],
            'status' => ['nullable', 'in:inactive,active'],
            'image' => ['nullable', 'image', 'max:1024'],
            'shop_id' => ['required', 'exists:shops,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $product = $brand->products()->create($validated);

        return new ProductResource($product);
    }
}
