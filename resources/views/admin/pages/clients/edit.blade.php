@extends('admin.layout.master')
@section('content')
@section('client', 'active')
@section('title', 'Client Details')
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
            <h5 class="card-header">Add Client Details</h5>
            <div class="card-body">
                <form action="{{ route('admin.update.client') }}" method="post" class="row">
                    @csrf
                    <input type="hidden" name="id" @if(!empty($client)) value="{{$client->id}}" @endif>


                    <div class="form-group col-md-6">
                        <label class="">Sale Persons</label>
                        <select class="form-control" name="sale_person">
                            <option>Select Sale Person</option>
                            @foreach($sale_persons as $sale_person)
                            <option value="{{$sale_person->id}}"
                                @if(!empty($client) && $client->sale_person_id == $sale_person->id) selected @endif>
                                {{$sale_person->name}}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('sale_person') }}</span>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="">Account</label>
                        <select class="form-control" name="account">
                            <option>Select Gmail Account</option>
                            @foreach($accounts as $account)
                            <option value="{{$account->id}}"
                                @if(!empty($client) && $client->account_id == $account->id) selected @endif>
                                {{$account->account_email}}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('account') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$client->name}}">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$client->email}}">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Phone No</label>
                        <input type="number" name="phone_no" class="form-control" value="{{$client->phone_no}}">
                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Address</label>
                        <input type="text" name="address" class="form-control" value="{{$client->address}}">
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Company</label>
                        <input type="text" name="company" class="form-control" value="{{$client->company}}">
                        <span class="text-danger">{{ $errors->first('company') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Website</label>
                        <input type="text" name="website" class="form-control" value="{{$client->website}}">
                        <span class="text-danger">{{ $errors->first('website') }}</span>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="">Location</label>
                        <select class="form-control" name="location">
                            <option>Select Location</option>
                            <option value="uk" @if(!empty($client) && $client->location == 'uk') selected @endif>UK</option>
                            <option value="us" @if(!empty($client) && $client->location == 'us') selected @endif>US</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('location') }}</span>
                    </div>

                    <div class="form-group offset-md-10 col-md-2 col-sm-12">
                        <button class="btn btn-primary" type="submit">Update</button>
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
