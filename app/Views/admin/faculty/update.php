<?= $this->extend('admin/base') ?>

<?= $this->section('admin') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <?php if (session()->get('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->get('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>
            <?php $facultySection = $sections->getRowArray(); ?>
            <div class="panel panel-info">
                <div class="panel-heading">Edit Faculty Detials</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="<?= site_url('admin/update-faculty') ?>" method="post">
                            <div class="form-body">
                                <h3 class="box-title">Faculty Info</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>
                                                <?php if($faculty['status'] == 1):?>
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">InActive</option>
                                                <?php else: ?>
                                                    <option value="1">Active</option>
                                                    <option value="0" selected>InActive</option>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Subjects</label>
                                            <select class="form-control" tabindex="1" name="subject_id" id="subject_id" required onchange="selectSection(this)">
                                                <option disabled selected>Assign a Subject</option>
                                                <?php foreach($subjects as $row):?>
                                                    <?php if($facultySection['id']==$row['id']):?>
                                                    <option value="<?= $row['id'] ?>" selected><?= $row['subject_code'].' - '.$row['subject'] ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['subject_code'].' - '.$row['subject'] ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Sections</label>
                                            <select class="select2 select2-multiple" multiple="multiple" name="group_section_id[]" id="group_section_id" required>
                                                <option disabled selected>Assign a Section</option>
                                                <?php foreach($sections->getResultArray() as $row):?>
                                                    <option value="<?= $row['group_id'] ?>" selected>Grade <?= $row['section_year'].' - '.$row['section_name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" id="firstName" name="firstname" class="form-control" placeholder="Firstname" required value="<?= $faculty['firstname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" id="lastName" name="lastname" class="form-control" placeholder="Lastname" required value="<?= $faculty['lastname'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Gender</label>
                                            <select class="form-control" name="gender" required>
                                                <option value="M" <?= $faculty['gender']=='M' ? 'selected' : null ?>>Male</option>
                                                <option value="F" <?= $faculty['gender']=='F' ? 'selected' : null ?>>Female</option>
                                            </select></div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Date of Birth</label>
                                            <input type="text" class="form-control mydatepicker" name="birthdate" placeholder="dd/mm/yyyy" required value="<?= $faculty['birthdate'] ?>"> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <input type="text" id="Phone" name="phone" class="form-control" placeholder="Phone" required value="<?= $faculty['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email Address</label>
                                            <input type="email" id="Email" name="email" class="form-control" placeholder="Email" required value="<?= $faculty['email'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <h3 class="box-title m-t-40">Login Info</h3>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email Address</label>
                                            <input type="email" class="form-control" placeholder="faculty ID" required value="<?= $faculty['email'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Temporary Password</label>
                                            <input type="password" id="conf-password" name="pass" class="form-control" placeholder="Password" autocomplete="off">
                                            <span toggle="#conf-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <h3 class="box-title m-t-40">Address</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label>Street</label>
                                            <input type="text" name="street" class="form-control" required value="<?= $faculty['street'] ?>"> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City/Municipality</label>
                                            <input type="text" name="city" class="form-control" required value="<?= $faculty['city'] ?>"> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <input type="text" name="province" class="form-control" required value="<?= $faculty['province'] ?>"> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" name="postal" class="form-control" required value="<?= $faculty['postal'] ?>"> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="hidden" name="id" class="form-control" value="<?= $faculty['id'] ?>">
                                <input type="hidden" name="oldEmail" class="form-control" value="<?= $faculty['email'] ?>">
                                <input type="hidden" name="group_section" class="form-control" value="<?= $facultySection['group_id'] ?>">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
