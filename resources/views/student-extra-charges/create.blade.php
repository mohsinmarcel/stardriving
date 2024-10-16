<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Student Extra Charges</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="extraChargesError" style="display: none">
    </div>
    <form action="{{route('student.extra.charges.store',$student->id)}}" method="POST" id="studentExtraCharges"> 
        @csrf
        <input type="hidden" name="student_id" value="{{$student->id}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="charges_type" class="control-label">Charges Type:</label>
                    <select class="form-control" name="charges_type" id="charges_type">
                        <option value="">--Select--</option>
                            @foreach ($chargesType as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="amount" class="control-label">Amount:</label>
                    <input type="text" id="amount" class="form-control" name="amount">
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
    <button type="submit" class="btn btn-primary" id="studentExtraChargesButton" form="studentExtraCharges">Save</button>
</div>