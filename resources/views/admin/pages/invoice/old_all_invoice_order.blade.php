<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <style>
        * {
            margin: 0;
            font-family: "Times New Roman", Times, serif;
            padding: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {

            padding: 70px;
            height: 95vh;
            text-align: center
        }

        .logobar {
            width: 100%;
            height: 100px;
            background-color: rgb(255, 255, 255);
            text-align: right
        }

        .heading-area {
            width: 100%;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 1px solid black;
            margin-top: 40px;



        }

        .body-content {
            width: 100%;
            background-color: rgb(255, 255, 255);
            text-align: justify;
            margin-top: 20px;
            display: flex;
            flex-wrap: nowrap;
            flex-direction: column;
            align-content: center;
            justify-content: center;
        }

        a {
            color: #066fd0;
            text-decoration: underline;
        }

        .footer {
            width: 100%;
            background-color: rgb(255, 255, 255);
            text-align: center;
            margin-top: 20px;
            display: flex;
            flex-wrap: nowrap;
            flex-direction: column;
            align-content: center;
            justify-content: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        table {
            width: 70%;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            margin-left: 15%;
        }

        .watermark {
            position: fixed;
            margin: 50%;
            /* bottom: 0; */
            /* right: 0; */
            width: 100%;
            height: 100%;
            opacity: 0.1;
            color: black;
            z-index: 0;
            transform: rotate(-45deg);
            align-items: center;
        }

        .watermark h1 {
            font-size: 110px;
            text-transform: capitalize;
        }

        .f-18 {
            font-size: 18px !important
        }

        .f-15 {
            font-size: 15px !important
        }

        .f-20 {
            font-size: 20px !important
        }
        .mybtn{
         padding:10px 30px 10px 30px;
         background-color:#f7cb00;
         color: black !important;
         border-radius:50%;
         text-decoration:none;
         font-weight:bolder;
         box-shadow:2px 2px 2px 2px
          border:2px solid #bd9c06;
        }
        
        .myimg{
            position:absolute;
            top:0;
            left:35%;
            width:30%;
            margin-bottom:5%;
        }
    </style>
</head>

<body>
    <div class="watermark">
        <h1>the design pals</h1>
    </div>
    <div class="container">
        <div class="logobar">
            <img src="{{ public_path('assets/img/Logo.png') }}" style="margin-bottom:10px" alt="logo" height="80"
                width="200" />
            <h3 style="margin-top: 20px">INVOICE NO: @if($invoice){{$invoice->invoice_no}} @endif</h3>
        </div>
        <div class="heading-area">
            {{-- @foreach ($all_invoices as $invoice)
            @endforeach --}}

            <p class="f-18">Bill To: <b class="f-20">
                    @if($client){{$client->name}} @endif
                </b></p>
            <p class="f-18">Company Name: <b class="f-20">
                @if($client){{$client->company}} @endif
                </b></p>
            <p class="f-18">
                Website: <b class="f-20"><a>
                    @if($client){{$client->website}} @endif
                    </a></b>
            </p>
            <p class="f-18">
                Address:<b class="f-20">
                    @if($client){{$client->address}} @endif
                </b>
            </p>
        </div>
        <div>
            <div class="body-content">

                <p><b>@if($client){{$client->name}} @endif
                    </b></p>
                <p style="margin-top: 20px">
                    Hope you’re doing well; Here is the <b>INVOICE</b> of the services we
                    provide you, Kindly check it and pay it with happiness, if you have
                    any questions regarding of INVOICE feel free to ask.
                </p>
                <p style="margin-top: 20px">
                    Here is our <b>PAYPAL Link Address</b>. Kindly click on the link below
                    it will take you to the Payment Procedure:
                </p>
            </div>
            <div style="position: relative;margin-bottom:10%">
                <a  href="https://www.thedesignpals.com/pay-now/" class="myimg"  >
                      <img src="{{public_path('paynow.png')}}" style="width:80%"/>
                        
                </a>
              {{--  @if ($invoice->invoice_type == 'us')
                    <a href="https://www.thedesignpals.com/pay-now/"
                        style="font-size: 35px">
                        https://www.thedesignpals.com/pay-now/
                    </a>
                @elseif($invoice->invoice_type == 'uk')
                    <a href="https://www.thedesignpals.com/gbppayment-now/"
                        style="font-size: 35px">
                        https://www.thedesignpals.com/gbppayment-now/
                    </a>
                @endif --}}
            </div>
            <div class="body-content">
                <p style="margin-top: 15px">
                    <b>Looking for a great and long-term business relation with your
                        company</b>
                </p>
                <p style="margin-top: 15px">Regards,</p>
                <p style="margin-top: 15px"><b>the Design Pals.</b></p>
            </div>

        </div>
        <div class="table">
            <table>
                <thead>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Logo (s)</th>
                    <th>Price</th>


                  {{--  @if ($invoice->invoice_type == 'us')
                        <th>Price (USD)</th>
                    @else
                        <th>Price (GBP)</th>
                    @endif --}}
                    
                </thead>
                <tbody>
                    @php
                    $symbol = "$";
                    $i = 0;
                   @endphp
                    @foreach ($client->order as $order)
                        <tr>
                            <td>
                                @if (!empty($order))
                                @php $symbol = $order->currency_symbol;
                                $i = $i+1;
                                @endphp
                                    {{$loop->iteration}}
                                @endif
                            </td>
                            <td>
                                @if (!empty($order))
                                    {{ \Carbon\Carbon::parse($order->date)->format('j-M-y') }}
                                @endif

                            </td>
                            <td>
                                @if (!empty($order))
                                    {{ $order->order_name }}
                                @endif

                            </td>
                            <td>
                                @if (!empty($order))
                                    {{ $order->currency_symbol . $order->price }}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td style="font-weight: bold">{{$i+1}}</td>
                        <td style="font-weight: bold">{{\Carbon\Carbon::now()->format('j-M-y')}}</td>
                        <td style="font-weight: bold">Total Amount</td>


                        <td style="font-weight: bold">
                            @if($invoice->invoice_type=="us")
                                {{$symbol.$invoice->price}}
                            @elseif($invoice->invoice_type=="uk")
                                {{$symbol.$invoice->price}}

                            @endif
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
        <div class="footer">
            <p class="f-20"><b>Accounts Department Team of TDP</b></p>
            <p class="f-18">
                Website :
                <a href="https://www.thedesignpals.com/">www.thedesignpals.com/</a>
            </p>
            <p class="f-18">
                Call us : <a href="tel: +1 828 414 1550"><b>+1 203-547-5476</b> </a>
               {{-- @if ($invoice->invoice_type == 'us')
                    Call us : <a href="tel: +1 828 414 1550"><b>+1 203-547-8122</b> </a>
                @else
                    Call us : <a href="tel: +44 1158 88 1233"><b>+44 1158 88 1233</b> </a>
                @endif --}}
            </p>
        </div>
    </div>
</body>

</html>

