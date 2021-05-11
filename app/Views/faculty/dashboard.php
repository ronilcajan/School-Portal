<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>


<div class="container-fluid">
    <?php if (session()->get('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= session()->get('success') ?>!
        </div>
    <?php endif; ?>
    <?= $this->include('templates/breadcrumbs') ?>
    <div class="row">
        <div class="col-md-3">
            <div class="white-box ecom-stat-widget">
                <div class="row">
                    <div class="col-xs-6">
                        <span class="text-blue font-light"><?= $subject[0]['subject'] ?></i></span>
                        <p class="font-12">Subject Code: <?= $subject[0]['subject_code'] ?></p>
                    </div>
                    <div class="col-xs-6">
                        <span class="icoleaf bg-info text-white"><i class="mdi mdi-book"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="white-box ecom-stat-widget">
                <div class="row">
                    <div class="col-xs-6">
                        <span class="text-blue font-light"><?= $count_student ?></i></span>
                        <p class="font-12">Total Students</p>
                    </div>
                    <div class="col-xs-6">
                        <span class="icoleaf bg-primary text-white"><i class="mdi mdi-account-outline"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="white-box ecom-stat-widget">
                <div class="row">
                    <div class="col-xs-6">
                        <span class="text-blue font-light"><?= count($count_act) ?> </i></span>
                        <p class="font-12">Active Activities</p>
                    </div>
                    <div class="col-xs-6">
                        <span class="icoleaf bg-success text-white"><i class="mdi mdi-format-list-bulleted"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="white-box ecom-stat-widget">
                <div class="row">
                    <div class="col-xs-6">
                        <span class="text-blue font-light"><?= count($inactiveStudents)?></i></span>
                        <p class="font-12">Inactive Students</p>
                    </div>
                    <div class="col-xs-6">
                        <span class="icoleaf bg-danger text-white"><i class="mdi mdi-account-remove"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="white-box user-table">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="box-title">Students</h4>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="grade_level">
                            <option disabled selected>Select Level</option>
                            <?php foreach($grade_level as $row): ?>
                            <option value="Grade <?= $row['section_year'] ?>">Grade <?= $row['section_year'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="section_">
                            <option disabled selected>Select Level</option>
                            <?php foreach($grade_level as $row): ?>
                            <option value="<?= ucwords($row['section_name']) ?>"><?= ucwords($row['section_name']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="facDTable" class="display table-borderless" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Year Level</th>
                                <th>Section</th>
                                <th>School Year</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach($students as $row): ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['student_ID'] ?></td>
                                <td><?= !empty($row['img']) ? '<img class="img-fluid rounded m-r-10" width="40" src="'.site_url('uploads/').$row['img'].'" />' : null ?><?= ucwords($row['firstname'].' '.$row['lastname']) ?></td>
                                <td><a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a></td>
                                <td><a href="tel:<?= $row['phone'] ?>"?><?= $row['phone'] ?></a></td>
                                <td>Grade <?= $row['section_year'] ?></td>
                                <td><?= $row['section_name'] ?></td>
                                <td><?= ucwords($row['school_year']) ?></td>
                            </tr>
                        <?php $no++; endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
             <input type="hidden" id="faculty_id" value="<?= session()->get('id'); ?>" >
            <div class="white-box order-chart-widget">
                <h4 class="box-title">Students</h4>
                <div id="order-status-chart" style="height: 350px;"></div>
                <ul class="list-inline m-b-0 m-t-20 t-a-c">
                    <li>
                        <h6 class="font-15"><i class="fa fa-circle m-r-5 text-primary"></i>Total</h6>
                    </li>
                    <li>
                        <h6 class="font-15"><i class="fa fa-circle m-r-5 text-danger"></i>Female</h6>
                    </li>
                    <li>
                        <h6 class="font-15"><i class="fa fa-circle m-r-5 text-success"></i>Male</h6>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>