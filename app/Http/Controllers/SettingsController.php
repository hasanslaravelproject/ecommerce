<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
$data=[];
        $stripeSettings = Settings::where('key', 'stripe_credentials')->first();
        if ($stripeSettings) {
            $data['stripe'] = json_decode($stripeSettings->value);
            $data['stripeId'] = $stripeSettings->id;
        }

        $orderSettings = Settings::where('key', 'order_booking')->first();
        if ($orderSettings) {
            $data['order_setting'] = json_decode($orderSettings->value);
            $data['order_setting_id'] = $orderSettings->id;
        }

        return view('settings.index', $data);
    }

    public function paymentGateway(Request $request)
    {

        $ruquestData = $request->only('stripe_publishable_key', 'stripe_secret_key');

        $stripe = isset($request->stripe_id) ? Settings::find($request->stripe_id) : new Settings();
        $stripe->key = 'stripe_credentials';
        $stripe->value = json_encode($ruquestData);
        $stripe->save();

        return redirect()->back();

    }

    public function orderSetting(Request $request)
    {

        $ruquestData = $request->only('order_booking');
        $stripe = isset($request->order_setting_id) ? Settings::find($request->order_setting_id) : new Settings();
        $stripe->key = 'order_booking';
        $stripe->value = json_encode($ruquestData);
        $stripe->save();

        return redirect()->back()->with('success', 'Order settings added successfully');
    }
}
