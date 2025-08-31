@extends('admin.layout.master')
@section('content')
@section('invoice', 'active')
@section('title', 'Invoice')
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
            <h5 class="card-header">Update Invoice</h5>
            <div class="card-body">
                <form action="{{ route('admin.update.download.invoice') }}" method="post" class="row">
                    @csrf
                    <input type="hidden" name="id" @if(!empty($invoice)) value="{{$invoice->id}}" @endif>
                    <input type="hidden" name="invoice_char" id="invoice_char" @if(!empty($invoice))  value="{{$invoice->invoice_char}}" @endif>
                    <input type="hidden" name="invoice_numb" id="invoice_numb" @if(!empty($invoice))  value="{{$invoice->invoice_numb}}" @endif>

                    {{-- <div class="form-group col-md-4">
                        <label class="">Client</label>
                        <select class="form-control" id="client_id" name="client_id">
                            <option>Select Client</option>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}"
                                @if(!empty($invoice) && $invoice->client_id == $client->id) selected @endif>
                                {{$client->name}}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('client_id') }}</span>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="">Invoice No</label>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control"
                       @if(!empty($invoice)) value="{{$invoice->invoice_no}}" @endif>
                        <span class="text-danger">{{ $errors->first('invoice_no') }}</span>
                    </div> --}}

{{-- 

                    <div class="form-group col-md-3">
                        <label class="">Start Date</label>
                        <input type="date" name="start_date" class="form-control"
                        value="{{$invoice->date}}">
                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="">End Date</label>
                        <input type="date" name="end_date" value="{{$invoice->end_date}}" class="form-control">
                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="">Invoice Type</label>
                        <select class="form-control" name="invoice_type">
                            <option>Select Invoice Type</option>
                            <option value="uk" @if(!empty($invoice) && $invoice->invoice_type == 'uk') selected @endif>UK</option>
                            <option value="us" @if(!empty($invoice) && $invoice->invoice_type == 'us') selected @endif>US</option>

                        </select>
                        <span class="text-danger">{{ $errors->first('invoice_type') }}</span>
                    </div> --}}


                    <div class="form-group col-md-12">
                        <label class="">Payment Status</label>
                        <select class="form-control" name="status">
                            <option>Select Payment Status</option>
                            <option value="Paid" @if(!empty($invoice) && $invoice->status == 'Paid') selected @endif>Paid</option>
                            <option value="UnPaid" @if(!empty($invoice) && $invoice->status == 'UnPaid') selected @endif>UnPaid</option>


                        </select>
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    </div>
                    
                    {{-- <div class="form-group col-md-3">
                        <label class="">Excluding</label>
                        <input type="date" name="exludedDate" class="form-control" id="date-picker"
                        value="{{$invoice->exludedDate}}">
                        <span class="text-danger">{{ $errors->first('exludedDate') }}</span>
                    </div> --}}

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
    // $("#client_id").on('change', function(){
    //     var client_id = $("#client_id").val();
    //     console.log(client_id);
    //     // var userURL = $(this).data('url');
    //     var route ='{{route("admin.invoice.number",":id")}}';
    //        route = route.replace(':id', client_id);
    //         $.ajax({
    //             url: route,
    //             type: 'GET',
    //             dataType: 'json',
    //             success: function(data) {
    //                 // $('#userShowModal').modal('show');
    //                 // $('#user-id').text(data.id);
    //                 // $('#user-name').text(data.name);
    //                 // $('#user-email').text(data.email);
    //                 console.log();
    //                 $("#invoice_char").val(data.invoice_char);
    //                 $("#invoice_no").val(data.invoice_no);
    //                 $("#invoice_numb").val(data.invoice_numb);
    //             }
    //         });
    // });
</script>
@endpush
