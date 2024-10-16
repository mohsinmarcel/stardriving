<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Student Exam</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="addExamError" style="display: none">
    </div>
    <form action="{{route('student-exams.update')}}" id="updateStudentExamForm" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="student_id" value="{{$student_exam->student_id}}">
        <input type="hidden" name="id" value="{{$student_exam->id}}">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="exam_type">Select Exam Type</label>
                <select class="form-control" name="exam_type" id="exam_type">
                    <option value>-- Select Exam Type --</option>
                    @foreach ($exam_types as $item)
                        <option value="{{$item->id}}" {{@$student_exam->exam->exam_type_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="exam">Select Exam</label>
                <select class="form-control" name="exam" id="exam">
                    <option value>-- Select Exam --</option>
                    @foreach ($exams as $item)
                        <option value="{{$item->id}}" {{@$student_exam->exam->id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="exam_date">Exam Date</label>
                <input type="date" class="form-control" name="exam_date" id="exam_date" value="{{$student_exam->exam_date}}">
            </div>
        </div>
        <div class="row"  id="examQuestionsDiv">
            <div id="modal-preloader" class="my-2 col-md-12" style="display: none">
                <div class="modal-preloader_status">
                  <div class="modal-preloader_spinner">
                    <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status"></div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-md-12" id="listOfQuestions">
                <table class="table dt-responsive nowrap w-100 table-sm">
                    <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (@$student_exam->student_exam_questions)
                            @foreach ($student_exam->student_exam_questions as $question)
                                <tr>
                                    <td>
                                        {{'Question No: '.$question->exam_question->question_no}}
                                        <input type="hidden" name="questions_no[]" value="{{$question->exam_question->question_no}}">
                                    </td>
                                    <td>
                                        <div class="form-group mb-0">
                                            <select name="answers[]" id="" class="form-control">
                                                <option value>--Select Answer--</option>
                                                @foreach ($exam_options as $item)
                                                    <option value="{{$item->option}}" {{$item->option == $question->answer ? 'selected' :''}}>{{$item->option}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
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
    <button type="submit" class="btn btn-primary" id="updateStudentExamFormButton" form="updateStudentExamForm">Update Exam</button>
</div>