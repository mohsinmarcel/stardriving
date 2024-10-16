@extends('layout.app')
@section('content')


<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Teachers</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{route('teachers.store')}}" method="POST" id="teacherForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="header-title">Teacher Info</div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name" class="control-label" >First Name:*</label>
                                        <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{old('first_name')}}">
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label" >Last Name:*</label>
                                        <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{old('last_name')}}">
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender" class="control-label" >Gender:</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="">
                                            <option value="">--select--</option>
                                            <option value="male" {{old('gender') == 'male'?'selected':''}}>Male</option>
                                            <option value="female" {{old('gender') == 'female'?'selected':''}}>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="phone_number" class="control-label" >Phone Number:*</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+1</span>
                                        </div>
                                        <input type="numer" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{old('phone_number')}}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address" class="control-label" >Address:</label>
                                        <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address')}}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label" >Email:</label>
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="license_number" class="control-label" >License Number:*</label>
                                        <input type="text" id="license_number" class="form-control @error('license_number') is-invalid @enderror" name="license_number" value="{{old('license_number')}}">
                                        @error('license_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="license_image" class="control-label" >License Image:</label>
                                        <input type="file" id="license_image" class="form-control-file @error('license_image') is-invalid @enderror" accept=".png" name="license_image" value="{{old('license_image')}}">
                                        @error('license_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="signatureCheckBox" name="signature_status" value="1" {{ old('signature_status') != null ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="signatureCheckBox">Create Signature</label>
                                        </div>
                                        <div id="signature_image" style=" {{ old('signature_status') != null ? 'display: none' : '' }} ">
                                            <label for="signature_image" class="control-label mt-2" >Signature Image:</label>
                                            <input type="file" id="signature_image" class="form-control-file @error('signature_image') is-invalid @enderror" accept=".png" name="signature_image" value="value="{{old('signature_image')}}"">
                                            @error('signature_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div id="signatureDiv" style=" {{ old('signature_status') != null ? '' : 'display: none' }} ">
                                            <h5>
                                                Draw your signature
                                                <a class="text-right clear-button" href="#" id="clear">Clear</a>
                                            </h5>
                                              <div class="wrapper" style="border: 1px solid black; width: 350px; height:200">
                                                <canvas id="signature-pad"  class="signature-pad" width=350 height=200></canvas>
                                              </div>
                                            @error('signature')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-md-12 text-right">
                                    <a href="{{route('teachers.index')}}" type="button" class="btn btn-secondary waves-effect">Close</a>
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
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>

    $(document).ready(function () {
        $('#teacherForm').submit(function(eventObj) {
            if($('#signatureCheckBox').prop('checked') && !signaturePad.isEmpty()) {
                $(this).append('<input type="hidden" name="signature" value="'+signaturePad.toDataURL('image/png')+'" /> ');
                return true;
            }
        });
    });
        
      $(document).on('change','#signatureCheckBox',function(){
            if($(this).prop('checked')) {
                $('#signatureDiv').show();
                $('#signature_image').hide();
            } else {
                $('#signatureDiv').hide();
                $('#signature_image').show();
            }
        })
        
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)'
      });
      $('#clear').click(function (e) { 
          e.preventDefault();
          signaturePad.clear();

      });
    </script>
    
@endpush