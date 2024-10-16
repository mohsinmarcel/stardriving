<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Student Attendance Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <table class="table table-bordered table-sm">                      
        <tr>
            <th>Class Type</th>
            <td>{{@$student_attendance->class_type->name}}</td>
        </tr>
        <tr>
            <th>Class Module</th>
            <td>{{@$student_attendance->class_module->name}}</td>
        </tr>
        <tr>
            <th>Teacher</th>
            <td>{{@$student_attendance->teacher->full_name}}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{$student_attendance->attendance_date}}</td>
        </tr>
        <tr>
            <th>Time</th>
            <td>{{date('h:i A', strtotime($student_attendance->start_time))}} - {{date('h:i A', strtotime($student_attendance->end_time))}}</td>
        </tr>
    </table>
    <h4 class="text-center my-3">Students</h4>
    <ul class="list-group ">
        @foreach ($student_attendance->student_attendance_details as $item)
            <li class="list-group-item">{{@$item->student->student_id.'/'.$item->student->full_name}}</li>
        @endforeach
    </ul>
  </div>
  <div class="modal-footer">
    <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

