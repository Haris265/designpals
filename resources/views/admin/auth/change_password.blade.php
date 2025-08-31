@extends('admin.layout.master')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <form action="{{route('admin.change.password.process')}}" method="post" class="row">
                    @csrf
                    <div class="form-group col-md-4">
                        <label class="">Current Password</label>
                        <input type="password" class="form-control" name="current_password" />
                        @error('current_password')
                            <span class="control-label" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="">New Password</label>
                        <input type="password" class="form-control" name="new_password" />
                        @error('new_password')
                            <span class="control-label" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" />
                        @error('confirm_password')
                            <span class="control-label" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <br />
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
