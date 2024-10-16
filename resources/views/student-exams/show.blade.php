<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Student Exam Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
      <div class="row mb-3">
        <div class="col-md-4 ">
            <h5>Exam Name:</h5>
            <p>{{$student_exam->exam->name}}</p>
          </div>
          <div class="col-md-4 ">
            <h5>Exam Date:</h5>
            <p>{{$student_exam->exam_date}}</p>
          </div>
          <div class="col-md-4 ">
            <h5>Obtained Marks:</h5>
            <p>{{$student_exam->obtained_marks}}</p>
          </div>
          <div class="col-md-4 ">
            <h5>Total Marks:</h5>
            <p>{{$student_exam->total_marks}}</p>
          </div>
          <div class="col-md-4 ">
            <h5>Percentage:</h5>
            <p>{{$student_exam->percentage}}</p>
          </div>
      </div>
    <table class="table dt-responsive nowrap w-100 table-sm">
        <thead>
        <tr>
            <th>Question</th>
            <th>Answer</th>
            <th>Is Correct Answer</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($student_exam->student_exam_questions as $items)
        <tr>
            <td>{{$items->exam_question->question_no}}</td>
            <td>{{$items->answer}}</td>
            <td>{{$items->correct?'correct':'incorrect'}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>