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


        .suggestions {
            position: absolute;
            background: #fff;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            /* width: 100%; */
            z-index: 1000;
        }

        .suggestions div {
            padding: 8px;
            cursor: pointer;
        }

        .suggestions div:hover {
            background: #f0f0f0;
        }
    </style>
    <div class="row">
        <div class="card">
            <h5 class="card-header">Add Order</h5>
            <div class="card-body">
                <form action="{{ route('admin.store.order') }}" method="post" class="row">
                    @csrf

                    <div class="form-group col-md-4">
                        <label class="">Order Name</label>
                        <input type="text" name="order_name" class="form-control">
                        <span class="text-danger">{{ $errors->first('order_name') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Date</label>
                        <input type="date" name="date" class="form-control">
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Price</label>
                        <input type="number" name="price" class="form-control">
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Cost</label>
                        <input type="number" name="cost" class="form-control">
                        <span class="text-danger">{{ $errors->first('cost') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Currency</label>
                        <select class="form-control" name="currency_symbol">
                            <option>Select Currency</option>
                            <option value="$">$</option>
                            <option value="€">€</option>
                            <option value="£">£</option>

                        </select>
                        <span class="text-danger">{{ $errors->first('currency_symbol') }}</span>
                    </div>

                    {{-- <div class="form-group col-md-4">
                        <label class="">Client</label>
                        <select class="form-control" name="client_id" id="mySelectBox">
                            <option>Select Client</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">
                                    {{$client->name}}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('client_id') }}</span>
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label class="">Client</label>
                        <input type="text" id="client_search" class="form-control" placeholder="Search Client">
                        <input type="hidden" name="client_id" id="client_id">
                        <div id="client_suggestions" class="suggestions"></div>
                        <span class="text-danger">{{ $errors->first('client_id') }}</span>
                    </div>




                    <div class="form-group col-md-4">
                        <label class="">Saler</label>
                        <select class="form-control" name="saler_id">
                            <option>Select Saler</option>
                            @foreach ($persons as $person)
                                <option value="{{ $person->id }}">
                                    {{ $person->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('saler_id') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Assign To Designer</label>
                        <select class="form-control" name="designer_id">
                            <option>Select Designer</option>
                            @foreach ($designers as $designer)
                                <option value="{{ $designer->id }}">
                                    {{ $designer->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('designer_id') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Invoice Type</label>
                        <select class="form-control" name="type">
                            <option>Select Invoice Type</option>
                            <option value="uk">UK</option>
                            <option value="us">US</option>

                        </select>
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Status</label>
                        <select class="form-control" name="status">
                            <option>Change Status</option>
                            <option value="Order Pending">Order Pending</option>
                            <option value="Order Completed">Order Completed</option>

                        </select>
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="">Invoice No</label>
                        <input type="text" id="invoiceInput" name="invoice_no" class="form-control" readonly>
                        <span class="text-danger">{{ $errors->first('invoice_no') }}</span>
                    </div>

                    <div class="form-group offset-md-10 col-md-2 col-sm-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
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

    $(document).ready(function() {
        // Attach a change event handler to the select box
        $('#mySelectBox').on('change', function() {


            // Get the selected option's value (ID)
            var selectedValue = $(this).val();
            $('.abc').val(selectedValue);

            // Do something with the selected value
            console.log('Selected ID: ' + selectedValue);


        });

    });
</script>

{{-- <script>
    $(document).ready(function() {
        $('#client_search').on('keyup', function() {
            let query = $(this).val();

            if (query.length > 1) { // Start searching after 2 characters
                $.ajax({
                    url: "{{ route('admin.clients.search') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        let suggestions = '';
                        if (data.length > 0) {
                            $.each(data, function(index, client) {
                                suggestions +=
                                    `<div class="suggestion-item" data-id="${client.id}" data-name="${client.name}">${client.name}</div>`;
                            });
                        } 
                        else {
                            suggestions = '<div>No results found</div>';
                        }
                        $('#client_suggestions').html(suggestions).show();
                    }
                });
            } else {
                $('#client_suggestions').hide();
            }
        });

       

       



        // Handle client selection
        $(document).on('click', '.suggestion-item', function() {
            let clientName = $(this).data('name');
            let clientId = $(this).data('id');

            $('#client_search').val(clientName);
            $('#client_id').val(clientId);
            $('#client_suggestions').hide();
        });

        // Hide suggestions when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('.form-group').length) {
                $('#client_suggestions').hide();
            }
        });
    });
</script> --}}

{{--<script>
$(document).ready(function() {
    $("#client_search").on("keyup", function() {
        let query = $(this).val();
        if (query.length > 1) {
            $.ajax({
                url: "{{ route('admin.clients.search') }}",
                method: "GET",
                data: { query: query },
                success: function(data) {
                    let suggestions = "";
                    data.forEach(client => {
                        suggestions += `<li class="list-group-item client-option" 
                                        data-id="${client.id}" 
                                        data-invoice="${client.latest_invoice}">
                                        ${client.name}</li>`;
                    });
                    $("#client_suggestions").html(suggestions).show();
                }
            });
        } else {
            $("#client_suggestions").hide();
        }
    });

    // Select client and set latest invoice
    $(document).on("click", ".client-option", function() {
        let clientName = $(this).text();
        let clientId = $(this).data("id");
        let latestInvoice = $(this).data("invoice");

        $("#client_search").val(clientName);
        $("#client_id").val(clientId);
        $("#invoiceInput").val(latestInvoice);
        $("#client_suggestions").hide();
    });

    $(document).on("click", function(event) {
        if (!$(event.target).closest("#client_search, #client_suggestions").length) {
            $("#client_suggestions").hide();
        }
    });
});

</script> --}}

<script>
$(document).ready(function() {
    // Client search
    $("#client_search").on("keyup", function() {
        let query = $(this).val();
        if (query.length > 1) {
            $.ajax({
                url: "{{ route('admin.clients.search') }}",
                method: "GET",
                data: { query: query },
                success: function(data) {
                    let suggestions = "";
                    data.forEach(client => {
                        suggestions += `<li class="list-group-item client-option" 
                                        data-id="${client.id}" 
                                        data-name="${client.name}">
                                        ${client.name}</li>`;
                    });
                    $("#client_suggestions").html(suggestions).show();
                }
            });
        } else {
            $("#client_suggestions").hide();
        }
    });

    // Select client
    $(document).on("click", ".client-option", function() {
        let clientName = $(this).data("name");
        let clientId = $(this).data("id");

        $("#client_search").val(clientName);
        $("#client_id").val(clientId);
        $("#client_suggestions").hide();

        generateInvoiceNo(clientName, clientId);
    });

    // Date change par invoice no dobara generate ho
    $(document).on("change", "input[name='date']", function() {
        let clientName = $("#client_search").val();
        let clientId = $("#client_id").val();
        if(clientName && clientId) {
            generateInvoiceNo(clientName, clientId);
        }
    });

    // Function to generate invoice number
    function generateInvoiceNo(clientName, clientId) {
        let dateVal = $("input[name='date']").val();
        if(!dateVal) {
            $("#invoiceInput").val(""); 
            return;
        }

        let date = new Date(dateVal);
        let month = date.getMonth() + 1; // Jan = 0
        let monthFormatted = (month - 1).toString().padStart(3, '0'); // ek number kam, padded 3 digit

        // Client initials
        let parts = clientName.trim().split(" ");
        let firstInitial = parts[0] ? parts[0][0].toUpperCase() : "X";
        let lastInitial = parts.length > 1 ? parts[parts.length-1][0].toUpperCase() : "X";

        // Client ID padded
        let clientCode = clientId.toString().padStart(3, "0");

        let invoiceNo = `${firstInitial}${lastInitial}-${clientCode}-${monthFormatted}`;
        $("#invoiceInput").val(invoiceNo);
    }

    // Hide suggestions when clicking outside
    $(document).on("click", function(event) {
        if (!$(event.target).closest("#client_search, #client_suggestions").length) {
            $("#client_suggestions").hide();
        }
    });
});
</script>



@endpush
