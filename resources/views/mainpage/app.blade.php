<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    @php
        $seo = App\Models\SEO::findOrFail(1);
        $favicon = App\Models\SiteSetting::findOrFail(1)->value('site_favicon');
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="{{ $seo->meta_description }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="{{ $seo->meta_author }}">
    <meta name="title" content="{{ $seo->meta_title }}">
    <meta name="keywords" content="{{ $seo->meta_keyword }}">
    <meta name="robots" content="all">

    <script>
        {!! $seo->google_analytics !!}
    </script>

    <title>@yield('title')</title>

    <link rel="icon" href="{{ asset($favicon) }}">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('main/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('main/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('main/assets/css/font-awesome.css') }}">



    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://js.stripe.com/v3/"></script>












</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('mainpage.layouts.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
@include('mainpage.layouts.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('main/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('main/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('main/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('main/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('main/assets/js/echo.min.js') }}"></script>
<script src="{{ asset('main/assets/js/jquery.easing-1.3.min.js') }}"></script>
<script src="{{ asset('main/assets/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('main/assets/js/jquery.rateit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('main/assets/js/lightbox.min.js') }}"></script>
<script src="{{ asset('main/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('main/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('main/assets/js/scripts.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var qty=0;
</script>






<script>
    @if (Session::has('message'))
        var mgs= "{{ Session::get('alert-type','info') }}"
        switch(mgs){
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                console.log(" {{ Session::get('message') }} ");
                break;
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                console.log(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.info("{{ Session::get('message') }}");
                console.log(" {{ Session::get('message') }} ");
                break;
        }
    @endif
</script>


<script>

    $(document).ready(function() {
        //$('#addToWishlish').on('click',function() {
        $(document).on('click','#addToWishlish',function(e) {
            // var layer_id = $(this).data("productcode");
            var url = '{{ route("wishlist.add") }}';
            // url = url.replace(':id', layer_id );
            $.ajax({
                type: "POST",
                dataType: "json",
                url: url,
                data: {
                    productcode:  $(this).data("productcode")
                },
                success: function (data) {
                    if(data.action==0){
                        $(this).removeClass( "btn btn-danger icon" );
                        $(this).addClass( "btn btn-success icon" );
                        console.log("added to wishlist");
                    }else if (data.action==1){
                        $(this).removeClass( "btn btn-success icon" );
                        $(this).addClass( "btn btn-danger icon" );
                        console.log("removed from wishlist");
                    }


                    console.log(data);
                    Swal.fire(

                        data.message,
                    );


                },
                error: function(xhr){
                    alert( xhr.status + " " + xhr.statusText);
                }


            });

        });
    });

</script>


<!-- Modal -->
<div class="modal fade" id="addtocart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 820px; right: 120px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span id = "productname"></span></h5>
          <button type="button" class="close" data-dismiss="modal" id="modalClose" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" id="thumbnail" src="" alt="" style="width: 200px; height: 200px;">
                        <div class="card-body">

                        </div>
                      </div>
                </div>

                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            @if (session()->get('language')=='rus')
                                Цена: <span id="price" >   </span> <span style="text-decoration: line-through;" id="pricebefore" ></span>
                            @elseif (session()->get('language')=='eng')
                                Price: <span id="price" >  </span> <span style="text-decoration: line-through;" id="pricebefore" ></span>
                            @else
                                Price: <span id="price" >  </span> <span style="text-decoration: line-through;" id="pricebefore" ></span>
                            @endif

                        </li>
                        <li class="list-group-item ">
                            @if (session()->get('language')=='rus')
                                Код: <span id="productcode" ></span>
                            @elseif (session()->get('language')=='eng')
                                Code: <span id="productcode" ></span>
                            @else
                                Code: <span id="productcode" ></span>
                            @endif

                        </li>
                        <li class="list-group-item ">
                            @if (session()->get('language')=='rus')
                                Категория: <span id="category" ></span>
                            @elseif (session()->get('language')=='eng')
                                Category: <span id="category" ></span>
                            @else
                                Category: <span id="category" ></span>
                            @endif

                        </li>
                        <li class="list-group-item ">
                            @if (session()->get('language')=='rus')
                                Марка: <span id="brand" ></span>
                            @elseif (session()->get('language')=='eng')
                                Brand: <span id="brand" ></span>
                            @else
                                Brand: <span id="brand" ></span>
                            @endif

                        </li>
                        <li class="list-group-item ">
                            @if (session()->get('language')=='rus')
                                Снабжать: <span id="prodstock" ></span>
                            @elseif (session()->get('language')=='eng')
                                Stock: <span id="prodstock" ></span>
                            @else
                                Stock: <span id="prodstock" ></span>
                            @endif

                        </li>
                      </ul>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Size:</label>
                        <select class="form-control" id="productsize">
                          <option>1</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Color:</label>
                        <select class="form-control" id="productcolor">
                          <option>1</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="qty">Quantity:</label>
                        <input type="number" class="form-control" id="prodqty" placeholder="1" min="1" >

                      </div>
                      <input type="hidden" id="productcode">
                      <button type="submit" class="btn btn-primary mb-2" id="cartsubmit" onclick="addToCart()">Add to Cart</button>
                </div>
            </div>





        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
  <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        function cart(id){

            var layer_id = id;
            var url = '{{ route("main.product.cart_get", ":id") }}';
            url = url.replace(':id', layer_id );
            //console.log(url);
            //url = url.replace(':id', layer_id );


            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(data){
                    //console.log(data);
                    var thumbnail='{{ asset(':id') }}';
                    thumbnail = thumbnail.replace(":id",data.product.product_thumbnail)

                    //console.log(thumbnail);

                    if (!data.product.product_size_en){
                        data.product.product_size_en="n/a";
                    }
                    if (!data.product.product_size_ph){
                        data.product.product_size_ph="n/a";
                    }
                    if (!data.product.product_color_en){
                        data.product.product_color_en="n/a";
                    }
                    if (!data.product.product_color_ph){
                        data.product.product_color_ph="n/a";
                    }


                    var price=0.00,pricebeforediscount ='';
                    if (!data.product.product_discount){
                        price=data.product.product_prize;
                        console.log("non-discounted");
                    }
                    else{
                        pricebeforediscount='$'+data.product.product_prize;;
                        price=data.product.product_prize-(data.product.product_prize* (data.product.product_discount*0.010 ));
                        console.log("discounted");
                    }

                    var size_en= data.product.product_size_en.split(",");
                    var size_ru= data.product.product_size_ph.split(",");
                    var color_en= data.product.product_color_en.split(",");
                    var color_ru= data.product.product_color_ph.split(",");




                    //console.log(size_en);


                    @if (session()->get('language')=='rus')
                        $('#productname').text(data.product.product_name_ph);
                        $('#price').html('$'+price);
                        $('#pricebefore').html(pricebeforediscount);
                        $('#productcode').text(data.product.product_code);
                        $('#category').text(data.product.category.category_name_ph);
                        $('#brand').text(data.product.brand.brand_name_ph);
                        $('#prodqty').val(0);

                        $('#productsize').empty();
                        $.each(size_ru,function(key,value){
                            $('#productsize').append('<option value ="'+value+'">'+value+'</option>');

                        });

                        $('#productcolor').empty();
                        $.each(color_ru,function(key,value){
                            $('#productcolor').append('<option value ="'+value+'">'+value+'</option>');

                        });
                    @else
                        $('#productname').text(data.product.product_name_en);
                        $('#price').html('$'+price);
                        $('#pricebefore').html(pricebeforediscount);
                        $('#productcode').text(data.product.product_code);
                        $('#category').text(data.product.category.category_name_en);
                        $('#brand').text(data.product.brand.brand_name_en);
                        $('#prodqty').val(0);

                        $('#productsize').empty();
                        $.each(size_en,function(key,value){
                            $('#productsize').append('<option value ="'+value+'">'+value+'</option>');
                            console.log(value);
                        });

                        $('#productcolor').empty();
                        $.each(color_en,function(key,value){
                            $('#productcolor').append('<option value ="'+value+'">'+value+'</option>');

                        });

                    @endif


                    qty=data.product.product_qty;
                    $('#prodqty').attr("max",data.product.product_qty);
                    $('#prodstock').text(data.product.product_qty);
                    $("#thumbnail").empty();
                    $("#thumbnail").attr("src",thumbnail).attr("alt","PRODUCT IMAGE");
                    $('#cartsubmit').prop("disabled",false);
                    //*********************
                    $("#productcode").val(data.product.product_code);

                    if(data.product.product_qty ==0){
                        $('#prodstock').text("OUT OF STOCK");
                        $('#prodqty').attr("placeholder","OUT OF STOCK");
                        //$('#prodqty').attr("disabled","");
                        $('#cartsubmit').prop("disabled",true);
                    }


                }
            });
        }


    function addToCart(){
        var productcode = $("#productcode").val();
        var productcolor = $('#productcolor').val();
        var productsize = $('#productsize').val();
        var prodqty =  parseInt( $('#prodqty').val());

        if((prodqty<=0)||(!prodqty)){
            Swal.fire(
                'Invalid!',
                'Input quantity!',
                'warning'
            )
            return;
        }

        if(prodqty>qty){
            Swal.fire(
                'Invalid!',
                'Invalid quantity!',
                'warning'
            )
            return;
        }



        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                productcolor: productcolor,
                productsize: productsize,
                prodqty: prodqty,
                productcode: productcode
            },
            url: "/cart/add",
            success: function(data){
                $('#modalClose').click();
                console.log(data);
                headerCart();
            },
            error: function(xhr){
                alert( xhr.status + " " + xhr.statusText);
            }
        });


        console.log($("#productcode").val());
        console.log(productcolor+" "+productsize+" "+prodqty);
    }
</script>


<script>

    function headerCart(){
        $.ajax({
            type: "GET",
            url: "/cart/header",
            dataType: "json",
            success: function(data){
                console.log(data);
                var htm="";
                $.each(data.cart.cart_items,function(key,value){
                    htm +=`
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="image"> <a href="detail.html"><img src="${value.options.image}" alt=""></a> </div>
                            </div>
                            <div class="col-xs-7">
                                <h3 class="name"><a href="#">${value.name}</a></h3>
                                <div class="price">$${value.price} X ${value.qty}</div>
                                <div class="price">$${value.subtotal}</div>
                            </div>
                            <div class="col-xs-1 action"> <button  onclick="removefromcart('${value.rowId}')"><i class="fa fa-trash"></i></button> </div>
                        </div><hr>`;
                    $('#header_cart').html(htm);

                });
                $('#header_cart_qty').text(data.cart.cart_count);
                $('#header_cart_total').text(data.cart.cart_total);
                $('#header_cart_total_2').text(data.cart.cart_total);
            },
            error: function (xhr) {
                alert( xhr.status + " " + xhr.statusText);
            }
        });

    }

    $(document).ready(function(){
        headerCart();
    });
</script>

<script>

    function removefromcart(rowId){
        $.ajax({
            type: "GET",
            url: "/cart/remove/"+rowId,
            dataType: "json",
            success: function(data){
                console.log(data);
                headerCart();
                if((window.location.href=="{{ route('cart.index') }}")||(window.location.href=="{{ route('cart.index') }}"+'#')){
                    myCartPage();
                }
                
                couponApplied();
            },
            error: function(xhr){
                alert( xhr.status + " " + xhr.statusText);
            }
        });
    }

    function clearcart(){
        $.ajax({
            type: "GET",
            url: "/cart/clear/",
            dataType: "json",
            success: function(data){
                console.log(data);
                headerCart();
                $('#header_cart').empty();

                if((window.location.href=="{{ route('cart.index') }}")||(window.location.href=="{{ route('cart.index') }}"+'#')){
                    myCartPage();
                    $('#myCartPage').empty();
                }
                couponApplied();
            },
            error: function(xhr){
                alert( xhr.status + " " + xhr.statusText);
            }
        });
    }



    function wishList(){

        var url = "{{ route('wishlist.show') }}";

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(data){
                console.log(data);
                var htm="";
                $.each(data.wishlist,function(key,value){


                    var thumbnail='{{ asset(':id') }}';
                    thumbnail = thumbnail.replace(":id",value.product.product_thumbnail);

                    @if (session()->get('language')=='rus')
                        var name=value.product.product_name_ph;
                    @else
                        var name=value.product.product_name_en;
                    @endif

                    if(value.product.product_discount){
                        var price=value.product.product_prize-(value.product.product_prize* (value.product.product_discount*0.010 ));
                    }else{
                        var price=value.product.product_prize;
                    }




                    console.log(value);
                    htm +=`
                    <tr>
                        <td class="col-md-2"><img src="${ thumbnail }" alt="phoro"></td>
                        <td class="col-md-7">
                            <div class="product-name"><a href="#">${name}</a></div>
                            <div class="rating">
                                <i class="fa fa-star rate"></i>
                                <i class="fa fa-star rate"></i>
                                <i class="fa fa-star rate"></i>
                                <i class="fa fa-star rate"></i>
                                <i class="fa fa-star non-rate"></i>
                                <span class="review">( 06 Reviews )</span>
                            </div>
                            <div class="price">
                                $ ${price}
                                <span>${ (value.product.product_discount)?'$'+value.product.product_prize:'' } </span>
                            </div>
                        </td>
                        <td class="col-md-2">
                            <button data-toggle="modal" data-target="#addtocart" id="${value.product.product_slug_en}" onclick=cart("${value.product.product_slug_en}") type="button" title="Add Cart"class="btn btn-success" ${ (value.product.product_qty<1)?'disabled':'' } >Add to cart</button>
                        </td>
                        <td class="col-md-1 close-btn">
                            <button class="btn btn-outline-danger" onclick="removefromWL('${value.id}')"> <i class="fa fa-times"></i></button>
                        </td>
				    </tr>`;
                    $('#wishlist_page').html(htm);

                });

            },
            error: function (xhr) {
                alert( xhr.status + " " + xhr.statusText);
            }
        });

    }


    function removefromWL(id){
        console.log(id);
        var layer_id = id;
        var url = '{{ route("wishlist.delete", ":id") }}';
        url = url.replace(':id', layer_id );
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {
                "id": id
            },
            success: function(data){
                Swal.fire(
                    data.message
                );
                wishList();
            },
            error: function (xhr) {
                alert( xhr.status + " " + xhr.statusText);
            }


        });
    }









    $(document).on('click','#cancelorder',function(e){
        e.preventDefault()


        //console.log('TEST');
        Swal.fire({
                title: 'Cancel Order?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cancel order!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr("href");
                Swal.fire(
                    'Order Cancelled!',
                    'DONE!.',
                    'success'
                )
            }
            })
    });
</script>




</body>
</html>