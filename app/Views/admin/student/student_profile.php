<?= $this->extend('admin/base') ?>
<?= $this->section('admin') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg"> 
                    <a class="btn default btn-outline image-popup-vertical-fit" href="<?= empty($students[0]['cover']) ? site_url('/plugins/images/large/img1.jpg') : site_url('uploads').'/'.$students[0]['cover'] ?>">
                        <img width="100%" alt="user" src="<?= empty($students[0]['cover']) ? site_url('/plugins/images/large/img1.jpg') : site_url('uploads').'/'.$students[0]['cover'] ?>"> 
                    </a>
                    
                </div>
                <div class="user-btm-box ">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="profile-img profile-image" style="margin-top:-30px;">
                                <img width="150" style="border:2px solid white;background-color:white" class="img-fluid" src="<?= empty($students[0]['img']) ? site_url('/plugins/images/users/hanna.jpg') : site_url('uploads').'/'.$students[0]['img'] ?>" >
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-6 b-r"><strong>Section</strong>
                            <p><?= empty($students[0]['section_name']) ? 'Section' : 'Grade '.$students[0]['section_year'].' - '.$students[0]['section_name'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>ID Number</strong>
                            <p><?= empty($students[0]['student_ID']) ? 'my ID' : $students[0]['student_ID'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Name</strong>
                            <p><?= empty($students[0]['firstname']) ? 'Name' : $students[0]['firstname'].' '.$students[0]['lastname'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>Birthdate</strong>
                            <p><?= empty($students[0]['birthday']) ? 'my ID' : date('F d, Y', strtotime($students[0]['birthday'])) ?></p>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Email ID</strong>
                            <p><a href="mailto:<?= empty($students[0]['email']) ? 'Email' : $students[0]['email'] ?>"><?= empty($students[0]['email']) ? 'Email' : $students[0]['email'] ?></a></p>
                        </div>
                        <div class="col-md-6"><strong>Phone</strong>
                            <p><a href="tel:<?= empty($students[0]['phone']) ? '+123 456 789' : $students[0]['phone'] ?>"><?= empty($students[0]['phone']) ? '+123 456 789' : $students[0]['phone'] ?></a></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-12"><strong>Address</strong>
                            <p><?= empty($students[0]['street']) ? 'Address here...' : ucwords($students[0]['street'].','.$students[0]['city'].','.$students[0]['province'].','.$students[0]['postal']) ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-4 b-r"><strong>Father's Name</strong>
                            <p><?= empty($family[0]['f_name']) ? 'Father' : $family[0]['f_name'] ?></p>
                        </div>
                        <div class="col-md-4 b-r"><strong>Phone</strong>
                            <p><a href="tel:<?= empty($family[0]['f_phone']) ? '+123 456 789' : $family[0]['f_phone'] ?>" ><?= empty($family[0]['f_phone']) ? '+123 456 789' : $family[0]['f_phone'] ?></a></p>
                        </div>
                        <div class="col-md-4"><strong>Email Address</strong>
                            <p><a href="tel:<?= empty($family[0]['f_email']) ? 'email' : $family[0]['f_email'] ?>" ><?= empty($family[0]['f_email']) ? 'email' : $family[0]['f_email'] ?></a></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-4 b-r"><strong>Mother's Name</strong>
                            <p><?= empty($family[0]['m_name']) ? 'Mother' : $family[0]['m_name'] ?></p>
                        </div>
                        <div class="col-md-4 b-r"><strong>Phone</strong>
                            <p><a href="tel:<?= empty($family[0]['m_phone']) ? '+123 456 789' : $family[0]['m_phone'] ?>" ><?= empty($family[0]['m_phone']) ? '+123 456 789' : $family[0]['m_phone'] ?></a></p>
                        </div>
                        <div class="col-md-4"><strong>Email Address</strong>
                            <p><a href="tel:<?= empty($family[0]['m_email']) ? 'email' : $family[0]['m_email'] ?>" ><?= empty($family[0]['m_email']) ? 'email' : $family[0]['m_email'] ?></a></p>
                        </div>
                    </div>
                    <div class="row text-center m-t-10">
                        <div class="col-md-12"><strong>Address</strong>
                            <p><?= empty($family[0]['m_address']) ? ucwords($family[0]['m_address']) : ucwords($students[0]['street'].','.$students[0]['city'].','.$students[0]['province'].','.$students[0]['postal']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <h3 class="box-title m-b-20">Activity History</h3>
                <div class="table-responsive">
                    <table id="act_table" class="display table-borderless" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach($activity as $row): ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['desc'] ?></td>
                                <td class="text-center"><?= !empty($row['file']) ? '<a class="text-danger" target="_blank" href="'.site_url('uploads/').$row['file'].'"><i class="fa fa-file"></i></a>' : null ?></td>
                            </tr>
                        <?php $no++; endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="white-box">
                <h3 class="box-title m-b-20">Student Subjects</h3>
                <div class="table-responsive">
                    <table id="subsTable" class="display table-borderless" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Subject Code</th>
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($subs as $row): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['subject_code'] ?></td>
                                    <td><?= $row['subject'] ?></td>
                                </tr>
                            <?php $no++; endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<?= $this->endSection() ?>