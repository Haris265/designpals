@extends('admin.layout.master')
@section('content')
@section('sale', 'active')
@section('title', 'Sale')
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
            <h5 class="card-header">Update Sale Person</h5>
            <div class="card-body">
                <form action="{{ route('admin.update.sale') }}" method="post" class="row">
                    @csrf
                    <input type="hidden" name="id" @if(!empty($sale_person)) value="{{$sale_person->id}}" @endif>

                    <div class="form-group col-md-4">
                        <label class="">Name</label>
                        <input type="text" name="name" class="form-control"
                        value="{{ $sale_person->name }}">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Email</label>
                        <input type="email" name="email" class="form-control"
                        value="{{ $sale_person->email }}">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Phone No</label>
                        <input type="number" name="phone_no" class="form-control"
                        value="{{ $sale_person->phone_no }}">
                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>
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
