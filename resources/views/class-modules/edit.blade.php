<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Class Module</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="classModuleError" style="display: none">
    </div>
    <form action="" method="POST" id="updateClassModule"> 
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$classModule->id}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="class_type_id" class="control-label">Class Type:*</label>
                            <select class="form-control @error('class_type_id') is-invalid @enderror" name="class_type_id" id="">
                                <option value="">--select--</option>
                                <option value="1" {{old('class_type_id',$classModule->class_type_id) == 1 ?'selected':''}}>Theoretical</option>
                                <option value="2" {{old('class_type_id',$classModule->class_type_id) == 2 ?'selected':''}}>Practical</option>
                            </select>
                            @error('class_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="control-label" >Name:*</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$classModule->name)}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Is Active</label>
                        <div class="form-group clearfix">
                            <div class="icheck-success d-inline">
                                <input type="checkbox"  {{$classModule->active == 1 ?'checked':''}} name="active" id="checkboxSuccess1">
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
    <button type="submit" class="btn btn-primary" form="updateClassModule">Save</button>
</div>