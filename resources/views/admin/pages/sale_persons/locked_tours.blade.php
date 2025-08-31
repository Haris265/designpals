@extends('admin.layout.master')
@section('content')
@section('locked', 'active')
@section('title', 'Locked Tours')

<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header row">
                <div class="col-md-10">
                    Locked Tours
                </div>
                {{-- <div class="col-md-2">
                    <a class="btn btn-primary" href="{{ route('add.tour') }}">Add Tour</a>
                </div> --}}
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th>S:no</th>
                            <th>Date</th>
                            <th>Tour</th>
                            <th>Tour Commander</th>
                            <th>Supervisor</th>
                            <th>Weather</th>
                            <th>User Name</th>

                            {{-- <th>Road Condition</th>
                            <th>Patrolman</th>
                            <th>Radio</th>
                            <th>Post</th> --}}
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($tours as $tour)
                        @if($tour->status=='locked')

                            <tr>
                                <td>{{ $tour->id }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($tour->tour_date)->format('d/m/Y') }}
                                </td>
                                <td>
                                    <a
                                        href="{{ route('blotter', ['id' => $tour->id]) }}">{{ $tour->tour_name }}</a>
                                </td>
                                <td>{{ $tour->tour_commander->name }}</td>
                                <td>{{ $tour->supervisor->name }}</td>
                                <td>{{ $tour->weather }}</td>
                                @if($tour->user_name)
                                <td>{{ $tour->user_name }}</td>
                                @else
                                <td>Admin</td>
                                @endif

                                {{-- <td>{{ $tour->road_condition }}</td>
                                <td>{{ $tour->officer->full_name }}</td>
                                <td>{{ $tour->radio }}</td>
                                <td>{{ $tour->post }}</td> --}}

                                <td>
                                    {{-- <a class="btn btn-primary"
                                        href="{{ route('edit.tour', ['id' => $tour->id]) }}">Edit Tour</a> --}}
                                    {{-- <a class="btn btn-danger"
                                        href="{{ route('delete.tour', ['id' => $tour->id]) }}">Delete
                                        Tour</a> --}}

                                       @endif




            </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
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
    });
</script>
@endpush
