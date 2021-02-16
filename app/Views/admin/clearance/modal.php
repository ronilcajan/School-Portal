<!-- create modal -->
<div id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Create</h4> </div>
            <form action="<?= base_url('admin/create-clearance') ?>" method="POST">
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
            <form action="<?= base_url('admin/clearance/updateClearance') ?>" method="POST">
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