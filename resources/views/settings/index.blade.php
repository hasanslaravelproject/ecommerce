@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-1">
                <div class="card p-4">
                    <form action="{{route('admin.payment.gateway')}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" value="{{isset($stripeId)?$stripeId:''}}" name="stripe_id">
                        <div class="form-group">
                            <label for="">Stripe Publishable Key</label>
                            <input type="text" value="{{isset($stripe->stripe_publishable_key)?$stripe->stripe_publishable_key:''}}" class="form-control" name="stripe_publishable_key">
                        </div>

                        <div class="form-group">
                            <label for="">Stripe Secret Key</label>
                            <input type="text" value="{{isset($stripe->stripe_secret_key)?$stripe->stripe_secret_key:''}}" class="form-control" name="stripe_secret_key">
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success badge-success light" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="card p-4">
                    <h4>Site Settings</h4>
                    <hr>
                    <form action="{{route('order.settings')}}" method="post">
                        @csrf
                        @method('put')
                        @if(isset($order_setting_id) && $order_setting_id)
                        <input type="hidden" name="order_setting_id" value="{{$order_setting_id}}">
                        @endif
                        <div class="form-group">
                            <label for="">Order booking time</label>
                            <input type="text" value="{{isset($order_setting)?$order_setting->order_booking:''}}" class="form-control" name="order_booking">
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
