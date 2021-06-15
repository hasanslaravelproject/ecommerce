<?php

namespace App\Http\Controllers\customer;

use App\Models\Cart;
use App\Models\Brand;
use App\Models\EmailTemplate;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {

        $products = Product::where('status', 'inactive');

        $data['newProducts'] = $products->orderBy('created_at', 'desc')->limit(20)->get();
        $data['brands'] = Brand::orderBy('created_at', 'desc')->limit(20)->get();
        $data['Products'] = Product::where('status', 'active')->orderBy('created_at', 'desc')->limit(1)->get();

        return view('customer.index', $data);
    }


    public function checkout()
    {

        return view('customer.checkout');
    }

    public function placeOrder(Request $request)
    {

        try {

            $user = auth()->user();
            $total = cartItem()->sum('price');
            $discountAmount = 0;
            foreach (cartItem() as $cart) {
                if ($cart->product->discount_type == 'flat') {
                    $discountAmount += $cart->product->discount;
                } else if ($cart->product->discount_type == 'percentage') {
                    $discountAmount += ($cart->price * $cart->product) / 100;
                }
            }
            $settings = \App\Models\Settings::where('key', 'order_booking')->first();
            $validateTime = json_decode($settings->value);
            if ($validateTime) {
                $time = $validateTime;
            } else {
                $time = 30;
            }

            $auth = auth()->user();

            //  user token
            $sitename = 'HASAN';
            $nowTime = now('dd');
            $token = $sitename . '_' . auth()->user()->id . '_' . $nowTime;


            $order = new Order();
            $order->total = $total - $discountAmount;
            $order->discount = $discountAmount;
            $order->status = 'pending';
            $order->payment_status = 'unpaid';
            $order->order_token = $token;
            $order->expire_date = now()->addDay($time);
            $order->token = $auth->name . '_' . $auth->id;
            $order->save();

            if ($request->payment_type == 'card') {
                $stripe = new \Stripe\StripeClient($dataSecretKey->stripe_secret_key);
                $stripeResponse = $stripe->charges->create([
                    'amount' => (double)$order->total * 100,
                    'currency' => 'USD',
                    'source' => $request->stripeToken,
                    'description' => 'Nullable',
                ]);
                $orderUpdate = Order::find($order->id);
                $orderUpdate->payment_status = 'paid';
                $orderUpdate->save();
            } else {
                $orderUpdate = Order::find($order->id);
                $orderUpdate->payment_status = 'unpaid';
                $orderUpdate->save();
            }

            $template = EmailTemplate::where('type', 'order')->first();

            $templateBody = str_replace('{customer_name}', $user->name, 'placed  a new order');

            send_email($user->email, 'New order has placed', $templateBody);

            foreach (cartItem() as $cart) {
                $orderDetails = new OrderDetail();
                $orderDetails->order_id = $order->id;
                $orderDetails->price = $cart->price;
                $orderDetails->quantity = $cart->quantity;
                $orderDetails->product_id = $cart->product_id;
                $orderDetails->save();
            }


            return redirect()->back()->with('success', 'Order placed succesfully');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->back()->withErrors(['fail' => 'There was some problem , try again later']);
        }
    }

}
