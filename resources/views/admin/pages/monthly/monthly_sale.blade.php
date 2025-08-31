@extends('admin.layout.master')
@section('content')
@section('monthly', 'active')
@section('title', 'Monthly Sale Amount')
<div class="container-xxl flex-grow-1 container-p-y">
    <style>
        .form-control {
            margin-bottom: 2rem !important;
        }

        .form-check {
            margin-bottom: 2rem !important;
        }
    </style>
    <div class="row">
        <div class="card">
            <h5 class="card-header">Monthly Sale Amount</h5>
            <div class="card-body">
                <form action="{{ route('admin.monthly.sale.process') }}" method="post" class="row">
                    @csrf
                   
                   <div class="form-group col-md-6">
                        <label class="">From</label>
                        <input type="date" name="from" class="form-control">
                        <span class="text-danger">{{ $errors->first('from') }}</span>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="">To</label>
                        <input type="date" name="till" class="form-control">
                        <span class="text-danger">{{ $errors->first('till') }}</span>
                    </div>



                    <div class="form-group offset-md-10 col-md-2 col-sm-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover w-100" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order Name</th>
                                <th>Date</th>
                                <th>Price</th>

                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @if(!empty($orders))
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y')}}</td>
                                <td>{{ $order->currency_symbol.$order->price }}</td>
                            </tr>
                            @endforeach
                            @endif
                            
                            
                        

                        <tr>
                            
                            @if(!empty($order_counts))
                                <td>Total Logos : {{$order_counts}}</td>
                            @endif
                            
                            @if(!empty($total_us))
                                <td>Total US : {{$total_us}}$</td>
                            @endif
                            @if(!empty($total_euro))

                                <td>Total EURO : {{$total_euro}}€</td>
                            @endif
                            
                            @if(!empty($total_pound))


                                <td>Total POUND : {{$total_pound}}£</td>
                            @endif


                            
                        </tr>

                        


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        var today = new Date().toISOString().split('T')[0];
        $("#minDate").attr('min', today);
    });

    $(document).ready(function() {
        $('.del-btn').hide();
    });
    $(document).on('click', '.add-btn', function() {
        if ($('.productdiv').length > 9) {
            alert('Limit Reach Only 10 is Allowed')
        } else {
            var clone = $('.productdiv').last().clone();
            $(clone).find("input").val("").end();
            $(clone).find("text").val("").end();
            $(clone).find("textarea").val("").end();
            var mainDiv = $('#productdiv div.row');
            var lengthDiv = parseInt(mainDiv.length) + parseInt(1);
            $(clone).find("label span").text(lengthDiv);
            $('.clonediv').append(clone);
            $('.del-btn').show();
        }
    });
    $(document).on('click', '.del-btn', function() {
        if ($('.productdiv').length > 1) {
            $(this).parents('.productdiv').remove();
            if ($('.productdiv').length == 1) {
                $('.del-btn').hide();
            }
        } else {
            $(this).hide();
        }

    });
</script>
@endpush
