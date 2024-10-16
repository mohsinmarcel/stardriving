<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
  <div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="sendEmailError" style="display: none">
    </div>
    <form action="" method="post" id="sendEmailForm" class="row" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="student_id" value="{{$id}}">
        <div class="col-md-12">
            <div class="form-group">
                <label for="subject" class="control-label" >Subject:</label>
                <input type="text" id="subject" placeholder="Enter Subject" class="form-control" name="subject">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="message" class="control-label" >Message:</label>
                <textarea id="message" name="message"></textarea>
            </div>
        </div>
        <div class="col-md-12">
          <div class="form-group mb-3">
            <label for="">Select Attachment</label>
            <br>
            @php
              $attachments = ['contract', 'medical', 'exam', 'exam_declaration', 'self_evaluation', 'final_certificate', 'phase_one_certificate', 'invoice', 'attendance', 'additional_document'];
            @endphp
            <select class="form-control attachment-input" name="attachment" id="attachment">
              <option value>--Select Attachment--</option>
              @foreach ($attachments as $key => $item)
                <option value="{{$item}}">{{Str::title(str_replace('_',' ',$item))}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-12" style="display:none" id="additional-document-input">
          <div class="form-group">
            <label for="additionalDocument" class="control-label" >Additional Document:</label>
            <input type="file" id="additionalDocument" name="additionalDocument">
          </div>
        </div>
        <div class="col-md-12" style="display:none" id="mail-exam-input">
          <div class="form-group">
            <label for="message" class="control-label" >Select Exam:*</label>
            <select class="form-control" name="exam" id="">
              <option value>--Select Exam--</option>
              @foreach ($exams as $item)
                  <option value="{{$item->id}}">{{$item->exam->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-12" style="display:none" id="mail-evaluation-input">
          <div class="form-group">
            <label for="message" class="control-label" >Select Evaluation:*</label>
            <select class="form-control" name="evaluation" id="">
              <option value>--Select Evaluation--</option>
              @foreach ($evaluations as $item)
                  <option value="{{$item->id}}">{{$item->session}}</option>
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
    <button type="submit" class="btn btn-primary" id="sendEmailButton" form="sendEmailForm">Send Email</button>
</div>

<!-- Template Buttons on Separate Line -->
<div class="modal-footer">
    @foreach($template as $temp) 
        <button type="button" class="btn btn-info btn-sm rounded small" style="font-size: 10px;" onclick="loadTemplate('{{$temp->message}}')"> {{$temp->name}}</button>
    @endforeach
</div>


<script>
  document.getElementById('attachment').addEventListener('change', function() {
    var additionalDocumentInput = document.getElementById('additional-document-input');
    if (this.value === 'additional_document') {
      additionalDocumentInput.style.display = 'block';
    } else {
      additionalDocumentInput.style.display = 'none';
    }
  });

  function loadTemplate(template) {
    $('#message').summernote('code', template);
    }
</script>