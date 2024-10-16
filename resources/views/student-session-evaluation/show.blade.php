<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Student Strengths/Weaknesses</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Student</th>
                  <th>Teacher</th>
                  <th>Session</th>
                  <th>Date</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                <td>{{$student_evaluation->student->full_name}}</td>
                <td>{{$student_evaluation->teacher->full_name}}</td>
                <td>{{Str::title($student_evaluation->session)}}</td>
                <td>{{$student_evaluation->date}}</td>
              </tr>
          </tbody>
      </table>
      <div class="row">
          <div class="col-md-12">
              <h4 class="text-center text-uppercase">Learner</h4>
              <hr>
          </div>
          <div class="col-md-6">
              <h5 class="text-center text-uppercase">Strengths</h5>
              <ul class="list-group list-group-flush">
                  @forelse ($leaner_strength as $item)
                    <li class="list-group-item">{{$item}}</li>
                  @empty
                    <li class="list-group-item text-center">No record available</li>
                  @endforelse
              </ul>
          </div>
          <div class="col-md-6">
            <h5 class="text-center text-uppercase">Weaknesses</h5>
            <ul class="list-group list-group-flush">
                @forelse ($leaner_weakness as $item)
                    <li class="list-group-item">{{$item}}</li>
                @empty
                    <li class="list-group-item text-center">No record available</li>
                @endforelse
            </ul>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
            <h4 class="text-center text-uppercase">Instructor</h4>
            <hr>
        </div>
        <div class="col-md-6 ">
            <h5 class="text-center text-uppercase">Strengths</h5>
            <ul class="list-group list-group-flush">
                @forelse ($instructor_strength as $item)
                    <li class="list-group-item">{{$item}}</li>
                @empty
                    <li class="list-group-item text-center">No record available</li>
                @endforelse
            </ul>
        </div>
        <div class="col-md-6">
          <h5 class="text-center text-uppercase">Weaknesses</h5>
          <ul class="list-group list-group-flush">
            @forelse ($instructor_weakness as $item)
                <li class="list-group-item">{{$item}}</li>
            @empty
                <li class="list-group-item text-center">No record available</li>
            @endforelse
        </ul>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>