

{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> --}}

@extends('mainpage.app')

@section('title')
    @if (session()->get('language')=='rus')
        Отслеживание заказа
    @elseif (session()->get('language')=='eng')
        Order Tracking
    @else
        Order Tracking
    @endif
@endsection

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

    body {
        background-color: #eeeeee;
        font-family: 'Open Sans', serif
    }

    

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #157ed2
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #157ed2;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }
    
</style>

    <div class="container">
        <article class="card">
            <header class="card-header">
                @if (session()->get('language')=='rus')
                    Отслеживание заказа
                @elseif (session()->get('language')=='eng')
                    Order Tracking
                @else
                    Order Tracking
                @endif
            </header>
            <div class="card-body" style="padding: 5px">
                <h6>
                    @if (session()->get('language')=='rus')
                        Номер заказа:
                    @elseif (session()->get('language')=='eng')
                        Order Number:
                    @else
                        Order Number:
                    @endif
                    {{ $order->order_number }}
                </h6>
                <h6>
                    @if (session()->get('language')=='rus')
                        Номер счета:
                    @elseif (session()->get('language')=='eng')
                        Invoice number: 
                    @else
                        Invoice number: 
                    @endif                      
                    {{ $order->invoice_number }}
                </h6>
                {{-- <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Estimated Delivery time:</strong> <br>29 nov 2019 </div>
                        <div class="col"> <strong>Shipping BY:</strong> <br> BLUEDART, | <i class="fa fa-phone"></i> +1598675986 </div>
                        <div class="col"> <strong>Status:</strong> <br> Picked by the courier </div>
                        <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                    </div>
                </article> --}}
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <strong>Date Ordered: </strong>                        
                        <br>
                         {{ $order->order_date }}
                    </div> 
                    
                    <div class="col-md-3">                        
                        <strong>Delivery address: </strong>                        
                        <br>
                        {{ $order->address_line.", ".$order->city->name,"," }} <br>
                        {{ $order->state->name.", ".$order->country->name." ".$order->postcode }}
                    </div>

                    <div class="col-md-3">                        
                        <strong>Costumer details: </strong>                        
                        <br>
                        Name:{{ $order->name }} <br>
                        Email:{{ $order->email }} <br>
                        Phone:{{ $order->phone }} <br>
                    </div>

                    <div class="col-md-4">
                        <strong>Transaction Details: </strong>                        
                        <br>
                        Payment Method:  {{ $order->payment_type}} <br>
                        Amount:  ${{ $order->amount }} <br>
                        Transaction ID:  ${{ $order->transaction_id }}
                    </div>
                </div>

                <div class="track">
                    <div class="step {{ ($order->status>=1)?'active':'' }}"> <span class="icon"> <i class="fa fa-fa fa-hourglass-end"></i> </span> <span class="text">Awaiting confirmation</span> </div>
                    <div class="step {{ ($order->status>=2)?'active':'' }} "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                    <div class="step {{ ($order->status>=3)?'active':'' }} "> <span class="icon"> <i class="fa fa-pencil-square-o"></i> </span> <span class="text">Processing order</span> </div>
                    <div class="step {{ ($order->status>=4)?'active':'' }} "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked by courier</span> </div>
                    <div class="step {{ ($order->status>=5)?'active':'' }} "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">On the way</span> </div>
                    <div class="step {{ ($order->status>=6)?'active':'' }} "> <span class="icon"> <i class="fa fa-dropbox"></i> </span> <span class="text">Order has been delivered</span> </div>
                </div>
                <hr>
                <ul class="row">
                    @foreach ($orderdetails as $orderdetail)
                        <li class="col-md-4">
                            <figure class="itemside mb-3">
                                <div class="aside"><img src="{{ asset($orderdetail->product->product_thumbnail) }}" class="img-sm border"></div>
                                <figcaption class="info align-self-center">
                                    <p class="title">{{ $orderdetail->product->product_name_en }} <br> <span class="text-muted">${{ $orderdetail->price }} </span>
                                </figcaption>
                            </figure>
                        </li>  
                    @endforeach                    
                </ul>
                {{-- <hr> <a href="#" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a> --}}
            </div>
        </article>
    </div>

@endsection
