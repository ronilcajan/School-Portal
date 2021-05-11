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
    <div class="white-box user-table">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="box-title m-b-20">My Grades</h3>
        </div>
        <div class="col-sm-6">
            <select class="custom-select m-b-10" id="school_year" name="school_year">
                <option selected disabled>School Year</option>
                <?php foreach($school_year as $row): ?>
                    <option value="<?= $row['school_year'] ?>"><?= $row['school_year'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        </div>
        
        <div class="table-responsive">
            <table id="studentTable" class="display table-borderless" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>School Year</th>
                        <th>Grading 1</th>
                        <th>Grading 2</th>
                        <th>Grading 3</th>
                        <th>Grading 4</th>
                        <th>Average</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($grades as $row): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['subject'] ?></td>
                        <td><?= $row['school_year'] ?></td>
                        <td><?= $row['grade_1'] > 0 ? $row['grade_1'] : null ?></td>
                        <td><?= $row['grade_2'] > 0 ? $row['grade_2'] : null ?></td>
                        <td><?= $row['grade_3'] > 0 ? $row['grade_3'] : null ?></td>
                        <td><?= $row['grade_4'] > 0 ? $row['grade_4'] : null ?></td>
                        <td><?= $row['average'] ?></td>
                        <td><?= $row['remarks'] ?></td>
                    </tr>
                <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>