@extends('admin.layout.master')
@section('content')
@section('filter', 'active')
@section('title', 'Filter')
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
            <h5 class="card-header">Order Filter</h5>
            <div class="card-body">
                <form action="{{ route('admin.order.filter.process') }}" method="post" class="row">
                    @csrf

                    {{-- <div class="form-group col-md-4">
                        <label class="">Client</label>
                        <select class="form-control" name="client">
                            <option>Select Client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('client') }}</span>
                    </div> --}}

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
                                {{-- <th>Designer Name</th> --}}
                                <th>Client Name</th>
                                {{-- <th>Date</th> --}}

                                {{-- <th>Order Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Invoice Type</th> --}}

                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if (!empty($orders))
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        {{-- <td>{{ $order->designer_order->name }}</td> --}}
                                        <td>{{ $order->client_order->name }}</td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y')}}</td> --}}

                                        {{-- <td>{{ $order->order_name }}</td>
                                        <td>{{ $order->price.$order->currency_symbol}}</td>

                                        @if($order->status == 'Order Completed')
                                            <td>Order Completed</td>
                                        @else
                                            <td>Order Pending</td>
                                        @endif

                                        <td>{{ $order->type }}</td> --}}
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No Data Found</td>
                                </tr>
                            @endif

                            <tr>
                                @if (!empty($total))
                                    <td>Total : Rs {{ $total }}</td>
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
