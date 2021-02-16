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
        <h3 class="box-title m-b-20">My Students</h3>
        <div class="table-responsive">
            <table id="studentTable" class="display table-borderless" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Section</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($students as $row):?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td><a href="<?= site_url('faculty/myStudent/').$row['id'] ?>"><?= $row['student_ID'] ?></a></td>
                            <td><a href="<?= site_url('faculty/myStudent/').$row['id'] ?>"><?= !empty($row['img']) ? '<img class="img-fluid rounded m-r-10" width="40" src="'.site_url('uploads/').$row['img'].'" />' : null ?><?= ucwords($row['firstname'].' '.$row['lastname']) ?></a></td>
                            <td><a href="mailto:"'.<?= $row['email'] ?>.'"><?= $row['email'] ?></a></td>
                            <td><a href="tel:"'.<?= $row['phone'] ?>.'"><?= $row['phone'] ?></a></td>
                            <td>Grade <?= $row['section_year'].' - '.$row['section_name'] ?></td>
                            <td><a href="<?= site_url('faculty/myStudent/').$row['id'] ?>" class="text-info"><small>View</small></a></td>
                        </tr>
                    <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
<?= $this->endSection() ?>