<?= $this->extend('admin/base') ?>

<?= $this->section('admin') ?>

<div class="container-fluid">
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
    <div class="white-box">
        <div class="button-box p-b-10" style="border-bottom:1px solid #e5ebec;">
            <a href="#create-modal" class="btn btn-info waves-effect waves-light" data-toggle="modal">Add Clearance</a>
        </div>
        <h3 class="box-title m-b-20">Subject Clearance</h3>
        <div class="row m-0 m-b-20">
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-body">
                        <h3 class="info-count text-blue">
                        <?php 
                            $i=0;
                            foreach($clearance as $row){ 
                                    $i++;
                            } 
                        ?>
                        <?= $i ?>
                        </h3>
                        <p class="info-text font-12 text-primary">Total Clearances</p>
                        <span class="hr-line"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-body">
                        <h3 class="info-count text-blue">
                        <?php 
                            $i=0;
                            foreach($clearance as $row){ 
                                if($row['status']=='Active'){
                                    $i++;
                                }
                            } 
                        ?>
                        <?= $i ?>
                        </h3>
                        <p class="info-text font-12 text-success">Active Clearances</p>
                        <span class="hr-line"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-body">
                        <h3 class="info-count text-blue">
                        <?php 
                            $i=0;
                            foreach($clearance as $row){ 
                                if($row['status']=='Done'){
                                    $i++;
                                }
                            } 
                        ?>
                        <?= $i ?>
                        </h3>
                        <p class="info-text font-12 text-danger">Settled Clearances</p>
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
                            foreach($clearance as $row){ 
                                if(date('Y-m-d', strtotime($row['created_at'])) == date('Y-m-d')){
                                    $i++;
                                }
                            } 
                        ?>
                        <?= $i ?>
                        </h3>
                        <p class="info-text font-12">Clearances Created Today</p>
                        <span class="hr-line"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="studentTable" class="display table-borderless" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($clearance as $row): ?>
                    <tr>
                        <td class='text-center'><?= $no ?></td>
                        <td><?= ucwords($row['firstname'].' '.$row['lastname']) ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['status']=='Active' ? '<span class="label label-success">'.$row['status'].'</span>' : '<span class="label label-info">'.$row['status'].'</span>' ?></td>
                        <td>
                            <?= $row['status'] != 'Done' ? '<a href="javascript:void(0)" class="text-primary" data-id="'.$row['id'].'" data-status="Done" onclick="clearanceDone(this)"><small>Done</small></a> |' : null ?>
                            <a href="#edit-modal" class="text-info" data-toggle="modal" onclick="editClearance(this)" class="text-danger" data-id="<?= $row['id'] ?>" data-stud="<?= $row['studID'] ?>" data-title="<?= $row['title'] ?>"  data-stat="<?= $row['status'] ?>" data-desc="<?= $row['description'] ?>"><small>Edit</small></a> |
                            <a class="text-danger" href="<?= site_url('admin/clearance/delete/'.$row['id']) ?>"><small>Delele</small></a>
                        </td>
                    </tr>
                <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->include('admin/clearance/modal') ?>
<?= $this->endSection() ?>