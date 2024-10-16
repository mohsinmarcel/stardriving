<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Send SMS</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="alert bg-danger text-light pb-0" id="sendSmsError" style="display: none">
    </div>
    <form action="" method="post" id="sendSmsForm" class="row" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="student_id" value="{{$id}}">
        <div class="col-md-12">
            <div class="form-group">
                <label for="phone_number" class="control-label">Select Phone Number:*</label>
                <select class="form-control" name="phone_number" id="">
                    <option value>Select Phone Number</option>
                    @if ($student->phone_number_1 != null)
                    <option value="{{$student->phone_number_1}}" selected>{{$student->phone_number_1}}</option>
                    @endif
                    @if ($student->phone_number_2 != null)
                    <option value="{{$student->phone_number_2}}">{{$student->phone_number_2}}</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="message" class="control-label">Message:*</label>
                <textarea rows="5" class="form-control" id="message" name="message"></textarea>
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
    <button id="closeModal" type="button" class="btn btn-secondary btn-sm rounded small" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary btn-sm rounded small" id="sendSmsButton" form="sendSmsForm">Send SMS</button>
</div>

<!-- Template Buttons on Separate Line -->
<div class="modal-footer">
    @foreach($template as $temp) 
        <button type="button" class="btn btn-info btn-sm rounded small" style="font-size: 10px;" onclick="loadTemplate('{{$temp->message}}')"> {{$temp->name}}</button>
    @endforeach
</div>

<script>
    function loadTemplate(template) {
        document.getElementById('message').value = template;
    }
</script>
