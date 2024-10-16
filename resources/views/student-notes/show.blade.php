<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Student Note</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <p class="text-justify" style="word-wrap: break-word;">{{$studentNote->description}}</p>
  </div>
  <div class="modal-footer">
    <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>