@extends('admin.layout.master')
@section('content')
@section('invoice', 'active')
@section('title', 'Invoice')

<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header row">
                <div class="col-md-3">
                    Client All Invoices
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-2">

                </div>

            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Invoice Type</th>
                            {{-- <th>Action</th> --}}

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if(!empty($all_invoices->invoices))
                        @foreach ($all_invoices->invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->date)->format('d/m/Y')}}</td>
                                <td>{{ $invoice->price.$invoice->currency_symbol}}</td>
                                <td>{{ $invoice->status }}</td>
                                <td>{{ $invoice->invoice_type }}</td>

                                {{-- <td>
                                    <a class="fa fa-edit"
                                        href="{{ route('admin.edit.invoice', ['id' => $invoice->id]) }}">
                                    </a>
                                     <a class="fa fa-trash"
                                        href="{{ route('admin.delete.invoice', ['id' => $invoice->id]) }}">
                                    </a>
                                </td> --}}
                            </tr>
                        @endforeach
                                                    @endif


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


        $('#table').DataTable({
            "scrollX": true

        });

        $(".comment").on("click", function() {
            //var dataId = $(this).attr("data-id");
            var favorite = [];
            $.each($("input[name='id[]']:checked"), function() {
                favorite.push($(this).val());
            });
            //alert("My Plants ID are: " + favorite.join(", "));
            // $('.id[]').attr(favorite);
            console.log("favorite.toString()", favorite.toString())
            let ab = document.getElementById("abc");
            ab.value = favorite.toString()
            //$(".blotter").val(dataId);
        });
    });
</script>
@endpush
