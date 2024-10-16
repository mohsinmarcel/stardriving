<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Evaluation Criteria</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="evaluationTypeError" style="display: none">
    </div>
    <form action="{{route('evaluation-types.store')}}" method="POST" id="evaluationType"> 
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="control-label" >Name:*</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" class="control-label" >Evaluation Criteria:*</label>
                            <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                <option value="">--select--</option>
                                <option value="strength" {{old('type') == 'strength'?'selected':''}}>Strength</option>
                                <option value="weakness" {{old('type') == 'weakness'?'selected':''}}>Weakness</option>
                            </select>
                            @error('type')
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
    <button type="submit" class="btn btn-primary" id="evaluationTypeButton" form="evaluationType">Save</button>
</div>