<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Student Exam</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="addExamError" style="display: none">
    </div>
    <form action="{{route('student-exams.store',$student->id)}}" id="addStudentExamForm" method="post">
        @csrf
        <input type="hidden" name="student_id" value="{{$student->id}}">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="exam_type">Select Exam Type</label>
                <select class="form-control" name="exam_type" id="exam_type">
                    <option value>-- Select Exam Type --</option>
                    @foreach ($exam_types as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="exam">Select Exam</label>
                <select class="form-control" name="exam" id="exam">
                    <option value>-- Select Exam --</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="exam_date">Exam Date</label>
                <input type="date" class="form-control" name="exam_date" id="exam_date">
            </div>
        </div>
        <div class="row" style="display: none" id="examQuestionsDiv">
            <div id="modal-preloader" class="my-2 col-md-12">
                <div class="modal-preloader_status">
                  <div class="modal-preloader_spinner">
                    <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status"></div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-md-12" id="listOfQuestions">
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
    <button type="submit" class="btn btn-primary" id="addStudentExamFormButton" form="addStudentExamForm">Add Exam</button>
</div>