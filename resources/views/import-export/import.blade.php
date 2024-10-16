@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Import/Export Students</h4>
        </div>
    </div>
</div>
<div class="row">
    @can('import')
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title mb-4">Import Students
                        <a href="{{asset('assets/template/import-format.xlsx')}}" class="float-right btn btn-link" style="text-transform: none" download>Download Sample File</a>
                    </h2>
                    <form action="{{route('import-export.importpost')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000">
                        <div class="form-group">
                        <label for="import_file">Upload File</label>
                        <input type="file" class="form-control-file @error('import_file') is-invalid @enderror" name="import_file" id="import_file" accept=".xlsx" placeholder="" aria-describedby="fileHelpId">
                        <small id="fileHelpId" class="form-text text-muted">File must be an excel and have same format as mentioned in above sample file.</small>
                        @error('import_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Import Data</button>
                    </form>
                    @if (count($errors) > 0)
                        <div class="row mt-3">
                            <div class="col-md-12 col-md-offset-1">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                @foreach($errors->all() as $error)
                                {{ $error }} <br>
                                @endforeach      
                            </div>
                            </div>
                        </div>
                    @endif
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    @endcan
    
    @can('export')
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title mb-4">Export Students</h2>
                    <a href="{{route('import-export.export')}}" class="btn btn-primary">Download</a>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    @endcan
</div>
@endsection
@push('scripts')
<script>
    var success = '{{Session::get('success')}}'
    if(success != ''){
        $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
    }
</script>
@endpush