@extends('mainpage.app')

@section('content')

@section('title')
    @if (session()->get('language')=='rus')
        STRIPE Оплата
    @elseif (session()->get('language')=='eng')
        Stripe Payment
    @else
        Stripe Payment
    @endif
@endsection
<style>
        /**
    * The CSS shown here will not be introduced in the Quickstart guide, but shows
    * how you can use CSS to style your Element's container.
    */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>


@php
    $data=array_shift($data);
    
@endphp



<hr>
<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				
				<div class="col-md-6">
					<!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Order Details:</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        
                                        @foreach ($cart_items as $content)                                                
                                            <li>                                                
                                                <img src="{{ asset($content->options->image) }}" alt="" style="width: 50px; height: 50px;">
                                                <b>{{ $content->name }}</b>
                                            </li>
                                            <li>
                                                <strong>Qty:</strong>
                                                {{ $content->qty }}

                                                <strong>Color:</strong>
                                                {{ $content->options->color }}

                                                <strong>Size (if any):</strong>
                                                {{ $content->options->size }}
                                            </li>                                            
                                            <hr>
                                        @endforeach
                                        
                                        
                                    </ul>		
                                </div>
                            </div>
                        </div>
                    </div> 	
                </div>

                <div class="col-md-6">
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Payment details:</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        
                                        
                                        <li>
                                            <table>
                                                <tr>
                                                    <th width="50%"> <hr></th><th width="50%"> <hr></th>
                                                </tr>
                                                <tr>                                                    
                                                    <td>
                                                        <strong>Total items: </strong> <span class="text-right"> {{ $cart_count }}</span>
                                                    </td>
                                                    <td>
                                                        <strong>Coupon (if any):</strong> {{ $coupon }}            
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Email: </strong> <span class="text-right"> ${{ $data['shipping_email'] }}</span>
                                                    </td>
                                                    <td>
                                                        <strong>Phone:</strong> {{ $data['shipping_phone'] }}            
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>Postcode: </strong> <span class="text-right"> {{ $data['postcode'] }}</span>
                                                    </td>
                                                    <td>
                                                        <strong>Notes (if any):</strong> {{ $data['notes'] }}            
                                                    </td>
                                                </tr>
                                            
                                            
                                                
                                            
                                        
                                                <tr>
                                                    <th width="50%"></th><th width="50%"></th>
                                                </tr>
                                                <tr>                                                    
                                                    <td>
                                                        <strong>Full name: </strong> <span class="text-right"> {{ $data['shipping_name'] }}</span>
                                                    </td>
                                                    <td>
                                                        <strong>Subtotal: </strong> <span class="text-right"> ${{ $cart_totalbeforediscount }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Address:</strong> {{ $data['complete_address'] }}                                                                    
                                                    </td>
                                                    <td>
                                                        <strong>Grand Total:</strong> ${{ $cart_totalafterdiscount }}            
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                            
                                            
                                        </li>
                                        
                                        
                                    </ul>		
                                </div>
                            </div>
                        </div>
                    </div> 	
                </div>

                <div class="col-md-6">
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Confirm Payment:
                                        <img src="{{ asset('main/assets/images/payments/2.png') }}" alt="">
                                        <img src="{{ asset('main/assets/images/payments/3.png') }}" alt="">
                                        <img src="{{ asset('main/assets/images/payments/4.png') }}" alt="">
                                        <img src="{{ asset('main/assets/images/payments/5.png') }}" alt="">
                                    </h4>
                                </div>
                                <div class="">
                                    <form action="{{ route('payments.stripe') }}" method="post" id="payment-form">                                    
                                        @csrf
                                        <div class="form-row">
                                          <label for="card-element">
                                            Credit or debit card
                                          </label>
                                          <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                          </div>
                                      
                                          <!-- Used to display Element errors. -->
                                          <div id="card-errors" role="alert"></div>
                                        </div>
                                        
                                        <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                        <input type="hidden" name="address_line" value="{{ $data['shipping_address_line'] }}">
                                        <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                        <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                        <input type="hidden" name="postcode" value="{{ $data['postcode'] }}">
                                        <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                        <input type="hidden" name="full_address" value="{{ $data['complete_address'] }}">
                                        <input type="hidden" name="city" value="{{ $data['city'] }}">
                                        <input type="hidden" name="state" value="{{ $data['state'] }}">
                                        <input type="hidden" name="country" value="{{ $data['country'] }}">
                                        <input type="hidden" name="city_id" value="{{ $data['city_id'] }}">
                                        <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                        <input type="hidden" name="country_id" value="{{ $data['country_id'] }}">
                                        
                                        <input type="hidden" name="qty" value="{{ $cart_count }}">
                                        <input type="hidden" name="total" value="{{ $cart_totalafterdiscount }}">
                                        
                                        <button class="btn btn-primary">Submit Payment</button>
                                      </form>	
                                </div>
                            </div>
                        </div>
                    </div> 	
                </div>


                




			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('mainpage.layouts.brands')
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->



<script type="text/javascript">
    // Create a Stripe client.
    var stripe = Stripe('pk_test_51JZcX1EICKb0t7I8NiVdlwxcyloDufmOPS1moPYLKbfMbKn8nHZiAh72Fi7nNJi8wfSK5eNYaCdhYfT9cDWS2oKL00J8poO8qF');
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
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
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
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
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
</script>

@endsection



