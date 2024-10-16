<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Student Note</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="chargesTypeError" style="display: none">
    </div>
    <form action="{{route('student-notes.store')}}" method="POST" id="studentNote"> 
        @csrf
        <input type="hidden" name="student_id" value="{{$student->id}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description" class="control-label" >Student Note:*</label>
                            <textarea type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description')}}"></textarea>
                            @error('description')
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
    <button type="submit" class="btn btn-primary" form="studentNote">Save</button>
</div>