<div id="delete-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-wrong h1"></i>
                    <h4 class="mt-2">Alert!</h4>
                    <p class="mt-3">Are you sure you want to delete this record?</p>
                    <form action="" method="post" id="deleteRecordForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light my-2">Continue</button>
                    </form>
                    <br>
                    <button type="button" class="btn btn-link mb-2 text-light" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>