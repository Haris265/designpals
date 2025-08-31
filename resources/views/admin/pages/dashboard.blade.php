@extends('admin.layout.master')
@section('content')
@section('dashboard', 'active')
@section('title', 'Dashboard')
<style>
    .c-dashboardInfo {
        margin-bottom: 15px;
    }

    .c-dashboardInfo .wrap {
        background: #ffffff;
        box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
        border-radius: 7px;
        text-align: center;
        position: relative;
        overflow: hidden;
        padding: 40px 25px 20px;
        height: 100%;
    }

    .c-dashboardInfo__title,
    .c-dashboardInfo__subInfo {
        color: #6c6c6c;
        font-size: 1.18em;
    }

    .c-dashboardInfo span {
        display: block;
    }

    .c-dashboardInfo__count {
        font-weight: 600;
        font-size: 2.5em;
        line-height: 64px;
        color: #323c43;
    }

    .c-dashboardInfo .wrap:after {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10px;
        content: "";
    }

    .c-dashboardInfo:nth-child(1) .wrap:after {
        background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
    }

    .c-dashboardInfo:nth-child(2) .wrap:after {
        background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
    }

    .c-dashboardInfo:nth-child(3) .wrap:after {
        background: linear-gradient(69.83deg, #0084f4 0%, #00c48c 100%);
    }

    .c-dashboardInfo:nth-child(4) .wrap:after {
        background: linear-gradient(81.67deg, #ff647c 0%, #1f5dc5 100%);
    }

    .c-dashboardInfo__title svg {
        color: #d7d7d7;
        margin-left: 5px;
    }

    .MuiSvgIcon-root-19 {
        fill: currentColor;
        width: 1em;
        height: 1em;
        display: inline-block;
        font-size: 24px;
        transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        user-select: none;
        flex-shrink: 0;
    }
</style>

@if(!empty($us_total))
@foreach($us_total as $us)
@endforeach
@endif

@if(!empty($euro_total))

@foreach($euro_total as $euro)
@endforeach
@endif


@if(!empty($pound_total))

@foreach($pound_total as $pound)
@endforeach
@endif

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col-md-4">
            <button class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModaldate">
                Find Sale
            </button>
            <br>
            @if(!empty($us)) US Total: {{$us->totalSaleUS}}$ @endif
          <br>
             @if(!empty($euro)) Euro Total: {{$euro->totalSaleEuro}}€ @endif
            <br>
             @if(!empty($pound)) Pound Total: {{$pound->totalSalePound}}£ @endif
        </div>
        <div id="root">
            <div class="container pt-5">

                <div class="row align-items-stretch">
                    <div class="c-dashboardInfo col-lg-4 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Client Details
                                <svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24"
                                    aria-hidden="true" role="presentation">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                    </path>
                                </svg>
                            </h4>
                            <span class="hind-font caption-12 c-dashboardInfo__count">{{ $client_counts }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-4 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Sale Persons
                                <svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24"
                                    aria-hidden="true" role="presentation">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                    </path>
                                </svg></h4><span class="hind-font caption-12 c-dashboardInfo__count">{{ $sale_counts }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-4 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Designer
                                <svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24"
                                    aria-hidden="true" role="presentation">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                    </path>
                                </svg></h4><span class="hind-font caption-12 c-dashboardInfo__count">{{ $designer_counts }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-4 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Orders
                                <svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24"
                                    aria-hidden="true" role="presentation">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                    </path>
                                </svg></h4><span class="hind-font caption-12 c-dashboardInfo__count">{{ $order_counts }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-4 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Invoices
                                <svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24"
                                    aria-hidden="true" role="presentation">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                    </path>
                                </svg></h4><span class="hind-font caption-12 c-dashboardInfo__count">{{ $invoice_counts }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="root">
        <div class="container pt-5">
            <div class="row align-items-stretch">
                <div>
                    <canvas id="myChart"></canvas>
                  </div>

            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal Date-->
<div class="modal fade" id="exampleModaldate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Find Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.find.sale')}}" method="post" class="row">
                    @csrf
                    {{-- <input type="text" name="tour_id" class="blotter"> --}}
                    {{-- <input type="text" id="abc" name='plant_id'> --}}


                    <div class="form-group col-md-12">
                        <label>From</label>
                        <input type="date" name="from" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label>To</label>
                        <input type="date" name="till" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection
@push('script')
{{-- @dd($chart) --}}
<script>
    const ctx = document.getElementById('myChart');
    const months = @json($chart->map(fn($item) => \Carbon\Carbon::parse("{$item->year}-{$item->month}-1")->format("M, Y")));
    const values = @json($chart->map(fn($item) => $item->totalSale ));
    console.log("months ==> ", months, @json($chart))
    console.log("years ==> ", values)
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: '# of sales',
          data: values,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

@endpush
