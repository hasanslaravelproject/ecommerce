<?php

use App\Models\Cart;

function cartItem()
{
    $cart=Cart::where('user_id',auth()->user()->id)->get();

    return $cart;
}

function send_email($to, $subject, $message)
{

    $settings=Settings::where('key','email_setting')->first();
    $mailSetting = json_decode($settings);
    $data = [
        'driver' => 'smtp',
        'host' => $mailSetting->host,
        'port' => $mailSetting->port,
        'from' => ['address' => $mailSetting->email, 'name' => 'E-Commerce'],
        'encryption' => $mailSetting->encryption_type,
        'username' => $mailSetting->email,
        'password' => $mailSetting->password,
        'sendmail' => '/usr/sbin/sendmail -bs',
        'pretend' => false
    ];
    \Illuminate\Support\Facades\Config::set('mail', $data);

    try {
        \Illuminate\Support\Facades\Mail::send('mailTemplate', ['mailTemplate' => $message], function ($m) use ($to, $subject, $mailSetting) {
            $m->to($to)->subject($subject);
        });

    } catch (\Exception $ex) {

    }
}





















?>
