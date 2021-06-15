<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BrandCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;

class BrandController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Brand::class);

        $search = $request->get('search', '');

        $brands = Brand::search($search)
            ->latest()
            ->paginate();

        return new BrandCollection($brands);
    }

    /**
     * @param \App\Http\Requests\BrandStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreRequest $request)
    {
        $this->authorize('create', Brand::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $brand = Brand::create($validated);

        return new BrandResource($brand);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Brand $brand)
    {
        $this->authorize('view', $brand);

        return new BrandResource($brand);
    }

    /**
     * @param \App\Http\Requests\BrandUpdateRequest $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($brand->image) {
                Storage::delete($brand->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $brand->update($validated);

        return new BrandResource($brand);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        $this->authorize('delete', $brand);

        if ($brand->image) {
            Storage::delete($brand->image);
        }

        $brand->delete();

        return response()->noContent();
    }
}
