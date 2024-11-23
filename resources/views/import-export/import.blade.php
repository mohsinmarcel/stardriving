@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex justify-content-between align-items-center">
            <h4 class="page-title">Import/Export Students</h4>
        </div>
    </div>
</div>

<div class="row g-4">
    @can('import')
    <div class="col-lg-6 col-md-12">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="header-title mb-4 d-flex justify-content-between align-items-center">
                    Import Students
                    <a href="{{ asset('studentSampleFile.xlsx') }}"
                       class="btn btn-sm btn-outline-secondary"
                       download>Download Sample File</a>
                </h5>
                <form action="{{ route('import-export.importpost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="MAX_FILE_SIZE" value="500000">
                    <div class="form-group">
                        <label for="import_file" class="form-label">Upload File</label>
                        <input type="file" class="form-control @error('import_file') is-invalid @enderror"
                               name="import_file" id="import_file" accept=".xlsx">
                        <small class="form-text text-muted">
                            File must be an Excel file with the same format as the sample file.
                        </small>
                        @error('import_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Import Data</button>
                </form>
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <strong>Error!</strong> Please fix the following issues:
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endcan

    @can('export')
    <div class="col-lg-6 col-md-12">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="header-title mb-4">Export Students</h5>
                <p class="text-muted mb-4">
                    Download the student data in Excel format
                </p>
                <a href="{{ route('import-export.export') }}" class="btn btn-primary w-100">Export Data</a>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection

@push('scripts')
<script>
    var success = '{{ Session::get('success') }}';
    if (success !== '') {
        $.NotificationApp.send(
            "Message!",
            success,
            "top-right",
            "rgba(0,0,0,0.2)",
            "success"
        );
    }
</script>
@endpush
