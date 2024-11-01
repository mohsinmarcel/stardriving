@extends('layout.app')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
@section('content')


<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Rates</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{route('rates.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-body">
                    <div class="header-title">Rates Create</div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="year" class="control-label" >Price Name:</label>
                                        <input type="text" id="year" class="form-control @error('year') is-invalid @enderror" name="year">
                                        @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="class_type_id" class="control-label" >Class Name:</label>
                                            <input type="text" readonly id="class_type_id" class="form-control @error('class_type_id') is-invalid @enderror" name="class_type_id[]" value="Theoretical">
                                            @error('class_type_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="module" class="control-label" >Class Module:</label>
                                        <input type="text" id="module" class="form-control  @error('module') is-invalid @enderror" value="12" name="module[]">
                                        @error('module')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="no_of_hours" class="control-label" >Credit Hours:</label>
                                        <input type="text" id="no_of_hours" class="form-control @error('no_of_hours') is-invalid @enderror" value="24" name="no_of_hours[]">
                                        @error('no_of_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="hourly_rate" class="control-label" >Per Hour Charges:</label>
                                        <input type="text" id="hourly_rate" class="form-control  @error('hourly_rate') is-invalid @enderror" name="hourly_rate[]">
                                        @error('hourly_rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="class_type_id" class="control-label" >Class Name:</label>
                                        <input type="text" readonly id="class_type_id" class="form-control @error('class_type_id') is-invalid @enderror" name="class_type_id[]" value="Practical">
                                        @error('class_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="module" class="control-label" >Class Module:</label>
                                        <input type="text" id="module" class="form-control  @error('module') is-invalid @enderror" name="module[]" value="15">
                                        @error('module')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="no_of_hours" class="control-label" >Credit Hours:</label>
                                        <input type="text" id="no_of_hours" class="form-control @error('no_of_hours') is-invalid @enderror" name="no_of_hours[]" value="15">
                                        @error('no_of_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="hourly_rate" class="control-label" >Per Hour Charges:</label>
                                        <input type="text" id="hourly_rate" class="form-control  @error('hourly_rate') is-invalid @enderror" name="hourly_rate[]">
                                        @error('hourly_rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 text-right mt-1">
                                    <a href="{{route('rates.index')}}" type="button" class="btn btn-secondary waves-effect">Close</a>
                                    <button type="submit" class="btn btn-primary waves-effect">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
<script>
        // $.NotificationApp.send("Message!","Password changed successfully.","top-right","rgba(0,0,0,0.2)","success")
</script>
@endpush
