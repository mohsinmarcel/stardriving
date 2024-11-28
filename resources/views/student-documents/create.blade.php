<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Student Documents</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="studentDocumentError" style="display: none">
    </div>
    <form action="{{route('student.extra.charges.store',$student->id)}}" method="POST" id="studentDocumentForm">
        @csrf
        <input type="hidden" name="student_id" value="{{$student->id}}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="document_type_id" class="control-label">Document Type:</label>
                    <select class="form-control" name="document_type_id" id="document_type_id">
                        <option value="">--Select--</option>
                            @foreach ($documentType as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-control custom-switch" id="radioCheck" style="display: none">
                  <input type="checkbox" class="custom-control-input" id="signatureCheckBox" name="signature_status" value="1" {{old('signature_status') != null?'checked':'' }}>
                  <label class="custom-control-label" for="signatureCheckBox">Create Signature</label>
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
    <button type="submit" class="btn btn-primary" id="studentDocument" form="studentDocumentForm">Save</button>
</div>
