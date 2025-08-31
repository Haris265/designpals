@extends('admin.layout.master')
@section('content')
@section('account', 'active')
@section('title', 'Account')

<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header row">
                <div class="col-md-3">
                    Account
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-4">




                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary" href="{{ route('admin.add.account') }}">Add Account</a>


                </div>

            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email Account</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $account->id }}</td>
                                <td>
                                    <a href="{{ route('admin.account.location', ['id' => $account->id]) }}">
                                        {{ $account->account_email }}
                                    </a>
                                </td>

                                <td>
                                    <a class="fa fa-edit"
                                        href="{{ route('admin.edit.account', ['id' => $account->id]) }}">
                                    </a>
                                    <a class="fa fa-trash"
                                        href="{{ route('admin.delete.account', ['id' => $account->id]) }}">
                                    </a>

                                </td>
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
