@extends('admin.layout.master')
@section('content')
@section('client', 'active')
@section('title', 'Client Details')

<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header row">
                <div class="col-md-3">
                    Clients
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-4">




                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary" href="{{ route('admin.add.client') }}">Add Client Details</a>
                </div>

                <div class="col-md-2">
                    <form method="post" action="{{ route('admin.client.import') }}" enctype="multipart/form-data">
                        @csrf
                        <label class="ImpStaff btn btn-sm  btn-primary">Import
                          <input type="file" class=" d-none" onchange="form.submit()" name="file">
                        </label>
                      </form>
                </div>

            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Address</th>
                            <th>Company</th>
                            <th>Website</th>
                            <th>Sale Person Name</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($clients as $client)
                        @foreach ($client->sale_persons_clients as $sale_person)

                            <tr>
                                <td>{{ $sale_person->id }}</td>
                                <td>{{ $sale_person->name }}</td>
                                <td>{{ $sale_person->email }}</td>
                                <td>{{ $sale_person->phone_no }}</td>
                                <td>{{ $sale_person->address }}</td>
                                <td>{{ $sale_person->company }}</td>
                                <td>{{ $sale_person->website }}</td>
                                <td>{{ $client->name }}</td>



                                <td>
                                    <a class="fa fa-edit"
                                        href="{{ route('admin.edit.client', ['id' => $sale_person->id]) }}">
                                    </a>
                                    <a class="fa fa-trash"
                                        href="{{ route('admin.delete.client', ['id' => $sale_person->id]) }}">
                                    </a>
                                </td>


                            </tr>
                        @endforeach
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
