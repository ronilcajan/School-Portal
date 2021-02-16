<?= $this->extend('admin/base') ?>
<?= $this->section('admin') ?>

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
    <div class="white-box">
    <h3 class="box-title m-b-0">Activity Summary</h3>
        <div class="row m-0 m-b-20">
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-body">
                        <h3 class="info-count text-blue">
                        <?php 
                            $i=0;
                            foreach($activity as $row){ 
                                    $i++;
                            } 
                        ?>
                        <?= $i ?>
                        </h3>
                        <p class="info-text font-12 text-primary">Total Activity</p>
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
                            foreach($activity as $row){ 
                                if($row['status']=='Active'){
                                    $i++;
                                }
                            } 
                        ?>
                        <?= $i ?>
                        </h3>
                        <p class="info-text font-12 text-success">Active Activity</p>
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
                            foreach($activity as $row){ 
                                if($row['status']=='Done'){
                                    $i++;
                                }
                            } 
                        ?>
                        <?= $i ?>
                        </h3>
                        <p class="info-text font-12 text-danger">Done Activity</p>
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
                            foreach($activity as $row){ 
                                if(date('Y-m-d', strtotime($row['start_date'])) == date('Y-m-d')){
                                    $i++;
                                }
                            } 
                        ?>
                        <?= $i ?>
                        </h3>
                        <p class="info-text font-12">Activity Created Today</p>
                        <span class="hr-line"></span>
                    </div>
                </div>
            </div>
        </div>
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
                            <td class="text-center">
                                <?= $row['status']== 'Active' ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ?>
                            </td>
                        </tr>
                    <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
<?= $this->endSection() ?>