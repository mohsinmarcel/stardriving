@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">User Permissions</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="POST" action="{{ route('users.permission.update') }}">
                @csrf
                <div class="card-body">
                    <h4 class="header-title mb-4">Select User Role</h4>
                    <div class="form-group">
                        <label for="userRole">Select Role:</label>
                        <select class="form-control" id="userRole" name="userRole">
                            <option value="super_admin" {{ $selectedRole === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="admin" {{ $selectedRole === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="secretary" {{ $selectedRole === 'secretary' ? 'selected' : '' }}>Secretary</option>
                            <option value="teacher" {{ $selectedRole === 'teacher' ? 'selected' : '' }}>Teacher</option>
                        </select>
                    </div>
                    <div class="form-group float-right">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Close</a>
                        <input type="submit" value="Change Permissions" class="btn btn-primary">
                    </div>
                </div> <!-- end card body-->
            </form>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
@push('scripts')
@endpush
