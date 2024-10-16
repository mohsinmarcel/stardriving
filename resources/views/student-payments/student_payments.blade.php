<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Student Payment Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <table class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>Payment<br>Mode</th>
                <th>Payment<br>Date</th>
                <th>Payment<br>Type</th>
                <th>Paid<br>Amount</th>
                <th>Card<br>Type</th>
                <th>Credit<br>Card</th>
                <th>Debit<br>Card</th>
                <th>Cheque<br>Image</th>
                <th>Additional<br>Notes</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentPayments as $item)
            <tr>
                <td>{{$item->payment_method->name}}</td>
                <td>{{$item->payment_date}}</td>
                <td>{{$item->payment_type->type}}</td>
                <td>{{$item->amount}}</td>
                <td>{{$item->card_type??'N/A'}}</td>
                <td>{{$item->credit_card??'N/A'}}</td>
                <td>{{$item->debit_card??'N/A'}}</td>
                <td>
                  @if ($item->payment_method->key == 'cheque' && $item->cheque_image != null)
                  <img src="{{asset('storage/'.$item->cheque_image)}}" height="100" alt="">
                  @else 
                  N/A
                  @endif
                </td>
                <td>{{$item->additional_notes??'N/A'}}</td>
                <td>
                  
                  @can('payment-edit')
                    <button class="btn btn-info editPaymentButton mt-1 ml-1" data-value="{{$item->id}}">
                      <i class="uil uil-edit-alt"></i>
                    </button>
                  @endcan
                  @can('payment-delete')
                    <button class="btn btn-danger deletePaymentButton mt-1 ml-1" data-value="{{$item->id}}">
                      <i class="uil uil-trash-alt"></i>
                    </button>
                  @endcan
                  @can("payment-send-email")
                    <button class="btn btn-info sendReceiptEmail mt-1 ml-1" title="send email" data-value="{{$item->id}}">
                      <i class="uil uil-envelope-send"></i>
                    </button>
                  @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>