<!-- create modal -->
<div id="faculty" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Teacher Info</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img width="150" id="profile" class="img-fluid" src="<?= empty($students[0]['img']) ? site_url('/plugins/images/users/hanna.jpg') : site_url('uploads').'/'.$students[0]['img'] ?>" >
                    </div>
                </div>
                <div class="form-group m-t-20">
                    <label for="name" class="control-label">Fullname:</label>
                    <p id="name"></p>
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">Phone Number:</label>
                    <p id="phone"></p>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email Address:</label>
                   <p id="email"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>