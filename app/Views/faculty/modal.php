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

<!-- create modal -->
<div id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Create</h4> </div>
            <form action="<?= site_url('faculty/create-clearance') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject_code" class="control-label">Student</label>
                        <select class="form-control select2" name="student_id">
                            <option value="">Select Student</option>
                            <optgroup label="Students">
                                <?php foreach($students as $row):?>
                                    <option value="<?= $row['id'] ?>"><?= $row['firstname'].' '.$row['lastname'] ?></option>
                                <?php endforeach ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject_code" class="control-label">Title:</label>
                        <input type="text" class="form-control" name="title" required="">
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
                <h4 class="modal-title">Edit Clearance</h4> </div>
            <form action="<?= site_url('faculty/updateClearance') ?>" method="POST">
                <div class="modal-body">
                <div class="form-group">
                    <label for="subject_code" class="control-label">Student</label>
                        <select class="form-control select2" name="student_id" id="student_id">
                            <option value="">Select Student</option>
                            <optgroup label="Students">
                                <?php foreach($students as $row):?>
                                    <option value="<?= $row['id'] ?>"><?= $row['firstname'].' '.$row['lastname'] ?></option>
                                <?php endforeach ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject_code" class="control-label">Title:</label>
                        <input type="text" class="form-control" name="title" required id="title">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description:</label>
                        <textarea class="form-control" name="description" required id="desc"></textarea>
                    </div>
                    <div class="form-group m-b-30">
                        <select class="form-control" name="status" id="status">
                            <option value="Active">Active</option>
                            <option value="Done">Done</option>
                            <option value="Inactive">Inactive</option>
                        </select>
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