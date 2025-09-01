@extends('admin.layout.master')
@section('content')
@section('downloaded', 'active')
@section('title', 'Invoice')

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
                    <!--<button class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModaldate">-->
                    <!--    Find Invoices-->
                    <!--</button>-->
                </div>
                <div class="col-md-2">
                    <!--<a class="btn btn-primary" href="{{ route('admin.add.invoice') }}">Add Invoice</a>-->

                </div>

            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="invoices-table">
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
                            @php
                                $clientNameParts = explode(' ', $invoice->client->name);
                                        $firstName = isset($clientNameParts[0])
                                            ? Str::upper(substr($clientNameParts[0], 0, 1))
                                            : '';
                                        $namePrefix = $firstName . '-' . $invoice->client->id . '-' . '001';
                                        // dd($namePrefix);
                            @endphp
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                {{-- <td>
                                    @if ($invoice)
                                        {{ strtoupper(substr($invoice->client->name, 0, 1)) . $invoice->client->id . '-' . $invoice->invoice->invoice_no }}
                                    @else
                                        {{ strtoupper(substr($invoice->client->name, 0, 1)) . $invoice->client->id . '-' . str_pad(rand(1, 100), 3, '0', STR_PAD_LEFT) }}
                                    @endif
                                </td> --}}
                                <td>{{$namePrefix}}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->start_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->end_date)->format('d/m/Y') }}</td>
                                <td>
                                    {{ $invoice->status }}

                                </td>
                                {{-- <td>UnPaid</td> --}}
                                <td>{{ $invoice->invoice->invoice_type }}</td>
                                
                                <td>
    @php
        $firstOrder = $invoice->downloadedOrder->first();
        $currency = $firstOrder && $firstOrder->order ? $firstOrder->order->currency_symbol : '';
    @endphp

    {{ $currency . $invoice->total_price }}
</td>

                                

                                <td>
                                    <a class="fa fa-edit"
                                        href="{{ route('admin.edit.download.invoice', ['id' => $invoice->id]) }}">
                                    </a>
                                    {{-- <a class="fa fa-trash"
                                        href="{{ route('admin.delete.invoice', ['id' => $invoice->id]) }}">
                                    </a> --}}
                                    <a class="fa fa-print"
                                        href="{{ route('admin.all.downloaded.invoice.generate', ['id' => $invoice->id]) }}"
                                        target="_blank">
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{-- <table class="table table-hover w-100" id="invoices-table">
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
                </table> --}}


                <!-- Pagination Links -->
                <!-- Styled Pagination Links -->
                {{-- <div class="d-flex justify-content-between align-items-center mt-4">
    <div>
        Showing {{ $invoices->firstItem() }} to {{ $invoices->lastItem() }} of {{ $invoices->total() }} entries
    </div>
    <div>
        {{ $invoices->links('vendor.pagination.bootstrap-4') }}

    </div>
</div> --}}


                {{-- <table class="table table-hover w-100" id="invoices-table">
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
                </table> --}}


            </div>


            {{-- <div class="row">
        <div class="card">
            <h5 class="card-header">Client</h5>
            <div class="card-body">
                <form action="{{ route('admin.client.all.invoices') }}" method="post" class="row">
                    @csrf

                    <div class="form-group col-md-12">
                        <label class="">Client Name</label>
                        <input type="text" name="name" class="form-control">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>



                    <div class="form-group offset-md-10 col-md-12 mt-4">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}



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

@endsection
@push('script')
<script>
    $(document).ready(function() {


        $('#invoices-table').DataTable({
            "scrollX": true,
            "pageLength": 10,
            "searching": true, // Enable searching


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

{{-- <script>
    $(document).ready(function () {
        $('#invoices-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.invoice') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'client_name', name: 'client_name' },
                { data: 'invoice_no', name: 'invoice_no' },
                { data: 'date', name: 'date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'status', name: 'status' },
                { data: 'invoice_type', name: 'invoice_type' },
                { data: 'price', name: 'price' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            scrollX: true,
        });
    });
</script> --}}

<script>
    $(document).ready(function() {
        // $('#invoices-table').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: '{{ route('admin.downloaded.invoice') }}',
        //     columns: [
        //         { data: 'id', name: 'invoice.id' },
        //         { data: 'client_name', name: 'client.name' },
        //         { data: 'invoice_no', name: 'invoice.invoice_no' },
        //         { data: 'date', name: 'invoice.date' },
        //         { data: 'end_date', name: 'invoice.end_date' },
        //         { data: 'status', name: 'invoice.status' },
        //         { data: 'invoice_type', name: 'invoice.invoice_type' },
        //         { data: 'price', name: 'invoice.price' },
        //         { data: 'action', name: 'action', orderable: false, searchable: false },
        //     ],
        //     scrollX: true,
        // });
    });
</script>
@endpush
