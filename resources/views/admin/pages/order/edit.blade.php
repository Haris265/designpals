@extends('admin.layout.master')
@section('content')
@section('order', 'active')
@section('title', 'Order')
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
            <h5 class="card-header">Update Order</h5>
            <div class="card-body">
                <form action="{{ route('admin.update.order') }}" method="post" class="row">
                    @csrf
                    <input type="hidden" name="id" @if(!empty($order)) value="{{$order->id}}" @endif>


                    <div class="form-group col-md-4">
                        <label class="">Order Name</label>
                        <input type="text" name="order_name" class="form-control"
                        value="{{$order->order_name}}">
                        <span class="text-danger">{{ $errors->first('order_name') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Date</label>
                        <input type="date" name="date" class="form-control"
                        value="{{$order->date}}">
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Price</label>
                        <input type="number" name="price" class="form-control"
                        value="{{$order->price}}">
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Cost</label>
                        <input type="number" name="cost" class="form-control"
                        value="{{$order->cost}}">
                        <span class="text-danger">{{ $errors->first('cost') }}</span>
                    </div>

                     <div class="form-group col-md-4">
                        <label class="">Currency</label>
                        <select class="form-control" name="currency_symbol">
                            <option>Select Currency</option>
                            <option value="$" @if(!empty($order) && $order->currency_symbol == '$') selected @endif>$</option>
                            <option value="€" @if(!empty($order) && $order->currency_symbol == '€') selected @endif>€</option>
                            <option value="£" @if(!empty($order) && $order->currency_symbol == '£') selected @endif>£</option>

                        </select>
                        <span class="text-danger">{{ $errors->first('currency_symbol') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Client</label>
                        <select class="form-control" name="client_id">
                            <option>Select Client</option>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}"
                                @if(!empty($order) && $order->client_id == $client->id) selected @endif>
                                {{$client->name}}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('client_id') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Saler</label>
                        <select class="form-control" name="saler_id">
                            <option>Select Saler</option>
                            @foreach($persons as $person)
                            <option value="{{$person->id}}"
                                @if(!empty($order) && $order->saler_id == $person->id) selected @endif>
                                {{$person->name}}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('saler_id') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Assign To Designer</label>
                        <select class="form-control" name="designer_id">
                            <option>Select Client</option>
                            @foreach($designers as $designer)
                            <option value="{{$designer->id}}"
                                @if(!empty($order) && $order->designer_id == $designer->id) selected @endif>
                                {{$designer->name}}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('designer_id') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Invoice Type</label>
                        <select class="form-control" name="type">
                            <option>Select Invoice Type</option>
                            <option value="uk" @if(!empty($order) && $order->type == 'uk') selected @endif>UK</option>
                            <option value="us" @if(!empty($order) && $order->type == 'us') selected @endif>US</option>

                        </select>
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Status</label>
                        <select class="form-control" name="status">
                            <option>Change Status</option>
                            <option value="Order Pending" @if(!empty($order) && $order->status == 'Order Pending') selected @endif>Order Pending</option>
                            <option value="Order Completed" @if(!empty($order) && $order->status == 'Order Completed') selected @endif>Order Completed</option>

                        </select>
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    </div>

                    <div class="form-group offset-md-10 col-md-2 col-sm-12">
                        <button class="btn btn-primary" type="submit">update</button>
                    </div>
                </form>
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
