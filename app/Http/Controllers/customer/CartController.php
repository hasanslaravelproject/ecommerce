<?php

namespace App\Http\Controllers\customer;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product=Product::where('id',$request->product_id)->first();
        if(!$product){
            return response()->json(['status'=>'failed','message'=>'Opss , something went wrong please try again later']);
        }
        $user=auth()->user();
        $cart=new Cart();
        $cart->product_id=$product->id;
        $cart->price=$product->productDetails->price;
        $cart->quantity='1';
        $cart->user_id=$user->id;
        $cart->save();
        
        return response()->json(['status'=>'success','message'=>'Item successfully added in your cart']);
    }

    public function viewCart(){
        $data=[];
        foreach(cartItem() as $key=>$cart){
        $data[$key]['name']=$cart->product->name;
        $data[$key]['quantity']=$cart->quantity;
        $productImage=json_decode($cart->product->image);
        $data[$key]['image']=$productImage[0];
        $data[$key]['price']=$cart->product->productDetails->price;

        }
        
        return response()->json(['status'=>'success','data'=>$data]);
    }

    public function cartDelete(Request $request){
            
        $cart=Cart::where('user_id',auth()->user()->id)->where('id',$request->cart_id)->first();
        if(!$cart){
             return response()->json(['status'=>'failed']);
        }
        $cart->delete();

        return response()->json(['status'=>'success','message'=>'Cart item delete successfully']);
    }
}
