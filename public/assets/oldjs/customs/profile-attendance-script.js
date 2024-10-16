$(document).on('click','#deleteButton',function(){
    let dataId = $(this).attr('data-value')
    route = base_url+'/student-attendance/'+dataId
    $('#deleteRecordForm').attr('action',route)
    $('#delete-alert-modal').modal('show')
    // window.location.reload();
})

$('#addStudentAttendance').click(function (e) { 
    let dataId = $(this).attr('data-value')
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
    $.get( base_url+"/attendance/create/"+dataId, function( data ) {
        $('#frontPagesModal .modal-dialog').addClass('modal-lg');
        $('#frontPagesModal .modal-content').html(data);
        $('#student, #teacher,#class_type,#class_module').select2();
    });
});

$(document).on('submit','#attendanceForm',function(e){
e.preventDefault();
$.ajax({
url: base_url+"/student-attendance",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
dataType:'JSON',
beforeSend : function(){   
    $('#storeAttendanceBtn').prop('disabled',true);
    $('#modal-preloader').css('display','inline-block');
},
success: function(data)
{
    if($.isEmptyObject(data.error)){
        if(data.status)
        {
          $('#frontPagesModal').modal('hide');
          $.NotificationApp.send("Message!",data.success,"top-right","rgba(0,0,0,0.2)","success")
          window.location.reload();
        }
    }else{
        printErrorMsg(data.error,"#frontPagesModal #attendanceCreateError");
    }
}, error:function(jhxr,status,err){
    console.log(jhxr);
},
complete:function(){
    $('#storeAttendanceBtn').prop('disabled',false);
    $('#modal-preloader').css('display','none');
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

$(document).on('change', '#class_type', function () {
    var class_type = $('#class_type').val()
    if(class_type == '2'){
        $("#start_time").val('');
        $("#end_time").attr({'value': '--:--'})
        $(".select").val('').change();
        $("#student").removeAttr("multiple")
    }
    else if(class_type == '1'){
        $("#start_time").val('');
        $("#end_time").attr({'value': '--:--'})
        $(".select").val('').change();
        $("#student").prop("multiple", true)
    }
})

$(document).on('change', '#start_time', function () {
getEndTime()
})
