@extends('mainpage.app')




@section('title')
    @if (session()->get('language')=='rus')
        Моя тележка
    @elseif (session()->get('language')=='eng')
        My Cart
    @else
        My Cart
    @endif
@endsection


@section('content')
    <div class="body-content outer-top-xs">
        <div class="container">            
            <div class="row">
                <div class="shopping-cart">
                    <div class="shopping-cart-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>                                        
                                        <th class="cart-description item">Image</th>
                                        <th class="cart-product-name item">Product Name</th>                                        
                                        <th class="cart-total last-item">Details</th>
                                        <th class="cart-romove item">Remove</th>
                                    </tr>
                                </thead>
                                <tbody id ="myCartPage">
                                                        
                                </tbody>
                                
                            </table>                                                        
                        </div>
                    </div>
                </div>	
                <br>
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">Estimate shipping and tax</span>
                                    <p>Enter your destination to get shipping and tax.</p>
                                </th>
                            </tr>
                        </thead><!-- /thead -->
                        <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="info-title control-label">Country <span>*</span></label>
                                            <select class="form-control unicase-form-control selectpicker">
                                                <option>--Select options--</option>
                                                <option>India</option>
                                                <option>SriLanka</option>
                                                <option>united kingdom</option>
                                                <option>saudi arabia</option>
                                                <option>united arab emirates</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">State/Province <span>*</span></label>
                                            <select class="form-control unicase-form-control selectpicker">
                                                <option>--Select options--</option>
                                                <option>TamilNadu</option>
                                                <option>Kerala</option>
                                                <option>Andhra Pradesh</option>
                                                <option>Karnataka</option>
                                                <option>Madhya Pradesh</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">Zip/Postal Code</label>
                                            <input type="text" class="form-control unicase-form-control text-input" placeholder="">
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    </table> --}}
                </div><!-- /.estimate-ship-tax -->
                
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    @if (Session::has('coupon'))

                    @else
                        
                    
                        <table class="table" id="couponTable">
                            <thead id=>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Discount Code</span>
                                        <p>Enter your coupon code if you have one..</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control unicase-form-control text-input" placeholder="Your Coupon.." name="coupon_name" id="coupon_name">
                                            </div>
                                            <div class="clearfix pull-right">
                                                <button type="submit" class="btn-upper btn btn-primary" id="applyCoupon">APPLY COUPON</button>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    @endif
                </div><!-- /.estimate-ship-tax -->
                
                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead id="prices">
                            
                        </thead><!-- /thead -->
                        <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <a href="{{ route('checkout') }}" type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>
                                            {{-- <span class="">Checkout with multiples address!</span> --}}
                                        </div>
                                    </td>
                                </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->	
                    
                    
            </div><!-- /.row -->
            
            
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            
            @include('mainpage.layouts.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	
        </div><!-- /.container -->
        
    </div><!-- /.body-content -->
    

    














    <script>
        $(document).ready(function(){
            myCartPage();
            couponApplied();
        });    









        function myCartPage(){
        
            var url = "{{ route('cart.show') }}";
            
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(data){
                    console.log(data);
                    var htm="";
                    $.each(data.cart.cart_items,function(key,value){
                        
                        console.log(value);
                        htm +=`                
                        <tr>
                            <td class="cart-image"><img src="${ value.options.image }" alt="phoro"></td>
                            <td class="cart-product-name-info">
                                <div class="product-name"><a href="#">${value.name}</a></div>
                                <div class="rating">
                                    <i class="fa fa-star rate"></i>
                                    <i class="fa fa-star rate"></i>
                                    <i class="fa fa-star rate"></i>
                                    <i class="fa fa-star rate"></i>
                                    <i class="fa fa-star non-rate"></i>
                                    <span class="review">( 06 Reviews )</span>
                                </div>
                                <div class="price">
                                    SubTotal: $${value.subtotal} 
                                    
                                </div>
                                Quantity: (${value.options.max_qty} Available) <button type="submit" onclick=(increaseQty("${value.rowId}"))>+</button> <input type="text" disabled style="width: 25px" value=${value.qty}> <button type="submit" onclick=(decreaseQty("${value.rowId}"))>-</button>
                            </td>
                            <td class="cart-product-info">
                                <div class="price">
                                    $ ${value.price} * ${value.qty}
                                </div>
                                <strong>Color:${value.options.color}</strong>
                                <strong>Size:${value.options.size}</strong>
                                
                            </td>

                            <td class="romove-item">
                                <button class="btn btn-outline-danger btn-sm" onclick=(removefromcart("${value.rowId}")) > <i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>`;          
                        $('#myCartPage').html(htm);
                        
                    });
                    
                },
                error: function (xhr) {  
                    alert( xhr.status + " " + xhr.statusText);
                }
            });

            
     
        }


        
    </script>


    <script>
        function decreaseQty(rowId){
            updateCart(-1,rowId);
            
        }

        function increaseQty(rowId){
            updateCart(1,rowId);
            
        }

        function updateCart(increment,rowId){
            var url = "{{ route('cart.update') }}"
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {
                    increment: increment,
                    rowId: rowId
                },
                success: function(data){
                    myCartPage();
                    headerCart();
                    couponApplied();
                    console.log(data);
                },
                error: function (xhr) {  
                    alert( xhr.status + " " + xhr.statusText);
                }
            });  
        }

        $("#applyCoupon").click(function(){
            var  url="";
            var couponName = $('#coupon_name').val();
            url = "{{ route('coupons.apply') }}"
            $.ajax({
                type: "POST",
                dataType: "json",
                url: url,
                data: {
                    couponName: couponName
                },
                success: function(data){
                    Swal.fire(
                            data.message
                    );
                    if(data.applied==1){                        
                        couponApplied();
                    }
                    
                    
                },
                error: function (xhr) {  
                    alert( xhr.status + " " + xhr.statusText);
                }
            });
        });


        function couponApplied(){
            var url = "{{ route('coupons.applied') }}";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(data){
                    
                    if(data.total>=0){
                        $('#prices').html(`
                            <tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">$ ${data.total}</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">$ ${data.total}</span>
                                    </div>
                                </th>
                            </tr>
                        `);
                    }else{
                        console.log(data);
                        $('#prices').html(`
                            <tr>
                                <th>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="couponRemove()"> Remove Coupon<i class="fa fa-times"></i></button>
                                    <div class="cart-sub-total">
                                        Subtotal(before coupon):<span class="inner-left-md">$ ${data.total_price}</span>                                        
                                    </div>
                                    <div class="cart-sub-total">
                                        Applied Coupon:<span class="inner-left-md">${data.coupon_name} </span>
                                    </div>
                                    <div class="cart-sub-total">
                                        Applied Coupon Discount:<span class="inner-left-md">${data.coupon_discount}% </span>
                                    </div>

                                    <div class="cart-sub-total">
                                        You save:<span class="inner-left-md">$${data.you_save}! </span>
                                    </div>

                                    <div class="cart-grand-total">
                                        Grand Total(after coupon):<span class="inner-left-md">$ ${data.discounted_price}</span>
                                    </div>
                                </th>
                            </tr>
                        `);
                        $('#couponTable').hide();
                    }
                    
                   
                },
                error: function (xhr) {  
                    alert( xhr.status + " " + xhr.statusText);
                }
            })
        }


        function couponRemove() {  
            $('#couponTable').show();
            var url="{{ route('coupons.removeAjax') }}";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(data){                                        
                    Swal.fire(
                        data.message
                    );
                    couponApplied();
                    
                    
                },
                error: function (xhr) {  
                    alert( xhr.status + " " + xhr.statusText);
                }
            });
        }



    </script>



@endsection
