@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Users</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
    <form action="{{route('users.store')}}" method="POST" autocomplete="off">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Create New User</h5>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="control-label" >First Name:*</label>
                                    <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{old('first_name')}}">
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name" class="control-label" >Last Name:*</label>
                                    <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{old('last_name')}}">
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="control-label" >Username:*</label>
                                    <input type="text" id="username" autocomplete="off" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username')}}">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="control-label" >Password:*</label>
                                    <input type="password" autocomplete="off" id="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    <small id="emailHelp" class="form-text text-muted">Password minimum length is 8 characters.</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="control-label" >Confirm Password:*</label>
                                    <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <a href="{{route('users.index')}}" class="btn btn-secondary">Close</a>
                                <button type="submit" class="btn btn-primary waves-effect">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div><!-- end col -->
</div>


@endsection
@push('scripts')
@endpush