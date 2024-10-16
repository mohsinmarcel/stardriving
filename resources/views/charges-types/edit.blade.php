<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Charges Type</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="chargesTypeError" style="display: none">
    </div>
    <form action="" method="POST" id="updateChargesType"> 
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$chargesType->id}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="control-label" >Charges Type:*</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$chargesType->name)}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount" class="control-label" >Amount:*</label>
                            <input type="text" id="amount" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{old('amount',$chargesType->amount)}}">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Is Active</label>
                        <div class="form-group clearfix">
                            <div class="icheck-success d-inline">
                                <input type="checkbox"  {{$chargesType->is_active == 1 ?'checked':''}} name="is_active" id="checkboxSuccess1">
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
    <button type="submit" class="btn btn-primary" form="updateChargesType">Save</button>
</div>