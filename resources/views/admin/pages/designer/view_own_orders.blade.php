@extends('admin.layout.master')
@section('content')
@section('designer', 'active')
@section('title', 'Designer')

<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header row">
                <div class="col-md-3">
                    Designer Orders
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-4">




                </div>
                <div class="col-md-2">
                    <p>Pending: {{ $order_pending_count }}</p>
                    <p>Completed: {{ $order_completed_count }}</p>
                </div>

            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order Name</th>
                            <th>Date</th>
                            <th>Cost</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($designer_order->assign_order_to_designer as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y')}}</td>
                                <td>Rs.{{ $order->cost }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
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
