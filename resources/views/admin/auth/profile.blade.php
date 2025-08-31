@extends('admin.layout.master')
@section('content')
@section('Profile', 'active')
@section('title', 'Profile')

<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header">Profile</h5>
            <div class="card-body">
                <form class="row" action="{{ route('admin.profile.update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @php $user = Auth::guard('admin')->user(); @endphp

                    <div class="form-group col-md-4">
                        {{-- <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center"> --}}
                                    @if ($user->image)
                                        <img src="{{ asset('/uploads/admins/profile/' . $user->image) }}" alt="Admin"
                                            class="rounded-circle" width="150" onclick="triggerClick()"
                                            id="profileDisplay">
                                    @else
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                            class="rounded-circle" width="150" onclick="triggerClick()"
                                            id="profileDisplay">
                                    @endif

                                    <div class="mt-1">
                                        {{-- <h4>{{ $user->name }}</h4> --}}
                                        <input type='file' onchange="displayImage(this)" id="profile"
                                            name="image" style="display:none">
                                    </div>
                                {{-- </div>
                            </div>
                        </div> --}}

                    </div>
                    <div class="form-group col-md-4">
                        <label class="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" />
                    </div>

                    <div class="form-group col-md-12">
                        <br />
                    </div>
                    <div class="form-group offset-md-10 col-md-2 col-sm-12">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function triggerClick() {
        document.querySelector('#profile').click();
    }

    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>
@endpush
