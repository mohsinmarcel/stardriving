<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Evaluation Criteria</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="evaluationTypeError" style="display: none">
    </div>
    <form action="" method="POST" id="updateEvaluationType"> 
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$evaluationType->id}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="control-label" >Name:*</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$evaluationType->name)}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" class="control-label">Evaluation Criteria:*</label>
                                        <select class="form-control @error('type') is-invalid @enderror" name="type"
                                            id="">
                                            <option value="">--select--</option>
                                            <option value="strength" {{old('type',$evaluationType->type) == 'strength'?'selected':''}}>Strength</option>
                                            <option value="weakness" {{old('type',$evaluationType->type) == 'weakness'?'selected':''}}>Weakness</option>
                                        </select>
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Is Active</label>
                        <div class="form-group clearfix">
                            <div class="icheck-success d-inline">
                                <input type="checkbox"  {{$evaluationType->active == 1 ?'checked':''}} name="active" id="checkboxSuccess1">
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
    <button type="submit" class="btn btn-primary" form="updateEvaluationType">Save</button>
</div>