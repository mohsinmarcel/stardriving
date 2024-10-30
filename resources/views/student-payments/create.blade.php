<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Student Payment Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="payNowModelError" style="display: none">
    </div>
    <div class="alert bg-info text-light pb-0" id="allAmountPaidMessage" style="{{$stduent_course_detail->remaining_amount <= 0?'':'display: none'}}">
        <p>All amount is paid. Remaining amount: 0.</p>
    </div>
    <form action="" method="post" id="payNowForm" class="row" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="student_id" value="{{base64_encode($stduent_course_detail->student_id)}}">
        <input type="hidden" name="" value="{{$stduent_course_detail->remaining_amount}}" id="course_remaining_amount">
        <input type="hidden" name="" value="{{$extra_charges_remaining_amount}}" id="charges_remaining_amount">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Select Payment Method:*</label><br>
                @foreach ($payment_methods as $key => $item)
                <label class="control-label mr-4"><input {{ old('payment_method') == $item->key || $item->key == 'cash'?'checked':''}} id="payment_method" name="payment_method" type="radio" value="{{$item->key}}"> {{$item->name}}</label>
                @endforeach
            </div>
        </div>
        <div class="col-md-6" id="payment_card_type" style="display: none">
            <div class="form-group">
                <label for="card_type" class="control-label" >Card Type:*</label>
                <select id="card_type" class="form-control" name="card_type">
                    <option value>-- Select Card Type --</option>
                    <option value="Visa">Visa</option>
                    <option value="Master Card">Master Card</option>
                    <option value="Amex">American Express</option>
                </select>
            </div>
        </div>
        <div class="col-md-6" id="payment_credit_card" style="display: none">
            <div class="form-group">
                <label for="credit_card" class="control-label" >Credit Card:*</label>
                <input type="text" id="credit_card" placeholder="Last four digits" class="form-control" name="credit_card">
            </div>
        </div>
        <div class="col-md-6" id="payment_debit_card" style="display: none">
            <div class="form-group">
                <label for="debit_card" class="control-label" >Debit Card:*</label>
                <input type="text" id="debit_card" placeholder="Last four digits" class="form-control" name="debit_card">
            </div>
        </div>
        <div class="col-md-6" id="payment_cheque" style="display: none">
            <div class="form-group">
                <label for="cheque_image" class="control-label" >Cheque Image:*</label>
                <input type="file" id="cheque_image" placeholder="" class="form-control-file" name="cheque_image">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="payment_date" class="control-label" >Payment Date:*</label>
                <input type="date" id="payment_date" class="form-control" name="payment_date">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="payment_type" class="control-label" >Payment Type:*</label>
                <select id="payment_type" class="form-control" name="payment_type">
                    @foreach ($payment_type as $item)
                        <option value="{{$item->id}}">{{$item->type}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="amount" class="control-label" >Amount:*</label>
                <input type="text" id="amount" class="form-control" name="amount" onkeyup="calculateRemainingAmount()">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="additional_notes" class="control-label" >Additional Notes:</label>
                <input type="text" id="additional_notes" class="form-control" name="additional_notes">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="remaining_amount" class="control-label" >Remaining Amount:</label>
                <input type="text" id="remaining_amount" readonly class="form-control" name="remaining_amount" value="{{$stduent_course_detail->remaining_amount}}" data-remaining="{{$stduent_course_detail->remaining_amount}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="recieved_by" class="control-label" >Recieved By:</label>
                <select class="form-control form-select" onchange="recievedFunction(this)" name="recieved_by">
                    <option value="Arham">Arham</option>
                    <option value="Maaz">Maaz</option>
                    <option value="Sohail">Sohail</option>
                    <option value="POS">POS</option>
                    <option value="Other">Other</option>

                </select>
                <br>
                <input type="text" id="recieve_other"  class="form-control d-none" name="recieve_other">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group clearfix">
                <div class="icheck-success d-inline">
                    <input type="checkbox" name="send_mail" id="send_mail">
                    <label for="send_mail" style="margin-left: 10px">
                        Send Email
                    </label>
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
    <button type="submit" class="btn btn-primary" id="addPaymentBtn" {{$stduent_course_detail->remaining_amount <= 0?'disabled':''}} form="payNowForm">Add Payment</button>
</div>

<script>
    function recievedFunction(input)
    {
        let value = $(input).val();
        $('#recieve_other').val('');
        if(value == 'Other')
        {
            $('#recieve_other').removeClass('d-none');
        }
        else
        {
            $('#recieve_other').addClass('d-none');
        }
    }
</script>
