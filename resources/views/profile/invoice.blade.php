<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Invoice</title>

        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            table{
                font-size: x-small;
            }
            tfoot tr td{
                font-weight: bold;
                font-size: x-small;
            }
            .gray {
                background-color: lightgray
            }
            .font{
            font-size: 15px;
            }
            .authority {
                /*text-align: center;*/
                float: right
            }
            .authority h5 {
                margin-top: -10px;
                color: green;
                /*text-align: center;*/
                margin-left: 35px;
            }
            .thanks p {
                color: green;;
                font-size: 16px;
                font-weight: normal;
                font-family: serif;
                margin-top: 20px;
            }
        </style>

    </head>
    <body>

        <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
            <tr>
                <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: green; font-size: 26px;"><strong>TEST SHOP</strong></h2>
                </td>
                <td align="right">
                    <pre class="font" >
                        TEST SHOP Head Office
                        Email:support@SUPPORTYOURSELF.com <br>
                        TEL: 1245454545 <br>
                        Earth, Solar System, Milky Way <br>
                        
                    </pre>
                </td>
            </tr>

        </table>


        <table width="100%" style="background:white; padding:2px;""></table>

        <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
            <tr>
                <td>
                    <p class="font" style="margin-left: 20px;">
                        <strong>Name:</strong> {{ $invoice->name }} <br>
                        <strong>Email:</strong>  {{ $invoice->email }}  <br>
                        <strong>Phone:</strong>  {{ $invoice->phone }}  <br>
                        
                        <strong>Address:</strong> {{ $invoice->address_line." ".$invoice->city->name.", ".$invoice->postcode.", ".$invoice->state->name.", ".$invoice->country->name }} <br>
                        <strong>Post Code:</strong> {{ $invoice->postcode }}
                    </p>
                </td>
                <td>
                    <p class="font">
                        <h3><span style="color: green;">Invoice:</span> {{ $invoice->invoice_number }}</h3>
                        Order Date: {{ $invoice->order_date }}</h3> <br>
                        Delivery Date: {{ $invoice->delivered_date }} <br>
                        Payment Type : {{ $invoice->payment_type }}</span>
                    </p>
                </td>
            </tr>
        </table>
        <br/>
        <h3>Products</h3>


        <table width="100%">
            <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>Image</th>
                <th>Product Name</th>
                <th>Size</th>
                <th>Color</th>
                <th>Code</th>
                <th>Quantity</th>
                <th>Unit Price </th>
                <th>Total </th>
            </tr>
            </thead>
            <tbody>

            @foreach ($orderdetails as $order)
                <tr class="font">
                    <td align="center">
                        <img src="{{ public_path($order->product->product_thumbnail) }}" height="60px;" width="60px;" alt="">
                    </td>
                    <td align="center">{{ $order->product->product_name_en }}</td>
                    <td align="center">{{ $order->size }} </td>
                    <td align="center">{{ $order->color }}</td>
                    <td align="center">{{ $order->product->product_code }}</td>
                    <td align="center">{{ $order->qty }}</td>
                    <td align="center">${{ $order->price }}</td>
                    <td align="center">${{ $order->price*$order->qty }}</td>
                </tr>
            @endforeach
            
            
            </tbody>
        </table>
        <br>
        <table width="100%" style=" padding:0 10px 0 10px;">
            <tr>
                <td align="right" >
                    <h2><span style="color: green;">Subtotal:</span> ${{ $invoice->amount }} </h2>
                    <h2><span style="color: green;">Total:</span> ${{ $invoice->amount }} </h2>
                    {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
                </td>
            </tr>
        </table>
        <div class="thanks mt-3">
            <p>Order again! Thanks!</p>
        </div>
        <div class="authority float-right mt-5">
            <p>-----------------------------------</p>
            <h5>Signature:</h5>
        </div>
    </body>
</html>