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
                    <a href="#create-modal" class="btn btn-info waves-effect waves-light" data-toggle="modal">Create Subject</a>
                </div>
               
                <h3 class="box-title m-b-0">Subject Summary</h3>
                <div class="row m-0 m-b-20">
                    <div class="col-md-3 col-sm-6 info-box">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="info-count text-blue"><?= count($subjects) ?></h3>
                                <p class="info-text font-12 text-primary">Total Subject</p>
                                <span class="hr-line"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-box">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="info-count text-blue"><?= count($active) ?></h3>
                                <p class="info-text font-12 text-success">Active Subject</p>
                                <span class="hr-line"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-box">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="info-count text-blue"><?= count($inactive) ?></h3>
                                <p class="info-text font-12 text-danger">Inactive Subject</p>
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
                                    foreach($subjects as $row){ 
                                        if(date('Y-m-d', strtotime($row['created_at'])) == date('Y-m-d')){
                                            $i++;
                                        }
                                    } 
                                ?>
                                <?= $i ?>
                                </h3>
                                <p class="info-text font-12">Subjects Created Today</p>
                                <span class="hr-line"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myDatatables" class="display nowrap table-borderless" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $no=1; foreach($subjects as $row): ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['subject_code'] ?></td>
                                <td><?= $row['subject'] ?></td>
                                <td><?= $row['description'] ?></td>
                                <td><?= $row['status'] == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ?></td>
                                <td><i class="fa fa-clock-o"></i> <?= date('n/j/Y g:i A', strtotime($row['created_at'])) ?></td>
                                <td><?= !empty($row['updated_at']) ? '<i class="fa fa-clock-o"></i> '. date('n/j/Y g:i A', strtotime($row['updated_at'])) :  null ?></td>
                                <td>
                                    <a href="#edit-modal" data-toggle="modal" data-id="<?= $row['id'] ?>" onclick="getSubject(this)" class="text-info"><small>Edit</small></a> | 
                                    <a href="<?= base_url('admin/subject/delete/'.$row['id']) ?>" class="text-danger"><small>Delete</small></a>
                                </td>
                            </tr>
                        <?php $no++; endforeach ?>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('admin/subjects/modal') ?>
<?= $this->endSection() ?>
