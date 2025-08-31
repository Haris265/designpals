@extends('admin.layout.master')
@section('content')
@section('order', 'active')
@section('title', 'Orders')

<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header row">
                <div class="col-md-3"> 
                    Orders
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-4">




                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary" href="{{ route('admin.add.order') }}">Add Order</a>


                </div>
                
                <div class="col-md-2">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <label class="ImpStaff btn btn-sm  btn-primary">Import
                          <input type="file" class=" d-none" onchange="form.submit()" name="file">
                        </label>
                      </form>
                </div>

            </h5>
            {{-- <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Designer Name</th>
                            <th>Client Name</th>
                            <th>Order Name</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Invoice Type</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->designer_order->name }}</td>
                                <td>{{ $order->client_order->name }}</td>
                                <td>{{ $order->order_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y')}}</td>
                                <td>{{ $order->price.$order->currency_symbol}}</td>

                                @if($order->status == 'Order Completed')
                                    <td>Order Completed</td>
                                @else
                                    <td>Order Pending</td>
                                @endif

                                <td>{{ $order->type }}</td>

                                <td>
                                    <a class="fa fa-edit"
                                        href="{{ route('admin.edit.order', ['id' => $order->id]) }}">
                                    </a>
                                    <a class="fa fa-trash"
                                        href="{{ route('admin.delete.order', ['id' => $order->id]) }}">
                                    </a>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> --}}
            <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="orders-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Designer Name</th>
                            <th>Client Name</th>
                            <th>Order Name</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Invoice Type</th>
                            <th>Action</th>
                        </tr>
                       
                    </thead>
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
        
        // new DataTable('#table', {
        // order: [[3, 'desc']]
        // });


        $('#table').DataTable({
            "scrollX": true,
             "order": [[0, 'desc']]

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

<script>
    $(document).ready(function() {
        $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.order') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'designer_order.name', name: 'designer_order.name' },
                { data: 'client_order.name', name: 'client_order.name' },
                { data: 'order_name', name: 'order_name' },
                { data: 'date', name: 'date' },
                { data: 'price', name: 'price' },
                { data: 'status', name: 'status' },
                { data: 'type', name: 'type' },
                { data: 'action', name: 'action', orderable: true, searchable: false },
            ],
            order: [[0, 'desc']],
        });

        
    });
</script>

@endpush
