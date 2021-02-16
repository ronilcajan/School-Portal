<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>


<div class="container-fluid">
    <?php if (session()->get('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <?= $this->include('templates/breadcrumbs') ?>
    <div class="alert alert-info"><i class="icon-bulb fa-fw"></i>If table is empty you are cleared!</div>
    <div class="white-box">
        <h3 class="box-title m-b-20">Clearance</h3>
        <div class="table-responsive">
            <table id="studentTable" class="display table-borderless" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($clearance as $row): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['status']=='Active' ? '<span class="label label-danger">'.$row['status'].'</span>' : '<span class="label label-info">'.$row['status'].'</span>' ?></td>
                        <td>
                        <?php if($row['status']=='Active'):?>
                            <a class="text-primary" href="<?= site_url('student/compliedClearance/').$row['id'] ?>"><small>Complied</small></a>
                        <?php endif ?>
                        </td>
                    </tr>
                <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>