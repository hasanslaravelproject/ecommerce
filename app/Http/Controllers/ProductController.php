<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Product::class);
        $products=Product::all();
        $search = $request->get('search', '');
      
     /*  $abc=Product::orderBy('created_at','desc')->first();
      $totalImage = json_decode($abc->name);
      if (count($totalImage) >= 2){
          dd($totalImage[0]);
      } */
        
        return view('app.products.index', compact('products', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      

        $this->authorize('create', Product::class);
       /*  $product->title=$request->title; */
       /*  $product->slug=Str::slug($request->title, '-'); */

        $shops = Shop::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');

        return view(
            'app.products.create',
            compact('shops', 'categories', 'brands')
        );
    }

    /**
     * @param \App\Http\Requests\ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        $product_pic=[];       
        if ($request->hasfile('product_pic')) {
            foreach ($request->file('product_pic') as $key => $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = time() . $key . '.' . $extension;
                $image->move(public_path('/'), $filename);
                $product_pic[] = $filename;
            }
        }
        
       
    
        $product = new Product();
        $product->name=$request->name;
        $product->slug=Str::slug($request->name,'-');
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->shop_id=$request->shop_id;
      $product->image=json_encode($product_pic);
        $product->save();
    
        $productDetails=new ProductDetail();
        $productDetails->price=$request->price;
        $productDetails->size=$request->size;
        $productDetails->color=$request->color;
        $productDetails->discount=$request->discount;
        $productDetails->discount_type=$request->discount_type;
        $productDetails->product_id=$product->id;
        $productDetails->save();
        
        
        DB::commit();

        return redirect()
            ->route('products.edit', $product)
            ->withSuccess(__('crud.common.created'));
            
        } catch (\Throwable $e) {
            dd($e->getMessage());
            DB::rollback();
        
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $this->authorize('view', $product);

        return view('app.products.show', compact('product'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$slug)
    
    {
        $product=Product::where('slug',$slug)->first();
        
  
       

        $shops = Shop::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');

        return view(
            'app.products.edit',
            compact('product', 'shops', 'categories', 'brands')
        );
    }

    /**
     * @param \App\Http\Requests\ProductUpdateRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $product->update($validated);

        return redirect()
            ->route('products.edit', $product)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $this->authorize('delete', $product);

        if ($product->image) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
