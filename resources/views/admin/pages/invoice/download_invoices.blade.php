@extends('admin.layout.master')
@section('content')
@section('download', 'active')
@section('title', 'Invoices')
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
            <h5 class="card-header row">
                <button id="downloadAll" class="btn btn-primary">Download All Invoices</button>

                <div class="col-md-3 mt-2">
                    Download Invoices

                </div>
                <div class="col-md-3">
                </div>

            </h5>

            <div class="card-body">
                <form action="{{ route('admin.download.invoice.process') }}" method="POST" class="row">
                    @csrf

                    <div class="form-group col-md-6">
                        <label class="">Start Date</label>
                        <input type="date" name="from" class="form-control">
                        <span class="text-danger">{{ $errors->first('from') }}</span>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="">End Date</label>
                        <input type="date" name="till" class="form-control">
                        <span class="text-danger">{{ $errors->first('till') }}</span>
                    </div>



                    <div class="form-group offset-md-10 col-md-2 col-sm-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
                <br>

                
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover w-100" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Exclude Dates</th>
                                <th>Invoice No</th>
                                <th>Client Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Invoice Type</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if (!empty($clients))
                                @foreach ($clients as $client)
                                    @php
                                        // $invoice = \App\Models\DownloadInvoice::where('client_id', $client->id)->latest()->first();
                                        $from = \Carbon\Carbon::parse($request->get('from'))->toDateString();
                                        $till = \Carbon\Carbon::parse($request->get('till'))->toDateString();
                                        $invoice = \App\Models\DownloadInvoice::where('client_id', $client->id)
                                            ->whereBetween('date', [$from, $till])
                                            ->latest()
                                            ->first();
                                        // dd($invoice)
                                        $clientNameParts = explode(' ', $client->name);
                                        $firstName = isset($clientNameParts[0])
                                            ? Str::upper(substr($clientNameParts[0], 0, 1))
                                            : '';
                                        $namePrefix = $firstName . '-' . $client->id . '-' . '001';
                                        // dd($namePrefix);
                                    @endphp
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary open-exclude-modal"
                                                data-bs-toggle="modal" data-bs-target="#excludeDatesModal"
                                                data-invoice-id="{{ $client->id }}">Exclude
                                            </button>
                                        </td>
                                        <td>
                                            {{-- @if ($invoice)
                                                {{ $invoice->invoice_no }}
                                            @endif --}}
                                            {{$namePrefix}}
                                        </td>




                                        <td>{{ $client->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($request->from)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($request->till)->format('d/m/Y') }}</td>
                                        <td>{{ $client->order[0]->type }}</td>
                                        <td>{{ 'Order Pending' }}</td>

                                        <td>{{ $client->order[0]->currency_symbol . $client->total_order_price }}</td>
                                        <td>
                                            <a class="fa fa-edit"
                                                href="{{ route('admin.edit.download.invoice', ['id' => $client->id, 'from' => $request->from, 'till' => $request->till]) }}"></a>

                                            <a class="fa fa-download"
                                                href="{{ route('admin.all.invoice.generate', ['id' => $client->id, 'from' => $request->from, 'till' => $request->till]) }}" download></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif







                            {{-- <tr>

                                @if (!empty($order_counts))
                                    <td>Total Logos : {{ $order_counts }}</td>
                                @endif

                                @if (!empty($total_us))
                                    <td>Total US : {{ $total_us }}$</td>
                                @endif
                                @if (!empty($total_euro))
                                    <td>Total EURO : {{ $total_euro }}€</td>
                                @endif

                                @if (!empty($total_pound))
                                    <td>Total POUND : {{ $total_pound }}£</td>
                                @endif



                            </tr> --}}




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="excludeDatesModal" tabindex="-1" aria-labelledby="excludeDatesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.exclude.process') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="excludeDatesModalLabel">Exclude Dates for Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Hidden input for invoice ID -->
                    <input type="text" name="invoice_id" id="modal-invoice-id">
                    {{-- <input type="text" name="client_id" id="" value="{{$client->id}}"> --}}


                    <div class="exclude-dates mb-3">
                        <label>Exclude Dates:</label>
                        <div class="date-input-group d-flex align-items-center mb-2">
                            <input type="date" name="exclude_dates[]" class="exclude-date form-control" required>
                            <button type="button" class="add-date btn btn-sm btn-secondary ms-2">+</button>
                        </div>
                        <!-- More exclude dates can be dynamically added here -->
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Download Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        // alert()
        // var today = new Date().toISOString().split('T')[0];
        // $("#minDate").attr('min', today);

        $('#table').DataTable({
            "scrollX": true,
            "pageLength": 10,
            "searching": true,

        });
    });

    // $(document).ready(function() {
    //     $('.del-btn').hide();
    // });
    // $(document).on('click', '.add-btn', function() {
    //     if ($('.productdiv').length > 9) {
    //         alert('Limit Reach Only 10 is Allowed')
    //     } else {
    //         var clone = $('.productdiv').last().clone();
    //         $(clone).find("input").val("").end();
    //         $(clone).find("text").val("").end();
    //         $(clone).find("textarea").val("").end();
    //         var mainDiv = $('#productdiv div.row');
    //         var lengthDiv = parseInt(mainDiv.length) + parseInt(1);
    //         $(clone).find("label span").text(lengthDiv);
    //         $('.clonediv').append(clone);
    //         $('.del-btn').show();
    //     }
    // });
    // $(document).on('click', '.del-btn', function() {
    //     if ($('.productdiv').length > 1) {
    //         $(this).parents('.productdiv').remove();
    //         if ($('.productdiv').length == 1) {
    //             $('.del-btn').hide();
    //         }
    //     } else {
    //         $(this).hide();
    //     }

    // });
</script>

<script>
    $(document).ready(function() {
        // Listen for modal open button click
        $('.open-exclude-modal').on('click', function() {
            var invoiceId = $(this).data('invoice-id'); // Get the invoice ID from button
            $('#modal-invoice-id').val(invoiceId); // Set the invoice ID in modal's hidden input
        });

        // Dynamically add more exclude date fields
        $(document).on('click', '.add-date', function() {
            var dateInput = `<div class="date-input-group d-flex align-items-center mb-2">
                            <input type="date" name="exclude_dates[]" class="exclude-date form-control" required>
                            <button type="button" class="remove-date btn btn-sm btn-danger ms-2">-</button>
                         </div>`;
            $(this).closest('.exclude-dates').append(dateInput);
        });

        // Remove date input field
        $(document).on('click', '.remove-date', function() {
            $(this).closest('.date-input-group').remove();
        });
    });
</script>

<script>
    $(document).ready(function() {
    $("#downloadAll").click(function() {
        let invoiceNos = [];
        $("table tbody tr").each(function() {
            let invoiceNo = $(this).find("td:eq(2)").text().trim(); // Invoice No column
            if (invoiceNo) {
                invoiceNos.push(invoiceNo);
            }
        });

        if (invoiceNos.length > 0) {
            $.ajax({
                url: "{{route('admin.all_pdfs_invoices_download')}}",
                type: "POST",
                data: { invoices: invoiceNos },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    // window.location.href = response.download_url;
                    // alert()
                     // Create a hidden <a> tag and trigger download
                        let link = document.createElement("a");
                    link.href = response.download_url;
                    link.download = "invoices.zip"; // Suggested filename
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Error downloading invoices.");
                }
            });
        } else {
            alert("No invoices found.");
        }
    });
});

</script>
@endpush
