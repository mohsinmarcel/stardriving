<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert bg-danger text-light pb-0" id="modelError" style="display: none">
          </div>
          <form action="" method="post" id="changePassword">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Old Password</label>
              <input type="password" name="old_password" id="oldpassword" class="form-control">
            </div>
            <div class="form-group">
              <label for="">New Password</label>
              <input type="password" name="new_password" id="newpassword" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Confirm Password</label>
              <input type="password" name="new_password_confirmation" id="newpassword_confirmation" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="changePassword">Edit Profile</button>
        </div>
      </div>
    </div>
  </div>