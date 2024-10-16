<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Student Documents</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="studentDocumentError" style="display: none">
    </div>
    <form action="" method="POST" id="updateStudentDocumentForm"> 
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$studentDocument->id}}">
        <div class="row">
            {{-- <div class="col-md-6">
                <div class="form-group">
                    <label for="document_type_id" class="control-label">Document Type:</label>
                    <select class="form-control" name="document_type_id" id="document_type_id">
                        <option value="">--Select--</option>
                            @foreach ($documentType as $item)
                            <option aria-readonly="true" value="{{$item->id}}" {{$item->id == old('document_type_id',$studentDocument->document_type_id)?'selected':''}}>{{$item->name}}</option>
                            @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="col-md-6">
                <div class="custom-control custom-switch helloWorld" id="radioCheck" style="display: none">
                  <input type="checkbox" class="custom-control-input" id="signatureCheckBox" name="signature_status" value="1" {{old('signature_status') != null?'checked':'' }}>
                  <label class="custom-control-label" for="signatureCheckBox">Update Signature</label>
                </div>
                <div class="form-group" id="fileInput" style="{{old('signature_status') != null?'display:none ':'' }}">
                    <label for="document" class="control-label">Student Document:</label>
                    <input type="file" id="document"
                        class="form-control-file @error('document') is-invalid @enderror" name="document">
                    @error('document')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div id="documentSignatureDiv" style="{{old('signature_status') != null?'':'display:none' }}">
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
                @php
                    $ext = pathinfo($studentDocument->document, PATHINFO_EXTENSION);
                // dd($ext)
                @endphp
                @if ($ext == 'pdf')
                <a href="{{asset('storage/'.$studentDocument->document)}}" target="_blank" alt="">Open Document</a>
                @else
                  <img src="{{asset('storage/'.$studentDocument->document)}}" alt="" style="height:100px" width="150px">
                @endif
            </div>
        </div>
    </form>
  </div>
  <div class="modal-footer">
    <div id="modal-preloader" class="my-2" style="display: none">
        <div class="modal-preloader_status">
          <div class="modal-preloader_spinner">
            <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status"></div>
            </div>
          </div>
        </div>
      </div>
    <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="" form="updateStudentDocumentForm">Save</button>
</div>