<!-- create modal -->
<div id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Create Subject</h4> </div>
            <form action="<?= base_url('admin/create-subject') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject_code" class="control-label">Subject Code:</label>
                        <input type="text" class="form-control" name="subject_code" required="">
                    </div>
                    <div class="form-group">
                        <label for="subject" class="control-label">Subject Name:</label>
                        <input type="text" class="form-control" name="subject" required="">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description:</label>
                        <textarea class="form-control" name="description" required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button class="btn btn-info waves-effect waves-light" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit modal -->
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Subject</h4> </div>
            <form action="<?= base_url('admin/updateSubject') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject_code" class="control-label">Subject Code:</label>
                        <input type="text" class="form-control" name="subject_code" id="subject_code" required="">
                    </div>
                    <div class="form-group">
                        <label for="subject" class="control-label">Subject Name:</label>
                        <input type="text" class="form-control" name="subject" id="subject" required="">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description:</label>
                        <textarea class="form-control" name="description" id="description" required=""></textarea>
                    </div>
                    <div class="form-group m-b-30">
                        <div class="col-md-6 p-l-0 active">
                            <input type="radio" class="check" name="status" value="1" checked data-radio="iradio_line-green" data-label="Active">
                        </div>
                        <div class="col-md-6 p-r-0">
                            <input type="radio" class="check" name="status" value="0" id="inactive" data-radio="iradio_line-red" data-label="Inactive">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer m-t-30">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button class="btn btn-info waves-effect waves-light" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>