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
    <?= $this->include('templates/breadcrumbs') ?>
    <div class="white-box">
    <a type="button" class="fcbtn btn btn-outline btn-info btn-1c btn-sm m-b-20" href="#create-modal" data-toggle="modal"> Add Clearance</a>
        <h3 class="box-title m-b-20">All Clearance</h3>
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
                            <?= $row['status'] != 'Done' ? '<a href="javascript:void(0)" class="text-primary" data-id="'.$row['id'].'" data-status="Done" onclick="FclearanceDone(this)"><small>Done</small></a> |' : null ?>
                            <a href="#edit-modal" class="text-info" data-toggle="modal" onclick="editClearance(this)" class="text-danger" data-id="<?= $row['id'] ?>" data-stud="<?= $row['studID'] ?>" data-title="<?= $row['title'] ?>"  data-stat="<?= $row['status'] ?>" data-desc="<?= $row['description'] ?>"><small>Edit</small></a> |
                            <a class="text-danger" href="<?= site_url('faculty/deleteClearance/'.$row['id']) ?>"><small>Delele</small></a>
                        </td>
                    </tr>
                <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
<?= $this->include('faculty/modal') ?>
<?= $this->endSection() ?>