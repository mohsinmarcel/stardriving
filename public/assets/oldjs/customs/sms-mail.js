$('#sendSmsbtn').click(function (e) {
    let dataId = $(this).data('value');
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
    $.get(base_url + '/sms-mailing/sms/' + dataId, function (data) {
        $('#frontPagesModal .modal-content').html(data);
    });
});

$(document).on('submit', '#sendSmsForm', function (e) {
    e.preventDefault();
    let formData = new FormData(this)
    $.ajax({
        url: base_url + '/sms-mailing/sms',
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function () {
            $('#sendSmsButton').prop('disabled', true);
            $('#modal-preloader').css('display', 'inline-block');
        },
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                if (data.status) {
                    $('#frontPagesModal').modal('hide');
                    $.NotificationApp.send("Message!", data.message, "top-right", "rgba(0,0,0,0.2)", "success")
                }
            } else {
                printErrorMsg(data.error, "#frontPagesModal #sendSmsError");
            }
        },
        error: function (jhxr, status, err) {
            console.log(jhxr);
        },
        complete: function () {
            $('#sendSmsButton').prop('disabled', false);
            $('#modal-preloader').css('display', 'none');
        }
    });
})


$('#sendEmailBtn').click(function (e) {
    let dataId = $(this).data('value');
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
    $.get(base_url + '/sms-mailing/mail/' + dataId, function (data) {
        $('#frontPagesModal .modal-dialog').addClass('modal-lg');
        $('#frontPagesModal .modal-content').html(data);
        $("#message").summernote({
            height: 400,
            tabsize: 4,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']]
            ]
        })
    });
});

$(document).on('submit', '#sendEmailForm', function (e) {
    e.preventDefault();
    let formData = new FormData(this)
    $.ajax({
        url: base_url + '/sms-mailing/mail',
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function () {
            $('#sendEmailButton').prop('disabled', true);
            $('#modal-preloader').css('display', 'inline-block');
        },
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                if (data.status) {
                    $('#frontPagesModal').modal('hide');
                    $.NotificationApp.send("Message!", data.message, "top-right", "rgba(0,0,0,0.2)", "success")
                }
            } else {
                printErrorMsg(data.error, "#frontPagesModal #sendEmailError");
            }
        },
        error: function (jhxr, status, err) {
            console.log(jhxr);
        },
        complete: function () {
            $('#sendEmailButton').prop('disabled', false);
            $('#modal-preloader').css('display', 'none');
        }
    });
})
$(document).on('change', '.attachment-input', function () {
    $('#mail-evaluation-input').hide()
    $('#mail-exam-input').hide()
    if ($(this).val() == 'exam') {
        $('#mail-exam-input').show()
    }
    if ($(this).val() == 'self_evaluation') {
        $('#mail-evaluation-input').show()
    }
})
