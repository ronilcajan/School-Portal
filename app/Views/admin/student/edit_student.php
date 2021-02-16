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
            <div class="panel panel-info">
                <div class="panel-heading">Create Student</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="<?= site_url('admin/editStudent') ?>" method="post">
                            <div class="form-body">
                                <h3 class="box-title">Student Info</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Student ID</label>
                                            <input type="text" name="student_id" class="form-control" onkeyup="studentID(this)" placeholder="Student ID" required value="<?= $student['student_ID'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Section</label>
                                            <select class="form-control select2" name="section_id">
                                                <option value="">Assign Section</option>
                                                <optgroup label="Sections">
                                                    <?php foreach($section as $row):?>
                                                        <?php if($student['section_id'] == $row['id']): ?>
                                                            <option value="<?= $row['id'] ?>" selected>Grade <?= $row['section_year'].' - '.$row['section_name'] ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $row['id'] ?>">Grade <?= $row['section_year'].' - '.$row['section_name'] ?></option>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" id="firstName" name="firstname" class="form-control" placeholder="Firstname" required value="<?= $student['firstname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" id="lastName" name="lastname" class="form-control" placeholder="Lastname" required value="<?= $student['lastname'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Gender</label>
                                            <select class="form-control" name="gender" required value="<?= $student['gender'] ?>">
                                                <option value="M" <?= $student['gender']=='M' ? 'selected' : null ?>>Male</option>
                                                <option value="F" <?= $student['gender']=='F' ? 'selected' : null ?>>Female</option>
                                            </select></div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Date of Birth</label>
                                            <input type="text" class="form-control mydatepicker" name="birthdate" placeholder="dd/mm/yyyy" required value="<?= $student['birthday'] ?>"> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <input type="text" id="Phone" name="phone" class="form-control" placeholder="Phone" required value="<?= $student['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email Address</label>
                                            <input type="email" id="Email" name="email" class="form-control" placeholder="Email" required value="<?= $student['email'] ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <h3 class="box-title m-t-40">Address</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label>Street</label>
                                            <input type="text" name="street" class="form-control" required value="<?= $student['street'] ?>"> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City/Municipality</label>
                                            <input type="text" name="city" class="form-control" required value="<?= $student['city'] ?>"> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <input type="text" name="province" class="form-control" required value="<?= $student['province'] ?>"> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" name="postal" class="form-control" required value="<?= $student['postal'] ?>"> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <h3 class="box-title m-t-40">Family Background</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's name</label>
                                            <input type="text" name="f_name" class="form-control" required value="<?= $family['f_name'] ?>"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="f_phone" class="form-control" required value="<?= $family['f_phone'] ?>"> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" required row="5" name='f_address'><?= $family['f_address'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's name</label>
                                            <input type="text" name="m_name" class="form-control" required value="<?= $family['m_name'] ?>"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="m_phone" class="form-control" required value="<?= $family['m_phone'] ?>"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" required row="5" name='m_address'><?= $family['m_address'] ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="box-title m-t-40">Login Info</h3>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Student ID:</label>
                                            <input type="text" id="student_id" class="form-control" placeholder="Student ID" required value="<?= $student['student_ID'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Temporary Password</label>
                                            <input type="password" name="pass" class="form-control" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                            <div class="form-actions">
                                <input type="hidden" name="id" value="<?= $student['id'] ?>">
                                <input type="hidden" name="family_id" value="<?= $family['id'] ?>">
                                <input type="hidden" name="studID" value="<?= $student['student_ID'] ?>">
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
