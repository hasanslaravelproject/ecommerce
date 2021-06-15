<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class CategoryProductsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category)
    {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $products = $category
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'slug' => ['nullable', 'max:255', 'string'],
            'status' => ['nullable', 'in:inactive,active'],
            'image' => ['nullable', 'image', 'max:1024'],
            'shop_id' => ['required', 'exists:shops,id'],
            'brand_id' => ['required', 'exists:brands,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $product = $category->products()->create($validated);

        return new ProductResource($product);
    }
}
