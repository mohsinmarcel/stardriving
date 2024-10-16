<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Student Attendance</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="attendanceCreateError" style="display: none">
    </div>
    <form action="{{route('student-attendance.store')}}" class="row" method="POST" id="attendanceForm" enctype="multipart/form-data">
        @csrf
            <div class="col-md-12">
                <div class="form-group">
                    <label for="class_type" class="control-label" >Class Type:*</label>
                    <select id="class_type" class="form-control @error('class_type') is-invalid @enderror" name="class_type">
                        <option value>-- Select Class Type --- </option>
                        @foreach ($class_types as $item)
                            <option value="{{$item->id}}" {{old('class_type') == $item->id?'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('class_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="class_module" class="control-label" >Class Module:*</label>
                    <select id="class_module" class="form-control @error('class_module') is-invalid @enderror" name="class_module">
                        <option value>-- Select Class Module --- </option>
                    </select>
                    @error('class_module')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="attendance_date" class="control-label" >Attendance Date:*</label>
                    <input type="date" id="attendance_date" class="form-control @error('attendance_date') is-invalid @enderror" name="attendance_date" value="{{old('attendance_date')}}">
                    @error('attendance_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="gender" class="control-label" >Attendance Time:*</label>
                    <div class="input-daterange input-group">
                        <input class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" type="time" value="{{old('start_time')}}">
                        <span class="input-group-addon bg-info b-0 text-white" style="padding: 8px 10px;">To</span>
                        <input class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" type="time" value="{{old('end_time')}}">
                    </div>
                    @error('start_time')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('end_time')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="student" class="control-label" >Select Student:*</label>
                    <select id="student" class="form-control select @error('student') is-invalid @enderror" name="student[]" multiple="multiple">
                        {{-- <option value>-- Select Student --- </option> --}}
                        @foreach ($students as $item)
                            <option value="{{$item->id}}" {{old('student') == $item->id?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
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
                    <select id="teacher" class="form-control @error('teacher') is-invalid @enderror" name="teacher">
                        <option value>-- Select Teacher --- </option>
                        @foreach ($teachers as $item)
                            <option value="{{$item->id}}" {{old('teacher') == $item->id?'selected':''}}>{{$item->full_name}}</option>
                        @endforeach
                    </select>
                    @error('teacher')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
    <button type="submit" class="btn btn-primary" id="storeAttendanceBtn" form="attendanceForm">Add Attendance</button>
</div>

