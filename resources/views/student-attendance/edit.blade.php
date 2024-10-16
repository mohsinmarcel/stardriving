<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Student Attendance</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="attendanceUpdateError" style="display: none">
    </div>
    <form action="" class="row" method="POST" id="updateAttendanceForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="attendance_id" id="attendance_id" value="{{$student_attendance->id}}">
            {{-- <div class="col-md-12">
                <div class="form-group">
                    <label for="student" class="control-label" >Student</label>
                    <input type="text" id="student" class="form-control" value="{{$student_attendance->student->student_id.' / '.$student_attendance->student->full_name}}" readonly >
                </div>
            </div> --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="class_type" class="control-label" >Class Type:*</label>
                    <select id="class_type" class="form-control" name="class_type">
                        <option value>-- Select Class Type --- </option>
                        @foreach ($class_types as $item)
                            <option value="{{$item->id}}" {{$student_attendance->class_type_id == $item->id?'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="class_module" class="control-label" >Class Module:*</label>
                    <select id="class_module" class="form-control" name="class_module">
                        <option value>-- Select Class Module --- </option>
                        @foreach ($modules as $item)
                            <option value="{{$item->id}}" {{$student_attendance->class_module_id == $item->id?'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="attendance_date" class="control-label" >Attendance Date:*</label>
                    <input type="date" id="attendance_date" class="form-control" name="attendance_date" value="{{$student_attendance->attendance_date}}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="gender" class="control-label" >Attendance Time:*</label>
                    <div class="input-daterange input-group">
                        <input class="form-control" id="start_time" name="start_time" type="time" value="{{$student_attendance->start_time}}">
                        <span class="input-group-addon bg-info b-0 text-white" style="padding: 8px 10px;">To</span>
                        <input class="form-control " id="end_time" name="end_time" type="time" value="{{$student_attendance->end_time}}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="student" class="control-label" >Select Student:*</label>
                    <select id="student" class="form-control select @error('student') is-invalid @enderror" name="student[]" @if ($student_attendance->class_type_id == 1)
                        multiple="multiple"
                    @endif>
                        <option value>-- Select Student --- </option>
                        @foreach ($students as $item)
                            <option value="{{$item->id}}" {{in_array($item->id,$student_marked) ?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
                        @endforeach
                    </select>
                    @error('student')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="teacher" class="control-label" >Select Teacher:*</label>
                    <select id="teacher" class="form-control" name="teacher">
                        <option value>-- Select Teacher --- </option>
                        @foreach ($teachers as $item)
                            <option value="{{$item->id}}" {{$student_attendance->teacher_id == $item->id?'selected':''}}>{{$item->full_name}}</option>
                        @endforeach
                    </select>
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
    <button type="submit" class="btn btn-primary" id="updateAttendanceBtn" form="updateAttendanceForm">Update</button>
</div>

