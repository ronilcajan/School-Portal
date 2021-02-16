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
    <a type="button" class="fcbtn btn btn-outline btn-info btn-1c btn-sm m-b-20" href="<?= site_url('faculty/new-activity') ?>"> Assign Activity</a>
        <h3 class="box-title m-b-20">All Activities</h3>
        <div class="table-responsive">
            <table id="studentTable" class="display table-borderless" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Activity</th>
                        <th>Description</th>
                        <th>Section</th>
                        <th>Created</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($activity as $row): ?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td>Grade <?= $row['section_year'].' - '. $row['section_name'] ?></td>
                            <td><?= $row['start_date'] ?></td>
                            <td><?= $row['deadline'] ?></td>
                            <td class="text-center"><?= $row['status']== 'Active' ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ?>
                                
                            </td>
                            <td class="text-center">
                                <select class="custom-select" data-id="<?= $row['id'] ?>" onchange="changeActiStatus(this)">
                                    <option disable selected>Select</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Delete">Delete</option>
                                </select>
                            </td>
                        </tr>
                    <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
<?= $this->endSection() ?>