<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Quarter</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="examTypeError" style="display: none">
    </div>
    <form action="{{route('quarters.store')}}" method="POST" id="examType"> 
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fromdate" class="control-label" >From Date:*</label>
                            <input type="date" id="fromdate" class="form-control @error('fromdate') is-invalid @enderror" name="fromdate" value="{{old('fromdate')}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="todate" class="control-label" >To Date:*</label>
                            <input type="date" id="todate" class="form-control @error('todate') is-invalid @enderror" name="todate" value="{{old('todate')}}">
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
    <button type="submit" class="btn btn-primary" form="examType">Save</button>
</div>