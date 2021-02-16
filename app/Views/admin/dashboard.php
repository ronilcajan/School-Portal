<?= $this->extend('admin/base') ?>
<?= $this->section('admin') ?>


<div class="container-fluid">
    <?php if (session()->get('success')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <div class="row colorbox-group-widget">
        <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-primary">
                    <div class="media-body">
                        <h3 class="info-count"><?= $student ?> <span class="pull-right"><i class="mdi mdi-account-outline"></i></span></h3>
                        <p class="info-text font-12">Students</p>
                        <p class="info-ot font-15">Active<span class="label label-rounded"><?= $active_student ?></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-success">
                    <div class="media-body">
                        <h3 class="info-count"><?= $active_faculty ?> <span class="pull-right"><i class="mdi mdi-briefcase"></i></span></h3>
                        <p class="info-text font-12">Faculty</p>
                        <p class="info-ot font-15">Active<span class="label label-rounded"><?= $active_faculty ?></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-danger">
                    <div class="media-body">
                        <h3 class="info-count"><?= $active_subject ?> <span class="pull-right"><i class="mdi mdi-book"></i></span></h3>
                        <p class="info-text font-12">Subjects</p>
                        <p class="info-ot font-15">Active<span class="label label-rounded"><?= $active_subject ?></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-warning">
                    <div class="media-body">
                        <h3 class="info-count"><?= $active_section ?> <span class="pull-right"><i class="mdi mdi-account-multiple"></i></span></h3>
                        <p class="info-text font-12">Sections</p>
                        <p class="info-ot font-15">Active<span class="label label-rounded"><?= $active_section ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box user-table">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="box-title">User Data</h4>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline">
                            <li>
                                <a href="#deleteModal" data-toggle="modal" onclick="deleteUser()" class="btn btn-default btn-outline font-16"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </li>
                            <li><a href="<?= site_url('admin/register') ?>" class="btn btn-success font-20">+</a></li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="user_table">
                        <thead>
                            <tr>
                                <th><div class="checkbox checkbox-info"><input id="checkAll" type="checkbox"><label for="checkAll"></label></div>
                                </th>
                                <th>Name/Username</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($users): ?>
                            <?php foreach($users as $user): ?>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-info">
                                        <label for="c2"></label>
                                        <input id="c2" type="checkbox" data-id="<?= $user->id ?>" data-username="<?= $user->username ?>">
                                    </div>
                                </td>
                                <td><?= empty($user->name) ? $user->username : ucwords($user->name) ?></td>
                                <td><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></td>
                                <td><?= $user->address ?></td>
                                <td><?= ($user->role=='admin') ? '<span class="label label-success">'.$user->role.'</span>' : '<span class="label label-info">'.$user->role.'</span>'?></td>
                                <td>
                                    <select class="custom-select" onchange="changeRole(this)" data-id="<?= $user->id ?>">
                                        <option disabled selected>Change user role</option>
                                        <option value="1">Admin</option>
                                        <!-- <option value="2">Staff</option> -->
                                    </select>
                                    <!-- <button class="btn btn-default btn-circle" type="button"><i class="fa fa-check"></i></button> -->
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?= $this->include('admin/modal.php') ?>
<?= $this->endSection() ?>