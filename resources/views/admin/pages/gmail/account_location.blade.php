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
                    Location
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
                            <th>US</th>
                            <th>UK</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {{-- @foreach ($account as $client_account) --}}
                            <tr>

                                <td>@if(!empty($account)) {{ $account->id }} @endif</td>
                                <td>
                                    @if(!empty($account))
                                    <a href="{{ route('admin.location.us', ['id' => $account->id]) }}">
                                        {{ $account->us }}
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($account))
                                    <a href="{{ route('admin.location.uk', ['id' => $account->id]) }}">
                                         {{ $account->uk }}
                                    </a>
                                    @endif
                                </td>


                            </tr>
                        {{-- @endforeach --}}
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
