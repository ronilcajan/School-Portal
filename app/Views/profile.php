<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <?php if (session()->get('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= session()->get('error') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->get('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <!-- .row -->
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg"> 
                    <a class="btn default btn-outline image-popup-vertical-fit" href="<?= empty($profile['cover']) ? site_url('/plugins/images/large/img1.jpg') : site_url('uploads').'/'.$profile['cover'] ?>">
                        <img width="100%" alt="user" src="<?= empty($profile['cover']) ? site_url('/plugins/images/large/img1.jpg') : site_url('uploads').'/'.$profile['cover'] ?>"> 
                    </a>
                </div>
                <div class="user-btm-box">
                <?php if(session()->get('user_type')=='student'): ?>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Section</strong>
                            <p><?= empty($section['section_name']) ? 'Section' : 'Grade '.$section['section_year'].' - '.$section['section_name'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>ID Number</strong>
                            <p><?= empty($profile['student_ID']) ? 'my ID' : $profile['student_ID'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Name</strong>
                            <p><?= empty($profile['firstname']) ? 'Name' : $profile['firstname'].' '.$profile['lastname'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>Birthdate</strong>
                            <p><?= empty($profile['birthday']) ? 'my ID' : date('F d, Y', strtotime($profile['birthday'])) ?></p>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Name</strong>
                            <p><?= empty($profile['firstname']) ? 'Name' : $profile['firstname'].' '.$profile['lastname'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>Birthdate</strong>
                            <p><?= empty($profile['birthdate']) ? 'Birthday' : date('F d, Y', strtotime($profile['birthdate'])) ?></p>
                        </div>
                    </div>
                    <?php endif ?>
                    
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Email ID</strong>
                            <p><?= empty($profile['email']) ? 'Email' : $profile['email'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>Phone</strong>
                            <p><?= empty($profile['phone']) ? '+123 456 789' : $profile['phone'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-12"><strong>Address</strong>
                            <p><?= empty($profile['street']) ? 'Address here...' : ucwords($profile['street'].','.$profile['city'].','.$profile['province'].','.$profile['postal']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <!-- .tabs -->
                <ul class="nav nav-tabs tabs customtab">
                    <li class="tab active">
                        <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Personal Info</span> </a>
                    </li>
                    <?php if(session()->get('user_type')=='student'): ?>
                    <li class="tab">
                        <a href="#family" data-toggle="tab" aria-expanded="false"> 
                        <span class="visible-xs"><i class="fa fa-users"></i></span> <span class="hidden-xs">Family Info</span> </a>
                    </li>
                    <?php endif ?>
                    <li class="tab">
                        <a href="#change_photo" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-file-image-o"></i></span> <span class="hidden-xs">Change Profile</span> </a>
                    </li>
                    <li class="tab">
                        <a href="#change_pass" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Account Details</span> </a>
                    </li>
                </ul>
                <!-- /.tabs -->
                <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                        <form class="form-horizontal form-material" method="post" action="<?= site_url('update-profile') ?>">
                            <div class="form-group">
                                <label class="col-md-12">Firstname</label>
                                <div class="col-md-12">
                                    <input type="text" name="firstname" required value="<?= empty($profile['firstname']) ? 'firstname' : $profile['firstname'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Lastname</label>
                                <div class="col-md-12">
                                    <input type="text" name="lastname" required value="<?= empty($profile['lastname']) ? 'lastname' : $profile['lastname'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Birthdate</label>
                                <div class="col-md-12">
                                    <input type="text" name="birthday" required value="<?= session()->get('user_type')=='student' ? $profile['birthday'] : $profile['birthdate'] ?>" class="form-control form-control-line mydatepicker"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Gender</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="gender" required>
                                        <option value="M" <?= $profile['gender']=='M' ? 'selected' : null ?>>Male</option>
                                        <option value="F" <?= $profile['gender']=='F' ? 'selected' : null ?>>Female</option>
                                    </select></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="text" name="email" required value="<?= empty($profile['email']) ? 'Email' : $profile['email'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" name="phone" required value="<?= empty($profile['phone']) ? 'Phone' : $profile['phone'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <hr>
                            <p class="m-t-20 m-b-20"><b>Address Information</b></p>
                            <div class="form-group">
                                <label class="col-md-12">Street</label>
                                <div class="col-md-12">
                                    <input name="street" required class="form-control form-control-line" value="<?= empty($profile['street']) ? 'street' : $profile['street'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">City</label>
                                <div class="col-md-12">
                                    <input name="city" required class="form-control form-control-line" value="<?= empty($profile['city']) ? 'city' : $profile['city'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Province</label>
                                <div class="col-md-12">
                                    <input name="province" required class="form-control form-control-line" value="<?= empty($profile['province']) ? 'province' : $profile['province'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Postal</label>
                                <div class="col-md-12">
                                    <input name="postal" required class="form-control form-control-line" value="<?= empty($profile['postal']) ? 'postal' : $profile['postal'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="hidden" name='id' value="<?= $profile['id'] ?>">
                                    <button class="btn btn-success" type="submit">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php if(session()->get('user_type')=='student'): ?>
                    <div class="tab-pane" id="family">
                        <form class="form-horizontal form-material" method="post" action="<?= site_url('update-family') ?>">
                            <div class="form-group">
                                <label class="col-md-12">Father's name</label>
                                <div class="col-md-12">
                                    <input type="text" name="f_name" required value="<?= empty($family['f_name']) ? null : $family['f_name'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No.</label>
                                <div class="col-md-12">
                                    <input type="text" name="f_phone" required value="<?= empty($family['f_phone']) ? null : $family['f_phone'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" required row="5" name='f_address'><?= empty($family['f_address']) ? null : $family['f_address'] ?></textarea>
                                    </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="col-md-12">Mother's name</label>
                                <div class="col-md-12">
                                    <input type="text" name="m_name" required value="<?= empty($family['m_name']) ? null : $family['m_name'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No.</label>
                                <div class="col-md-12">
                                    <input type="text" name="m_phone" required value="<?= empty($family['m_phone']) ? null : $family['m_phone'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" required row="5" name='m_address'><?= empty($family['m_address']) ? null : $family['m_address'] ?></textarea>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="hidden" name='studID' value="<?= $family['student_id'] ?>">
                                    <input type="hidden" name='fa_id' value="<?= $family['id'] ?>">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php endif ?>
                    <div class="tab-pane" id="change_photo">
                        <form class="form-horizontal form-material" method="post" action="<?= site_url('update-img') ?>" enctype="multipart/form-data">
                            <div class="row m-b-20">
                                <div class="col-md-3 col-xs-12">
                                    <label for="input-file-now-custom-3">Avatar</label>
                                    <input type="file" name="avatar" accept="image/*" id="input-file-now-custom-3" class="dropify" data-height="200" data-default-file="<?= empty($profile['img']) ? site_url('/plugins/images/users/hanna.jpg') : site_url('uploads').'/'.$profile['img'] ?>" />
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <label for="input-file-now-custom-1">Cover Photo</label>
                                    <input type="file" name="cover" accept="image/*" id="input-file-now-custom-1" class="dropify" data-height="200" data-default-file="<?= empty($profile['cover']) ? site_url('/plugins/images/large/img1.jpg') : site_url('uploads').'/'.$profile['cover'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="change_pass">
                        <form class="form-horizontal form-material" method="post" action="<?= site_url('update-pass') ?>">
                            <div class="form-group">
                                <label class="col-md-12"><?= session()->get('user_type')=='student' ? 'User ID' : 'Email ID' ?></label>
                                <div class="col-md-12">
                                    <input type="text" name="login" required class="form-control form-control-line" value="<?= session()->get('user_type')=='student' ? $profile['student_ID'] : $profile['email'] ?>" readonly> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Current Password</label>
                                <div class="col-md-12">
                                    <input type="password" name="password" required class="form-control form-control-line" placeholder="Enter your current password"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">New Password</label>
                                <div class="col-md-12">
                                    <input type="password" name="new_pass" required class="form-control form-control-line" placeholder="Enter a new Password"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Confirm Password</label>
                                <div class="col-md-12">
                                    <input type="password" required name="conf_pass" class="form-control form-control-line" placeholder="Please confirm password"> </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="hidden" name='login_id' value="<?= session()->get('user_type')=='student' ? $profile['student_ID'] : $profile['email'] ?>">
                                    <input type="hidden" name='user_type' value="<?= session()->get('user_type')=='student' ? 'student' : 'faculty' ?>">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<?= $this->endSection() ?>