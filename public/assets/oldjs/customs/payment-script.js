function paymentOptions(item){
        
    if(item == 'credit_card') {
        $('#payment_credit_card').show();
        $('#payment_card_type').show();
        $('#payment_debit_card').hide();
        $('#payment_cheque').hide();
    } else if(item == 'debit_card') {
        $('#payment_debit_card').show();
        $('#payment_cheque').hide();
        $('#payment_credit_card').hide();
        $('#payment_card_type').hide();
    } else if(item == 'cheque') {
        $('#payment_cheque').show();
        $('#payment_credit_card').hide();
        $('#payment_debit_card').hide();
        $('#payment_card_type').hide();
    } else{
        $('#payment_debit_card').hide();
        $('#payment_cheque').hide();
        $('#payment_credit_card').hide();
        $('#payment_card_type').hide();
    }
}
function calculateRemainingAmount(){
    let paymentTypeVal = $('#payment_type').val()
    let amount   = document.querySelector('#amount');
    let actual_remaining_amount = 0;
    if(paymentTypeVal == '1'){
        actual_remaining_amount = $('#course_remaining_amount').val()
    }else if(paymentTypeVal == '2'){
        actual_remaining_amount = $('#charges_remaining_amount').val()
    }
    let remaining_amount     = document.querySelector('#remaining_amount');
    amount = amount.value == ''?0:amount.value
    remaining_amount.value = (parseFloat(actual_remaining_amount) - parseFloat(amount)).toFixed(2);
}
$(document).on('click','.payNowButton,#addPayment',function(){
    let id = btoa($(this).attr('data-value'));
    $('#frontPagesModal').modal('show');
    $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
        <div class="modal-preloader_status">
        <div class="modal-preloader_spinner">
            <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status"></div>
            </div>
        </div>
        </div>
    </div>`);
    $.get( base_url+"/student-payments/create"+"?id="+id, function( data ) {
        $('#frontPagesModal .modal-dialog').addClass('modal-lg');
        $('#frontPagesModal .modal-content').html(data);
    });
})
$(document).on('change','#payment_method',function(){
    paymentOptions($(this).val())
})
$(document).on('submit','#payNowForm',function(e){
  e.preventDefault();
  $.ajax({
    url: base_url+"/student-payments",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    dataType:'JSON',
    beforeSend : function(){
        $('#addPaymentBtn').prop('disabled',true);
        $('#modal-preloader').css('display','inline-block');
    },
    success: function(data){
        if($.isEmptyObject(data.error)){
            if(data.status)
            {
              $('#frontPagesModal').modal('hide');
              $.NotificationApp.send("Message!",data.message,"top-right","rgba(0,0,0,0.2)","success")
            //   window.location.reload();
                window.location.href = window.location.pathname+"?"+$.param({'page':'unpaid'})
            }
        }else{
            printErrorMsg(data.error,"#frontPagesModal #payNowModelError");
        }
    }, error:function(jhxr,status,err){
        console.log(jhxr);
    },
    complete:function(){
        $('#addPaymentBtn').prop('disabled',false);
        $('#modal-preloader').css('display','none');
    }   
    });
})
$(document).on('click','.showPayment,#showPayment',function (e) { 
    $('#frontPagesModal').modal('show');
    $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
        <div class="modal-preloader_status">
        <div class="modal-preloader_spinner">
            <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status"></div>
            </div>
        </div>
        </div>
    </div>`);
    let id = $(this).attr('data-value');
    $.get( base_url+"/ajax/studentPayments/"+id, function( data ) {
        $('#frontPagesModal .modal-dialog').addClass('modal-xl');
        $('#frontPagesModal .modal-content').html(data);
    });
});
$(document).on('change','#payment_type',function(){
    let paymentTypeVal = $(this).val()
    if(paymentTypeVal == '1'){
        let remainingVal = $('#course_remaining_amount').val()
        $('#remaining_amount').val(remainingVal)
        if(parseFloat(remainingVal) <= 0){
            $('#addPaymentBtn').prop('disabled',true)
            $('#allAmountPaidMessage').show()
        }else{
            $('#addPaymentBtn').prop('disabled',false)
            $('#allAmountPaidMessage').hide()
        }
    }else if(paymentTypeVal == '2'){
        let remainingVal = $('#charges_remaining_amount').val()
        $('#remaining_amount').val(remainingVal)
        console.log(parseFloat(remainingVal));
        if(parseFloat(remainingVal) <= 0){
            $('#addPaymentBtn').prop('disabled',true)
            $('#allAmountPaidMessage').show()
        }else{
            $('#addPaymentBtn').prop('disabled',false)
            $('#allAmountPaidMessage').hide()
        }
    }
    calculateRemainingAmount()
})

$(document).on('click','.deletePaymentButton',function(){
    let dataId = $(this).attr('data-value')
    let route = base_url+'/student-payments/'+dataId
    $('#deleteRecordForm').attr('action',route)
    $('#delete-alert-modal').modal('show')
    // window.location.reload();
})

$(document).on('click','.sendReceiptEmail',function(e){
    e.preventDefault();
    buttonElement = $(this)
    dataId = $(buttonElement).data('value')
    $.ajax({
      url: base_url+"/payment/send-receipt-email",
      type: "POST",
      data:  {
        id : dataId
      },
      dataType:'JSON',
      beforeSend : function(){
          $(buttonElement).prop('disabled',true);
      },
      success: function(data){
        if(data.status){
            $.NotificationApp.send("Message!",data.message,"top-right","rgba(0,0,0,0.2)","success")
        }else{
            $.NotificationApp.send("Message!",data.message,"top-right","rgba(0,0,0,0.2)","error")
        }
      }, error:function(jhxr,status,err){
          console.log(jhxr);
      },
      complete:function(){
          $(buttonElement).prop('disabled',false);
      }   
      });
  })
  $(document).on('click','.editPaymentButton',function(){
    let id = btoa($(this).attr('data-value'));
    $('#frontPagesModal').modal('show');
    $('#frontPagesModal .modal-content').html(` <div id="modal-preloader" class="my-2">
        <div class="modal-preloader_status">
        <div class="modal-preloader_spinner">
            <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status"></div>
            </div>
        </div>
        </div>
    </div>`);
    $.get( base_url+"/student-payments/"+id+"/edit", function( data ) {
        $('#frontPagesModal .modal-dialog').addClass('modal-lg');
        $('#frontPagesModal .modal-content').html(data);
    });
})

$(document).on('submit','#editPaymentForm',function(e){
    e.preventDefault();
    $.ajax({
      url: base_url+"/student-payments/0",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      dataType:'JSON',
      beforeSend : function(){
          $('#editPaymentButton').prop('disabled',true);
          $('#modal-preloader').css('display','inline-block');
      },
      success: function(data){
          if($.isEmptyObject(data.error)){
              if(data.status)
              {
                $('#frontPagesModal').modal('hide');
                $.NotificationApp.send("Message!",data.message,"top-right","rgba(0,0,0,0.2)","success")
                window.location.reload();
              }
          }else{
              printErrorMsg(data.error,"#frontPagesModal #editPaymentError");
          }
      }, error:function(jhxr,status,err){
          console.log(jhxr);
      },
      complete:function(){
          $('#editPaymentButton').prop('disabled',false);
          $('#modal-preloader').css('display','none');
      }   
      });
  })