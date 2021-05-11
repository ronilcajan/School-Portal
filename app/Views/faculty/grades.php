<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="alert alert-success alert-dismissable" style="display:none" id="mssge">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p id='message'></p>
    </div>
    <?= $this->include('templates/breadcrumbs') ?>
    <div class="alert alert-info">
        <i class="icon-bulb fa-fw"></i> Table is editable. You can enter students grade and save it!
    </div>
    <div class="white-box">
    <h3 class="box-title m-b-20">Student Grade</h3>
        <div class="table-responsive">
            <table id="gradeTable" class="display table-borderless" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>1st Grading</th>
                        <th>2nd Grading</th>
                        <th>3rd Grading</th>
                        <th>4th Grading</th>
                        <th>Average</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($students as $row):?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td class="student_id"><a href="<?= site_url('faculty/myStudent/').$row['id'] ?>"><?= $row['student_ID'] ?></a></td>
                            <td><a href="<?= site_url('faculty/myStudent/').$row['id'] ?>"><?= ucwords($row['firstname'].' '.$row['lastname']) ?></a></td>
                            <td>Grade <?= $row['section_year'].' - '.$row['section_name'] ?></td>
                            <td contenteditable='true' class="grade1" style="border:1px solid RGB(0, 187, 217, 0.5)"><?= floatval($row['grade_1']) ? $row['grade_1'] : null ?></td>
                            <td contenteditable='true' class="grade2" style="border:1px solid RGB(0, 187, 217, 0.5);"><?= floatval($row['grade_2']) ? $row['grade_2'] : null ?></td>
                            <td contenteditable='true' class="grade3" style="border:1px solid RGB(0, 187, 217, 0.5)"><?= floatval($row['grade_3']) ? $row['grade_3'] : null ?></td>
                            <td contenteditable='true' class="grade4" style="border:1px solid RGB(0, 187, 217, 0.5)"><?= floatval($row['grade_4']) ? $row['grade_4'] : null ?></td>
                            <td class="average"><?= empty($row['average']) ? null : $row['average'] ?></td>
                            <td class="remarks"><?= empty($row['remarks']) ? null : $row['remarks'] ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-circle" id="save_grade" data-grade="<?= $row['grade_id'] ?>">
                                    <i class="icon-check"></i>
                                </button>  
                                <div class="btn-group dropup">
                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button"> 
                                    <i class="fa fa-envelope-o m-r-5"></i> <span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="javascript:void(0)" id="notif_student" data-grade="<?= $row['grade_id'] ?>" data-subs="<?= $row['subject_id'] ?>" data-student_id="<?= $row['id'] ?>">Notify Student</a></li>
                                        <li><a href="javascript:void(0)" id="notif_parents" data-grade="<?= $row['grade_id'] ?>" data-subs="<?= $row['subject_id'] ?>" data-student_id="<?= $row['id'] ?>">Notify Parents</a></li>
                                    </ul>
                                </div>
                                <!-- <select class="custom-select" id="grade-action" data-grade="<?= $row['grade_id'] ?>" data-subs="<?= $row['subject_id'] ?>" data-student_id="<?= $row['id'] ?>">
                                    <option value="" disable selected>Select</option>
                                    <option value="save">Save Grade</option>
                                    <?php if(floatval($row['grade_1'])): ?>
                                        <option value="student">Notify Student</option>
                                        <option value="parents">Notify Parents</option>
                                    <?php endif ?>
                                </select> -->
                               
                            </td>
                        </tr>
                    <?php $no++; endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
