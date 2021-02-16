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
        <h3 class="box-title m-b-20">All Student Grades</h3>
        <div class="table-responsive">
            <table id="gradeTable" class="display table-borderless" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>1st Grading</th>
                        <th>2nd Grading</th>
                        <th>3rd Grading</th>
                        <th>4th Grading</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($students as $row):?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td class="student_id"><a href="<?= site_url('admin/student/studentProfile/').$row['id'] ?>"><?= $row['student_ID'] ?></a></td>
                            <td><a href="<?= site_url('admin/student/studentProfile/').$row['id'] ?>"><?= ucwords($row['firstname'].' '.$row['lastname']) ?></a></td>
                            <td>Grade <?= $row['section_year'].' - '.$row['section_name'] ?></td>
                            <td><?= $row['grade_1'] > 0 ? $row['grade_1'] : null  ?></td>
                            <td><?= $row['grade_2'] > 0 ? $row['grade_2'] : null ?></td>
                            <td><?= $row['grade_3'] > 0 ? $row['grade_3'] : null ?></td>
                            <td><?= $row['grade_4'] > 0 ? $row['grade_4'] : null ?></td>
                            <td><?= $row['grade_4'] > 0 ? $row['remarks'] : null ?></td>
                        </tr>
                    <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
<?= $this->endSection() ?>