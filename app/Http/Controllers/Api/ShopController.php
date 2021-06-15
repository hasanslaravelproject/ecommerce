<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Resources\ShopResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ShopCollection;
use App\Http\Requests\ShopStoreRequest;
use App\Http\Requests\ShopUpdateRequest;

class ShopController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Shop::class);

        $search = $request->get('search', '');

        $shops = Shop::search($search)
            ->latest()
            ->paginate();

        return new ShopCollection($shops);
    }

    /**
     * @param \App\Http\Requests\ShopStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopStoreRequest $request)
    {
        $this->authorize('create', Shop::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $shop = Shop::create($validated);

        return new ShopResource($shop);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Shop $shop)
    {
        $this->authorize('view', $shop);

        return new ShopResource($shop);
    }

    /**
     * @param \App\Http\Requests\ShopUpdateRequest $request
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopUpdateRequest $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $shop->update($validated);

        return new ShopResource($shop);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Shop $shop)
    {
        $this->authorize('delete', $shop);

        $shop->delete();

        return response()->noContent();
    }
}
