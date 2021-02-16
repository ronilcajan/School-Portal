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
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="white-box ecom-stat-widget">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="text-blue font-light"><?= count($class) - 1 ?> </span>
                            <p class="font-12">Classmates</p>
                        </div>
                        <div class="col-xs-6">
                            <span class="icoleaf bg-primary text-white"><i class="mdi mdi-account-multiple-outline"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="white-box ecom-stat-widget">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="text-blue font-light"><?= count($subs) ?> </span>
                            <p class="font-12">Subjects</p>
                        </div>
                        <div class="col-xs-6">
                            <span class="icoleaf bg-success text-white"><i class="mdi mdi-book-multiple"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="white-box ecom-stat-widget">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="text-blue font-light"><?= count($clearance) ?> </span>
                            <p class="font-12">Clearance</p>
                        </div>
                        <div class="col-xs-6">
                            <span class="icoleaf bg-danger text-white"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box user-table">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="box-title">My Activities</h4>
                        </div>
                        <div class="col-sm-6">
                            <select class="custom-select">
                                <option selected>Sort the list by</option>
                                <option value="1">Product</option>
                                <option value="2">Customer</option>
                                <option value="3">Location</option>
                                <option value="4">Quantity</option>
                                <option value="5">Status</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="activityTable" class="display table-borderless" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Subjects</th>
                                    <th>Deadline</th>
                                    <th>Files</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php $db = db_connect(); ?>
                            <?php $user_id = session()->get('id'); ?>
                            <tbody>
                                <?php $no=1; foreach($activity as $row): ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td><?= $row['title'] ?></td>
                                        <td><?= $row['desc'] ?></td>
                                        <td><?= $row['subject_code'].'-'.$row['subject'] ?></td>
                                        <td><?= $row['deadline'] ?></td>
                                        <td class="text-center"><a class="text-danger" href="<?= site_url() ?>uploads/<?= $row['file'] ?>"><i class="fa fa-file"></i></a></td>
                                        <td>
                                            <?php $id=$row['actID']; $stats = $db->query("SELECT * FROM activity_status WHERE student_id=$user_id AND activity_id=$id"); 
                                            $status = $stats->getResultArray(); ?>
                                            <?= empty($status[0]['status']) ? 'To do' : '<span class="label label-info">'.ucwords($status[0]['status']).'</span>' ?>
                                        </td>
                                        <td>
                                            <select class="custom-select" data-acc="<?= $row['actID'] ?>" onchange="activityStatus(this)">
                                                <option disbled selected>Select</option>
                                                <option value="done">Done</option>
                                                <option value="undone">Not Done</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php $no++; endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?= $this->endSection() ?>