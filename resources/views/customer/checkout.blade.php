@extends('layouts.customer')

@section('customer-content')
<div class="container">

    <div class="row">
            <div class="col-sm-4">
                <h4>Customer Shipping Address</h4>
            </div>
            <div class="col-sm-8">
                @php $total=0; @endphp
                @foreach(cartItem() as $cart)
                <div class="row cartDelete_{{ $cart->id }}"> 
                    <div class="col-sm-3">
                    @php $total+=$cart->product->productDetails->price; @endphp
                    @php $productImage=json_decode($cart->product->image) @endphp
                    @if($productImage)
                        <img src="{{asset('/').$productImage[0]}}" style="width:40px; height:40px;" alt="">
                        @endif
                    </div>
                    <div class="col-sm-3">
                     <p>{{$cart->product->name}} <span class="text-right mr-2">{{$cart->product->productDetails->price}}</span>
                     <span  data-id="{{$cart->id}}" class="cart-item-remove text-right ml-4"> <a href="#" class="text-danger">Delete</a> </span>
                    </p>
                    </div>
                </div>
                @endforeach
                <form action="{{route('place.order')}}" method="post" id="payment_form" class="p-3 mt-4">
                    @csrf
                    <h5>Total Pay Amount : ${{$total}}</h5>
                    <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <div class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
         <input type="radio" name="payment_status" value="card" id="cardRadio">
         <span class="ml-3" for="cardRadio">Card</span>

</div>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">

             <!-- Mount the instance within a <label> -->
             <div id="card-element"></div>
                                            
                                      
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <div class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <input type="radio" name="payment_status" value="cash" id="cashPayment">
         <span class="ml-3" for="cashPayment">Cash Payment</span>
</div>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
    <span class="text-center text-info">{{auth()->user()->name.'_'.auth()->user()->id}}</span>
    </div>
    </div>
  </div>
</div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                   
                </form>
            </div>


    </div>
</div>
@endsection

@section('js')
<script src="https://js.stripe.com/v3/"></script>
    <script !src="">
        "use strict";

        var stripe = Stripe('');
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment_form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            var cardRadio = document.getElementById('cardRadio');
            
                stripe.createToken(card).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            
        });
        
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment_form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            var form = $('#payment_form');
                if (form) {
                    form.submit();
                }
        
        }
        
        </script
@endsection