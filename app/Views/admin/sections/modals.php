<!-- create modal -->
<div id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Create a Section</h4>
            </div>
            <form action="<?= base_url('admin/create_section') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Section Name</label>
                                <input type="text" name="name"  class="form-control"  required=""> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Section Year</label>
                                <select class="form-control" name="year">
                                    <option selected disabled>Select Section Year</option>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">School Year</label>
                        <select class="form-control" name="school_year">
                            <option selected disabled>Select School Year</option>
                        <?php
                            $date2=date('Y', strtotime('+1 Years'));
                            for($i=date('Y'); $i<$date2+5;$i++){
                                echo '<option>'.$i.'-'.($i+1).'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description:</label>
                        <textarea class="form-control" name="description" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <select class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose Subjects for this Section" name="subjects[]">
                            <optgroup label="Subjects">
                                <?php foreach($subjects as $row): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['subject_code'].' - '.$row['subject'] ?></option>
                                <?php endforeach ?>
                            </optgroup>
                        </select>
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
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Create a Section</h4>
            </div>
            <form action="<?= base_url('admin/update_section') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Section Name</label>
                                <input type="text" id="section" name="name"  class="form-control"  required=""> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Section Year</label>
                                <select class="form-control" name="year" id="grade">
                                    <option selected disabled>Select</option>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description:</label>
                        <textarea class="form-control" name="description" id="description" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <select class="select2 m-b-10 select2-multiple" id="subject_id" multiple="multiple" data-placeholder="Choose" name="subjects[]">
                            <optgroup label="Subjects">
                                <?php foreach($subjects as $row): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['subject_code'].' - '.$row['subject'] ?></option>
                                <?php endforeach ?>
                            </optgroup>
                        </select>
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
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>