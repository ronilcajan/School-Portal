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
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-20">Assign Activities</h3>
                <form method="POST" action="<?= site_url('faculty/assignActivity') ?>">
                    <div class="form-group">
                        <label class="control-label">Activity</label>
                        <select class="form-control select2" name="activity_id" required data-placeholder="Choose">
                            <optgroup label="Activities">
                            <?php foreach($activity as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
                            <?php endforeach ?>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Sections</label>
                        <select class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose" name="sections_id[]" required >
                            <optgroup label="Sections">
                            <?php foreach($section->getResultArray() as $row):?>
                                <option value="<?= $row['id'] ?>">Grade <?= $row['section_year'].' - '.$row['section_name'] ?></option>
                            <?php endforeach ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date Assign</label>
                        <input type="text" name="date_assgin" class="form-control mydatepicker" placeholder="Firstname" required value="<?= set_value('firstname') ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Deadline</label>
                        <input type="text" name="deadline" class="form-control mydatepicker" placeholder="Firstname" required value="<?= set_value('firstname') ?>">
                    </div>
                    <div class="form-actions ">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Assign</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="white-box">
                <a type="button" href="#activity" class="fcbtn btn btn-outline btn-info btn-1c btn-sm m-b-20" data-toggle="modal"> Create Activity</a>
                <h3 class="box-title m-b-20">My Activities</h3>
                <div class="table-responsive">
                    <table id="act_table" class="display table-borderless" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($activity as $row): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td class="text-center"><?= !empty($row['file']) ? '<a class="text-danger" target="_blank" href="'.site_url('uploads/').$row['file'].'"><i class="fa fa-file"></i></a>' : null ?></td>
                                    <td><?= $row['status']== 'Active' ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ?></td>
                                    <td>
                                        <a href="#edit-activity" data-toggle="modal" data-id="<?= $row['id'] ?>" onclick="getActivity(this)" class="text-info"><small>Edit</small></a> | 
                                        <a href="<?= site_url('faculty/delete-activity/'.$row['id']) ?>" class="text-danger"><small>Delete</small></a>
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
<?= $this->include('faculty/modal') ?>
<?= $this->endSection() ?>