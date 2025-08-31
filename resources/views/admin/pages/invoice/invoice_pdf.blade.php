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
         margin-left: 15% ;
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
      .f-18{
        font-size: 18px !important
      }
      .f-15{
        font-size: 15px !important
      }
      .f-20{
        font-size: 20px !important
      }
    </style>
  </head>
  <body>
    <div class="watermark">
      <h1>the design pals</h1>
    </div>
    <div class="container">
      <div class="logobar">
        <img src="{{ public_path('assets/img/Logo.png') }}"  style="margin-bottom:10px" alt="logo" height="80" width="200" />
        <h3 style="margin-top: 20px">INVOICE NO: @if(!empty($invoice)) {{ $invoice->invoice_no }} @endif</h3>
    </div>
      <div  class="heading-area">
        <p class="f-18">Bill To: <b class="f-20">@if(!empty($invoice->client_order)) {{ $invoice->client_order->name }} @endif</b></p>
        <p class="f-18">Company Name: <b class="f-20">@if(!empty($invoice->client_order)) {{ $invoice->client_order->company }} @endif</b></p>
        <p class="f-18">
          Website: <b class="f-20"> <a>@if(!empty($invoice->client_order)) {{ $invoice->client_order->website }} @endif</a></b>
        </p>
        <p class="f-18">
          Address:<b
          class="f-20"
            >@if(!empty($invoice->client_order)) {{ $invoice->client_order->address }} @endif</b
          >
        </p>
      </div>
      <div>
        <div  class="body-content">
        <p><b>@if(!empty($invoice->client_order)) {{ $invoice->client_order->name }} @endif</b></p>
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
        <div  style="text-align: center;margin-top:15px">
        @if($invoice->type == 'us')
            <a href="https://www.thedesignpals.com/pay-now/" style="font-size: 35px">
                https://www.thedesignpals.com/pay-now/
            </a>
        @elseif($invoice->type == 'uk')
            <a href="https://www.thedesignpals.com/gbppayment-now/" style="font-size: 35px;">
                https://www.thedesignpals.com/gbppayment-now/
            </a>
        @endif
        </div>
        <div class="body-content">

            <p style="margin-top: 15px">
                <b
                  >Looking for a great and long-term business relation with your
                  company.</b
                >
              </p>
              <p style="margin-top: 15px">Regards,</p>
              <p style="margin-top: 15px"><b>The Design Pals.</b></p>
        </div>

      </div>
      <div class="table">
        <table>
          <thead>
            <th>S.No</th>
            <th>Date</th>
            <th>Logo (s)</th>
            <th>Price (@if(!empty($invoice)) {{ $invoice->currency_symbol }} @endif)</th>
          </thead>
          <tbody>
            <tr>
                @php
                    use Carbon\Carbon;
                    $dateString = '2023-05-02';
                    $date = Carbon::parse($dateString);
                    $formattedDate = $date->format('j-M-y');
                @endphp
              <td>@if(!empty($invoice)) {{ $invoice->id }} @endif</td>
              <td>@if(!empty($invoice)) {{ \Carbon\Carbon::parse($invoice->date)->format('j-M-y')}} @endif</td>
              <td>@if(!empty($invoice)) {{ $invoice->order_name }} @endif</td>
              <td>@if(!empty($invoice)) {{ $invoice->currency_symbol.$invoice->price }} @endif</td>
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
          Call us : <a href="tel: +44 1158 88 1233"><b>+44 1158 88 1233</b> </a>
        </p>
      </div>
    </div>
  </body>
</html>
