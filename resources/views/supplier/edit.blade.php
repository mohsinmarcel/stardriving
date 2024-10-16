<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Exam Type</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="examTypeError" style="display: none">
    </div>
    <form action="" method="POST" id="updateExamType"> 
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$examType->id}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="control-label" >Exam Type:*</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$examType->name)}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Is Active</label>
                        <div class="form-group clearfix">
                            <div class="icheck-success d-inline">
                                <input type="checkbox"  {{$examType->active == 1 ?'checked':''}} name="active" id="checkboxSuccess1">
                                <label for="checkboxSuccess1">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>
  <div class="modal-footer">
    <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" form="updateExamType">Save</button>
</div>