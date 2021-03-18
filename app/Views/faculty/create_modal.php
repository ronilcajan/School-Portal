<!-- create modal -->
<div id="activity" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Create Activity</h4>
            </div>
            <form action="<?= site_url('faculty/create-activity') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Activity Name</label>
                                <input type="text" name="activity"  class="form-control"  required=""> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <textarea class="form-control" name="description" required=""  row="5"></textarea>
                    </div>
                    <div class="form-group">
                            <label for="input-file-now-custom-3">Avatar</label>
                            <input type="file" name="file" id="input-file-now-custom-3" class="dropify" data-height="200" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" ><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit modal -->
<div id="edit-activity" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Activity</h4>
            </div>
            <form action="<?= site_url('faculty/update-activity') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Activity Name</label>
                                <input type="text" name="activity" id="title"  class="form-control"  required=""> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <textarea class="form-control" name="description" id="desc" required="" row="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Status</label>
                        <select class="form-control" required name="status" id="status">
                            <option val=''>Select Status</option>
                            <option val='1' selected>Active</option>
                            <option val='0'>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="input-file-now-custom">Avatar</label>
                            <input type="file" name="file" id="input-file-now-custom" data-default-file="" class="dropify" data-height="200" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-success" ><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>