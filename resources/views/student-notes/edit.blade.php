<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Student Note</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="studentNoteError" style="display: none">
    </div>
    <form action="" method="POST" id="updateStudentNote"> 
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$studentNote->id}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description" class="control-label" >Student Note:*</label>
                            <textarea type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="">{{old('description',$studentNote->description)}}</textarea>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>
  <div class="modal-footer">
    <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" form="updateStudentNote">Save</button>
</div>