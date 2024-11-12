@extends('layout.app')
@push('css')
<link href="{{asset('assets/css/vendor/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/vendor/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">Settings</h4>
      </div>
   </div>
</div>
<div class="card">
<div class="card-body">
   <ul class="nav nav-tabs nav-bordered mb-3">
      <li class="nav-item">
         <a href="#tax" data-toggle="tab" aria-expanded="false" class="nav-link active">
         <i class="mdi mdi-home-variant d-md-none d-block"></i>
         <span class="d-none d-md-block">Tax</span>
         </a>
      </li>
      {{--
      <li class="nav-item">
         <a href="#smtp" data-toggle="tab" aria-expanded="true" class="nav-link ">
         <i class="mdi mdi-account-circle d-md-none d-block"></i>
         <span class="d-none d-md-block">Mail Settings</span>
         </a>
      </li>
      --}}
      <li class="nav-item">
         <a href="#representative_signature_image" data-toggle="tab" aria-expanded="true" class="nav-link ">
         <i class="mdi mdi-account-circle d-md-none d-block"></i>
         <span class="d-none d-md-block">Representative Signature</span>
         </a>
      </li>
      <li class="nav-item">
         <a href="#usernameTab" data-toggle="tab" aria-expanded="true" class="nav-link ">
         <i class="mdi mdi-account-circle d-md-none d-block"></i>
         <span class="d-none d-md-block">Username</span>
         </a>
      </li>
      <li class="nav-item">
         <a href="#passwordTab" data-toggle="tab" aria-expanded="true" class="nav-link ">
         <i class="mdi mdi-account-circle d-md-none d-block"></i>
         <span class="d-none d-md-block">Password</span>
         </a>
      </li>
      {{--
      <li class="nav-item">
         <a href="#datatbaseResetTab" data-toggle="tab" aria-expanded="true" class="nav-link ">
         <i class="mdi mdi-account-circle d-md-none d-block"></i>
         <span class="d-none d-md-block">Database Reset</span>
         </a>
      </li>
      --}}
      <li class="nav-item">
         <a href="#locations" data-toggle="tab" aria-expanded="true" class="nav-link ">
         <i class="mdi mdi-map-marker d-md-none d-block"></i>
         <span class="d-none d-md-block">Exam Locations</span>
         </a>
      </li>
      <li class="nav-item">
         <a href="#templates" data-toggle="tab" aria-expanded="true" class="nav-link ">
         <i class="mdi mdi-map-marker d-md-none d-block"></i>
         <span class="d-none d-md-block">Templates</span>
         </a>
      </li>
   </ul>
   <div class="tab-content">
      <div class="tab-pane active" id="tax">
         <form action="{{route('settings.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="tax" name="slug" value="tax">
            <div class="col-md-4">
               <div class="form-group">
                  <label for="gst_tax" class="control-label" >GST Tax:</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="gst_tax" value="{{@$settingsData['tax']['gst_tax']}}">
                     <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">%</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="qst_tax" class="control-label" >QST Tax:</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="qst_tax" value="{{@$settingsData['tax']['qst_tax']}}">
                     <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">%</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12 text-right">
               <button  type="submit" class="btn btn-primary waves-effect">Update</button>
            </div>
         </form>
      </div>
      {{--
      <div class="tab-pane" id="smtp">
         <form action="{{route('settings.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="smtp" name="slug" value="smtp">
            <div class="col-md-4">
               <div class="form-group">
                  <label for="smtp_host" class="control-label" >SMTP Host:</label>
                  <input type="text" class="form-control" name="smtp_host" value="{{@$settingsData['smtp']['MAIL_HOST']}}">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="port" class="control-label" >Port:</label>
                  <input type="text" class="form-control" name="port" value="{{@$settingsData['smtp']['MAIL_PORT']}}">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="email" class="control-label" >Email:</label>
                  <input type="text" class="form-control" name="email" value="{{@$settingsData['smtp']['MAIL_USERNAME']}}">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group input-group-merge">
                     <input type="password" name="email_password" class="form-control" value="{{@$settingsData['smtp']['MAIL_PASSWORD']}}">
                     <div class="input-group-append" data-password="false">
                        <div class="input-group-text">
                           <span class="password-eye"></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12 text-right">
               <button  type="submit" class="btn btn-primary waves-effect">Update</button>
            </div>
         </form>
      </div>
      --}}
      <div class="tab-pane" id="representative_signature_image">
         <form action="{{route('settings.store')}}" method="POST" id="representativeSignature" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="representative information" name="slug" value="representative information">
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="representative_name" class="control-label" >Representative Name:</label>
                     <input type="text" id="representative_name" class="form-control @error('representative_name') is-invalid @enderror" name="representative_name" value="{{old('representative_name',@$settingsData["representative information"]['representative_name'])}}">
                     @error('representative_name')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="representativeSignatureCheckBox" name="signature_status" value="1" {{ old('signature_status') != null ? 'checked' : '' }}>
                        <label class="custom-control-label" for="representativeSignatureCheckBox">Create Signature</label>
                     </div>
                     <div id="representative_signature_image_div" style=" {{ old('signature_status') != null ? 'display: none' : '' }} ">
                        <label for="representative_signature_image" class="control-label mt-2" >Signature Image:*</label>
                        <input type="file" id="representative_signature_image" class="form-control-file @error('representative_signature_image') is-invalid @enderror" accept=".png" name="representative_signature_image" value="value="{{old('representative_signature_image')}}"">
                        @error('representative_signature_image')
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
                  @if (@$settingsData["representative information"]['representative_signature_image'] != null)
                  <div class="col-md-6">
                     <img src="{{(asset('storage/'.@$settingsData["representative information"]['representative_signature_image']))}}" style="width:300px; height:150px;" alt="">
                  </div>
                  @else
                  <div class="col-md-6">
                     <img src="{{(asset('/assets/images/no-image-available.png'))}}" style="width:300px; height:150px;" alt="">
                  </div>
                  @endif
               </div>
               <div class="col-md-12 text-right">
                  <button  type="submit" class="btn btn-primary waves-effect">Update</button>
               </div>
            </div>
         </form>
      </div>
      <div class="tab-pane" id="usernameTab">
         <form action="{{route('settings.username')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
               <div class="form-group">
                  <label for="username" class="control-label" >Username:</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="username" value="{{Auth::user()->username}}">
                     <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">@</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12 text-right">
               <button  type="submit" class="btn btn-primary waves-effect">Update</button>
            </div>
         </form>
      </div>
      <div class="tab-pane" id="passwordTab">
         <form action="{{route('settings.password')}}" method="post" id="changePassword">
            @csrf
            <div class="form-group">
               <label for="">Old Password</label>
               <input type="password" name="old_password" id="oldpassword" class="form-control">
            </div>
            <div class="form-group">
               <label for="">New Password</label>
               <input type="password" name="new_password" id="newpassword" class="form-control">
            </div>
            <div class="form-group">
               <label for="">Confirm Password</label>
               <input type="password" name="new_password_confirmation" id="newpassword_confirmation" class="form-control">
            </div>
            <div class="col-md-12 text-right">
               <button  type="submit" class="btn btn-primary waves-effect">Update</button>
            </div>
         </form>
      </div>
      {{--
      <div class="tab-pane" id="datatbaseResetTab">
         <form action="{{route('settings.databaseReset')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
               <button  type="submit" class="btn btn-primary waves-effect">Reset</button>
            </div>
         </form>
      </div>
      --}}
      <div class="tab-pane" id="locations">
         <form action="{{ route('settings.storeLocation') }}" method="POST">
            @csrf
            <div class="form-group">
               <label for="location">Location:</label>
               <input type="text" class="form-control" name="location" required>
               @error('location')
               <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary waves-effect">Add Location</button>
         </form>
         <!-- Display Locations Table -->
         <div class="mt-4">
            <table class="table">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Location</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($locations as $location)
                  <tr>
                     <td>{{ $location->id }}</td>
                     <td>{{ $location->name }}</td>
                     <td>
                        <button type="button"  class="btn btn-info p-1" style="font-size: 1.3rem" data-toggle="modal" data-target="#editLocationModal{{ $location->id }}"><i class="uil uil-file-edit-alt"></i></button>
                        <!-- Add buttons for edit and delete -->
                        <form action="{{ route('settings.destroyLocation', $location->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('DELETE')
                           <button type="submit"  class="btn btn-danger p-1" style="font-size: 1.3rem" onclick="return confirm('Are you sure you want to delete this location?')"><i class="uil uil-trash-alt"></i></button>
                        </form>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
      <div class="tab-pane" id="templates">
         <form action="{{ route('settings.storetemplate') }}" method="POST">
            @csrf
            <div class="row">
               <diV class="col-md-3">
                  <div class="form-group">
                     <label for="name">Name:</label>
                     <input type="text" class="form-control" name="name" required>
                     @error('name')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
               <diV class="col-md-9">
                  <div class="form-group">
                     <label for="message">Message:</label>
                     <textarea class="form-control py-5" name="message" required></textarea>
                     {{-- <input type="text" class="form-control" name="message" required> --}}
                     @error('message')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>

            <button type="submit" class="btn btn-primary waves-effect">Add Template</button>
         </form>
         <!-- Display Locations Table -->
         <div class="mt-4">
            <table class="table">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Message</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($template as $temp)
                  <tr>
                     <td>{{ $temp->id }}</td>
                     <td>{{ $temp->name }}</td>
                     <td>{{ $temp->message }}</td>
                     <td>
                        <button type="button"  class="btn btn-info p-1" style="font-size: 1.3rem" data-toggle="modal" data-target="#editTemplateModal{{ $temp->id }}"><i class="uil uil-file-edit-alt"></i></button>
                        <!-- Add buttons for edit and delete -->
                        <form action="{{ route('settings.destroytemplate', $temp->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('DELETE')
                           <button type="submit"  class="btn btn-danger p-1" style="font-size: 1.3rem" onclick="return confirm('Are you sure you want to delete this template?')"><i class="uil uil-trash-alt"></i></button>
                        </form>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@foreach($locations as $location)
<!-- Edit Location Modal -->
<div class="modal fade" id="editLocationModal{{ $location->id }}" tabindex="-1" role="dialog" aria-labelledby="editLocationModalLabel{{ $location->id }}" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editLocationModalLabel{{ $location->id }}">Edit Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <!-- Edit Location Form -->
            <form action="{{ route('settings.updateLocation', $location->id) }}" method="POST">
               @csrf
               @method('PUT')
               <div class="form-group">
                  <label for="location">Location:</label>
                  <input type="text" class="form-control" name="location" value="{{ $location->name }}" required>
                  @error('location')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div>
               <button type="submit" class="btn btn-primary">Update Location</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endforeach

@foreach($template as $temp)
<!-- Edit Location Modal -->
<div class="modal fade" id="editTemplateModal{{ $temp->id }}" tabindex="-1" role="dialog" aria-labelledby="editTemplateModalLabel{{ $temp->id }}" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editLocationModalLabel{{ $temp->id }}">Edit Template</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <!-- Edit Location Form -->
            <form action="{{ route('settings.updatetemplate', $temp->id) }}" method="POST">
               @csrf
               @method('PUT')
               <div class="row">
               <diV class="col-md-3">
                  <div class="form-group">
                     <label for="name">Name:</label>
                     <input type="text" class="form-control" name="name" value="{{ $temp->name }}" required>
                     @error('name')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
               <diV class="col-md-9">
                  <div class="form-group">
                     <label for="message">Message:</label>
                     <input type="text" class="form-control" name="message" value="{{ $temp->message }}" required>
                     @error('message')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
               <button type="submit" class="btn btn-primary">Update Template</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endforeach
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
   var success = '{{Session::get('success')}}'
   // console.log(success);
   if(success != ''){
       $.NotificationApp.send("Message!",success,"top-right","rgba(0,0,0,0.2)","success")
   }

   $(document).ready(function () {
       $('#representativeSignature').submit(function(eventObj) {
           if($('#representativeSignatureCheckBox').prop('checked') && !signaturePad.isEmpty()) {
               $(this).append('<input type="hidden" name="signature" value="'+signaturePad.toDataURL('image/png')+'" /> ');
               return true;
           }
       });
       const urlParams = new URLSearchParams(window.location.search);
          const activeTab = urlParams.get('active_tab');

            if (activeTab) {
                $('.nav-tabs .nav-item').removeClass('active');
                $(`a[href="#tax"]`).removeClass('active');
                 $('.tab-content .tab-pane').removeClass('active show');
                $(`#${activeTab}`).addClass('active show');
                $(`#${activeTab}-tab`).addClass('active');
                $(`a[href="#${activeTab}"]`).addClass('active');
            }
   });

   $(document).on('change','#representativeSignatureCheckBox',function(){
           if($(this).prop('checked')) {
               $('#signatureDiv').show();
               $('#representative_signature_image_div').hide();
           } else {
               $('#signatureDiv').hide();
               $('#representative_signature_image_div').show();
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
