<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderDetailCollection;

class ProductOrderDetailsController extends Controller
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

        $orderDetails = $product
            ->orderDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderDetailCollection($orderDetails);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->authorize('create', OrderDetail::class);

        $validated = $request->validate([
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'order_id' => ['required', 'exists:orders,id'],
        ]);

        $orderDetail = $product->orderDetails()->create($validated);

        return new OrderDetailResource($orderDetail);
    }
}
