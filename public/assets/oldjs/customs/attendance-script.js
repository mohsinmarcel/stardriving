$(document).on('click', '#deleteButton', function () {
    let dataId = $(this).attr('data-value')
    // let route = '{{route("student-attendance.destroy",0)}}'
    // route = route.replace(/student-attendance\/\d/g,'student-attendance/'+dataId)
    $('#deleteRecordForm').attr('action', '/student-attendance/' + dataId)
    $('#delete-alert-modal').modal('show')
})

$('#AddAttendanceBtn').click(function (e) {
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
    $.get("/student-attendance/create", function (data) {
        $('#frontPagesModal .modal-dialog').addClass('modal-lg');
        $('#frontPagesModal .modal-content').html(data);
        $('#student, #teacher,#class_type,#class_module').select2();
    });
});

$(document).on('submit', '#attendanceForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: "/student-attendance",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function () {
            $('#storeAttendanceBtn').prop('disabled', true);
            $('#modal-preloader').css('display', 'inline-block');
        },
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                if (data.status) {
                    $('#frontPagesModal').modal('hide');
                    $.NotificationApp.send("Message!", data.success, "top-right", "rgba(0,0,0,0.2)", "success")
                    window.location.reload();
                }
            } else {
                printErrorMsg(data.error, "#frontPagesModal #attendanceCreateError");
            }
        },
        error: function (jhxr, status, err) {
            console.log(jhxr);
        },
        complete: function () {
            $('#storeAttendanceBtn').prop('disabled', false);
            $('#modal-preloader').css('display', 'none');
        }
    });
});

function getEndTime() {
    var start = $('#start_time').val()
    let class_type = $('#class_type').val()
    let hours = 0
    if (class_type == '1') {
        hours = 2
    } else if (class_type == '2') {
        hours = 1
    } else {
        return;
    }
    let d = new Date("2022-01-01 " + start)
    d.setHours(d.getHours() + hours)
    let h = String(d.getHours()).padStart(2, '0') 
    let m = String(d.getMinutes()).padStart(2, '0')
    console.log(h + ':' + m);
    $('#end_time').attr({'value': h + ':' + m})
}

$(document).on('click','.editButton',function(){
    dataId = $(this).data('value')
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
    $.get("/student-attendance/"+dataId+"/edit", function (data) {
        $('#frontPagesModal .modal-dialog').addClass('modal-lg');
        $('#frontPagesModal .modal-content').html(data);
        $('#student,#teacher,#class_type,#class_module').select2();
    });
})

$(document).on('submit', '#updateAttendanceForm', function (e) {
    e.preventDefault();
    let dataId = $('#attendance_id').val();
    $.ajax({
        url: "/student-attendance/"+dataId,
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function () {
            $('#updateAttendanceBtn').prop('disabled', true);
            $('#modal-preloader').css('display', 'inline-block');
        },
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                if (data.status) {
                    $('#frontPagesModal').modal('hide');
                    $.NotificationApp.send("Message!", data.success, "top-right", "rgba(0,0,0,0.2)", "success")
                    window.location.reload();
                }
            } else {
                printErrorMsg(data.error, "#frontPagesModal #attendanceUpdateError");
            }
        },
        error: function (jhxr, status, err) {
            console.log(jhxr);
        },
        complete: function () {
            $('#updateAttendanceBtn').prop('disabled', false);
            $('#modal-preloader').css('display', 'none');
        }
    });
});

$(document).on('change', '#class_type', function () {
    var class_type = $('#class_type').val()
    if(class_type == '2'){
        $("#start_time").val('');
        $("#end_time").attr({'value': '--:--'})
        $("#student").prop("multiple", false)
        $(".select").val('').change();
    }
    else if(class_type == '1'){
        $("#start_time").val('');
        $("#end_time").attr({'value': '--:--'})
        $("#student").prop("multiple", true)
        $(".select").val('').change();
    }
})

$(document).on('change', '#start_time', function () {
    getEndTime();
})

$(document).on('click','.viewButton',function(){
    dataId = $(this).data('value')
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
    $.get("/student-attendance/"+dataId, function (data) {
        // $('#frontPagesModal .modal-dialog').addClass('modal-lg');
        $('#frontPagesModal .modal-content').html(data);
    });
})