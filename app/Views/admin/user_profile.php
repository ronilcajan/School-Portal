<?= $this->extend('admin/base') ?>

<?= $this->section('admin') ?>
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
                    <a class="btn default btn-outline image-popup-vertical-fit" href="<?= empty($user['cover']) ? base_url('/plugins/images/large/img1.jpg') : base_url('uploads').'/'.$user['cover'] ?>">
                        <img width="100%" alt="user" src="<?= empty($user['cover']) ? base_url('/plugins/images/large/img1.jpg') : base_url('uploads').'/'.$user['cover'] ?>"> 
                    </a>
                </div>
                <div class="user-btm-box">
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Name</strong>
                            <p><?= empty($user['name']) ? 'Name' : $user['name'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>Username</strong>
                            <p><?= empty($user['username']) ? 'Username' : $user['username'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Email ID</strong>
                            <p><?= empty($user['email']) ? 'Email' : $user['email'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>Phone</strong>
                            <p><?= empty($user['phone']) ? '+123 456 789' : $user['phone'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-12"><strong>Address</strong>
                            <p><?= empty($user['address']) ? 'Address here...' : $user['address'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-12"><strong>Bio</strong>
                            <p><?= empty($user['bio']) ? 'bio here...' : $user['bio'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <!-- .tabs -->
                <ul class="nav nav-tabs tabs customtab">
                    <li class="active tab">
                        <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Edit Detail</span> </a>
                    </li>
                </ul>
                <!-- /.tabs -->
                <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                        <form class="form-horizontal form-material" method="post" action="<?= base_url('admin/update-profile') ?>" enctype="multipart/form-data">
                            <div class="row m-b-20">
                                <div class="col-md-3 col-xs-12">
                                    <label for="input-file-now-custom-3">Avatar</label>
                                    <input type="file" name="avatar" accept="image/*" id="input-file-now-custom-3" class="dropify" data-height="200" data-default-file="<?= empty($user['img']) ? base_url('/plugins/images/users/hanna.jpg') : base_url('uploads').'/'.$user['img'] ?>" />
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <label for="input-file-now-custom-3">Cover Photo</label>
                                    <input type="file" name="cover" accept="image/*" id="input-file-now-custom-3" class="dropify" data-height="200" data-default-file="<?= empty($user['cover']) ? base_url('/plugins/images/large/img1.jpg') : base_url('uploads').'/'.$user['cover'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Username</label>
                                <div class="col-md-12">
                                    <input type="text" name="username" required value="<?= empty($user['username']) ? 'username' : $user['username'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" required value="<?= empty($user['name']) ? 'Name' : $user['name'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="text" name="email" required value="<?= empty($user['email']) ? 'Email' : $user['email'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" name="phone" required value="<?= empty($user['phone']) ? 'Phone' : $user['phone'] ?>" class="form-control form-control-line"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <textarea rows="5" name="address" required class="form-control form-control-line"><?= empty($user['address']) ? 'Location...' : $user['address'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Additional Info</label>
                                <div class="col-md-12">
                                    <textarea rows="5" name="bio" required class="form-control form-control-line"><?= empty($user['bio']) ? 'Write something about yourself...' : $user['bio'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="hidden" name='id' value="<?= $user['id'] ?>">
                                    <button class="btn btn-success" type="submit">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tabs3 -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<?= $this->endSection() ?>