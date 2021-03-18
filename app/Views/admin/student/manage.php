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
            <div class="alert alert-success mb-0 alert-dismissable" id="create-success" role="alert" style="display:none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="create-msg"></div>
            </div>
            <div class="white-box">
                <div class="button-box p-b-10" style="border-bottom:1px solid #e5ebec;">
                    <a href="<?= site_url('admin/create-student') ?>" class="btn btn-info waves-effect waves-light" data-toggle="modal">Create Student</a>
                </div>
               
                <h3 class="box-title m-b-0">Student Summary</h3>
                <div class="row m-0 m-b-20">
                    <div class="col-md-3 col-sm-6 info-box">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="info-count text-blue"><?= count($students) ?></h3>
                                <p class="info-text font-12 text-primary">Total Student</p>
                                <span class="hr-line"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-box">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="info-count text-blue"><?= count($active) ?></h3>
                                <p class="info-text font-12 text-success">Active Student</p>
                                <span class="hr-line"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-box">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="info-count text-blue"><?= count($inactive) ?></h3>
                                <p class="info-text font-12 text-danger">Inactive Student</p>
                                <span class="hr-line"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-box b-r-0">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="info-count text-blue">
                                <?php 
                                    $i=0;
                                    foreach($students as $row){ 
                                        if(date('Y-m-d', strtotime($row['created_at'])) == date('Y-m-d')){
                                            $i++;
                                        }
                                    } 
                                ?>
                                <?= $i ?>
                                </h3>
                                <p class="info-text font-12">Students Created Today</p>
                                <span class="hr-line"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="studentTable" class="display nowrap table-borderless" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fullname</th>
                                <th>Section</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; foreach($students as $row): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><a href="<?= site_url('admin/student/studentProfile/'.$row['id']) ?>"><?= $row['firstname'].' '.$row['lastname'] ?></a></td>
                                <td>Grade <?= $row['section_year'].' - '.$row['section_name'] ?></td>
                                <td><a href="tel:<?= $row['phone'] ?>"><?= $row['phone'] ?></a></td>
                                <td><a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a></td>
                                <td><?= $row['status'] == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ?></td>
                                <td><i class="fa fa-clock-o"></i> <?= date('n/j/Y g:i A', strtotime($row['created_at'])) ?></td>
                                <td><?= !empty($row['updated_at']) ? '<i class="fa fa-clock-o"></i> '. date('n/j/Y g:i A', strtotime($row['updated_at'])) :  null ?></td>
                                <td>
                                    <a href="<?= site_url('admin/student/studentProfile/'.$row['id']) ?>" class="text-primary"><small>View</small></a> | 
                                    <a href="<?= site_url('admin/student/edit/'.$row['id']) ?>" class="text-info"><small>Edit</small></a> 
                                    <!-- <a href="<?= site_url('admin/student/delete/'.$row['id']) ?>" class="text-danger"><small>Delete</small></a> -->
                                </td>
                            </tr>
                        <?php $i++; endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
