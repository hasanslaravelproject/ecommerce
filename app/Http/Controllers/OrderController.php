<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;

class OrderController extends Controller
{

    public function index(Request $request){
      //  user token
      //  $sitename='HASAN';
     //   $token=$sitename.'_'.auth()->user()->id;
        if($request->token){
            $data['orders']=Order::where('order_token',$request->token)->simplePaginate(10);
            $data['requestData']=$request->only('token');
        }else{
            $data['orders']=Order::orderBy('created_at','desc')->simplePaginate(10);
        }


        return view('orders.index',$data);
    }

    public  function orderStatus(Request  $request){

       $request->validate([
            'status'=>'required|in:approved,on_the_way,delivered,rejected'
        ]);

        $order=Order::where('id',$request->id)->first();

        $order->status=$request->status;
        $order->save();

        return redirect()->back()->with('success','Order status changed successfully');
    }

}
