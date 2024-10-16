<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Student Payment</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="editPaymentError" style="display: none">
    </div>
    <form action="" method="post" id="editPaymentForm" class="row" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$student_payment->id}}">
        <input type="hidden" name="student_id" value="{{base64_encode($stduent_course_detail->student_id)}}">
        <input type="hidden" name="" value="{{$stduent_course_detail->remaining_amount}}" id="course_remaining_amount">
        <input type="hidden" name="" value="{{$extra_charges_remaining_amount}}" id="charges_remaining_amount">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Select Payment Method:*</label><br>
                @foreach ($payment_methods as $key => $item)
                <label class="control-label mr-4"><input {{ @$student_payment->payment_method->key == $item->key || $item->key == 'cash'?'checked':''}} id="payment_method" name="payment_method" type="radio" value="{{$item->key}}"> {{$item->name}}</label>
                @endforeach
            </div>
        </div>
        <div class="col-md-6" id="payment_card_type" style="{{@$student_payment->payment_method->key == 'credit_card' ? '' : 'display: none'}}">
            <div class="form-group">
                <label for="card_type" class="control-label" >Card Type:*</label>
                <select id="card_type" class="form-control" name="card_type">
                    <option value>-- Select Card Type --</option>
                    <option value="Visa" {{$student_payment->card_type == 'Visa' ? 'selected' : ''}}>Visa</option>
                    <option value="Master Card" {{$student_payment->card_type == 'Master Card' ? 'selected' : ''}}>Master Card</option>
                    <option value="Amex" {{$student_payment->card_type == 'Amex' ? 'selected' : ''}}>Amex</option>
                </select>
            </div>
        </div>
        <div class="col-md-6" id="payment_credit_card" style="{{@$student_payment->payment_method->key == 'credit_card' ? '' : 'display: none'}}">
            <div class="form-group">
                <label for="credit_card" class="control-label" >Credit Card:*</label>
                <input type="text" id="credit_card" value="{{$student_payment->credit_card}}" placeholder="Last four digits" class="form-control" name="credit_card">
            </div>
        </div>
        <div class="col-md-6" id="payment_debit_card" style="{{@$student_payment->payment_method->key == 'debit_card' ? '' : 'display: none'}}">
            <div class="form-group">
                <label for="debit_card" class="control-label" >Debit Card:*</label>
                <input type="text" id="debit_card" value="{{$student_payment->debit_card}}" placeholder="Last four digits" class="form-control" name="debit_card">
            </div>
        </div>
        <div class="col-md-6" id="payment_cheque" style="{{@$student_payment->payment_method->key == 'cheque' ? '' : 'display: none'}}">
            <div class="form-group">
                <label for="cheque_image" class="control-label" >Cheque Image:*</label>
                <input type="file" id="cheque_image" placeholder="" class="form-control-file" name="cheque_image">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="payment_date" class="control-label" >Payment Date:*</label>
                <input type="date" id="payment_date" value="{{$student_payment->payment_date}}" class="form-control" name="payment_date">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="payment_type" class="control-label" >Payment Type:*</label>
                <input type="hidden" name="payment_type" value="{{$student_payment->payment_type_id}}">
                <select id="payment_type" class="form-control" disabled>
                    @foreach ($payment_type as $item)
                        <option value="{{$item->id}}" {{$student_payment->payment_type_id == $item->id ? 'selected' : ''}}>{{$item->type}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="amount" class="control-label" >Amount:*</label>
                <input type="text" id="amount" value="{{$student_payment->amount}}" class="form-control" name="amount">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="additional_notes" class="control-label" >Additional Notes:</label>
                <input type="text" id="additional_notes" value="{{$student_payment->additional_notes}}" class="form-control" name="additional_notes">
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
    <button type="submit" class="btn btn-primary" id="editPaymentButton" {{$stduent_course_detail->remaining_amount <= 0?'disabled':''}} form="editPaymentForm">Update Payment</button>
</div>