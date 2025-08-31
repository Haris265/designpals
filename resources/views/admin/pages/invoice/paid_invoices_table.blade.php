@extends('admin.layout.master')
@section('content')
@section('paid', 'active')
@section('title', 'Paid Invoices')

<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header row">
                <div class="col-md-3">
                    Invoice
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-4">
                   {{-- <button class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModaldate">
                        Find Invoices
                    </button> --}}
                </div>
                <div class="col-md-2">
                    
                    {{-- <a class="btn btn-primary" href="{{ route('admin.add.invoice') }}">Add Invoice</a> --}}

                </div>

            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>

                            <th>Invoice No</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Invoice Type</th>
                            <th>Price</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->date)->format('d/m/Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->end_date)->format('d/m/Y')}}</td>
                                <td>{{ $invoice->status }}</td>
                                <td>{{ $invoice->invoice_type }}</td>
                                <td>{{ $invoice->symbol.$invoice->price}}</td>
                                <td>
                                    <a class="fa fa-edit"
                                        href="{{ route('admin.edit.invoice', ['id' => $invoice->id]) }}">
                                    </a>
                                     <a class="fa fa-trash"
                                        href="{{ route('admin.delete.invoice', ['id' => $invoice->id]) }}">
                                    </a>
                                    <a class="fa fa-print"
                                    href="{{ route('admin.invoice.generate', ['id' => $invoice->id]) }}" target="_blank">
                                </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            
            
    



           {{-- <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>
                                    <a class="fa fa-print"
                                        href="{{ route('admin.client.all.invoices', ['id' => $client->id]) }}" target="_blank">
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div> --}}

        </div>
    </div>
</div>
</div>
<!-- Modal Date-->
<div class="modal fade" id="exampleModaldate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Find Invoices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.all.invoices')}}" method="post" class="row">
                    @csrf
                    {{-- <input type="text" name="tour_id" class="blotter"> --}}
                    {{-- <input type="text" id="abc" name='plant_id'> --}}
                    <div class="form-group col-md-12">
                        <label>Select Client Email</label>
                        <select class="form-control" name="client_email">
                            <option>Select Client Email</option>
                            @foreach($clients as $client)
                            <option value="{{$client->email}}">
                                {{$client->email}}
                            </option>
                            @endforeach
                        </select>
                    </div>

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
