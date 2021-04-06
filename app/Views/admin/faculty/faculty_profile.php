<?= $this->extend('admin/base') ?>
<?= $this->section('admin') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg"> 
                    <a class="btn default btn-outline image-popup-vertical-fit" href="<?= empty($faculty['cover']) ? site_url('/plugins/images/large/img1.jpg') : site_url('uploads').'/'.$faculty['cover'] ?>">
                        <img width="100%" alt="user" src="<?= empty($faculty['cover']) ? site_url('/plugins/images/large/img1.jpg') : site_url('uploads').'/'.$faculty['cover'] ?>"> 
                    </a>
                    
                </div>
                <div class="user-btm-box ">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="profile-img profile-image" style="margin-top:-30px;">
                                <img width="150" style="border:2px solid white;background-color:white" class="img-fluid" src="<?= empty($faculty['img']) ? site_url('/plugins/images/users/hanna.jpg') : site_url('uploads').'/'.$faculty['img'] ?>" >
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-6 b-r"><strong>Section</strong>
                            <p><?= empty($section[0]['section_name']) ? 'Section' : 'Grade '.$section[0]['section_year'].'-'.$section[0]['section_name'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>Subject</strong>
                            <p><?= empty($section[0]['subject_code']) ? 'Subject' : $section[0]['subject_code'].'-'.$section[0]['subject'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Name</strong>
                            <p><?= empty($faculty['firstname']) ? 'Name' : $faculty['firstname'].' '.$faculty['lastname'] ?></p>
                        </div>
                        <div class="col-md-6"><strong>Birthdate</strong>
                            <p><?= empty($faculty['birthdate']) ? 'Birthdate' : date('F d, Y', strtotime($faculty['birthdate'])) ?></p>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Email ID</strong>
                            <p><a href="mailto:<?= empty($faculty['email']) ? 'Email' : $faculty['email'] ?>"><?= empty($faculty['email']) ? 'Email' : $faculty['email'] ?></a></p>
                        </div>
                        <div class="col-md-6"><strong>Phone</strong>
                            <p><a href="tel:<?= empty($faculty['phone']) ? '+123 456 789' : $faculty['phone'] ?>"><?= empty($faculty['phone']) ? '+123 456 789' : $faculty['phone'] ?></a></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-12"><strong>Address</strong>
                            <p><?= empty($faculty['street']) ? 'Address here...' : ucwords($faculty['street'].','.$faculty['city'].','.$faculty['province'].','.$faculty['postal']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <h3 class="box-title m-b-20">Students</h3>
                <div class="table-responsive">
                    <table id="studentTable" class="display table-borderless" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($students as $row):?>
                                <tr>
                                    <td class="text-center"><?= $no ?></td>
                                    <td><a href="<?= site_url('admin/student/studentProfile/'.$row['id']) ?>"><?= $row['student_ID'] ?></a></td>
                                    <td><a href="<?= site_url('admin/student/studentProfile/'.$row['id']) ?>"><?= !empty($row['img']) ? '<img class="img-fluid rounded m-r-10" width="40" src="'.site_url('uploads/').$row['img'].'" />' : null ?><?= ucwords($row['firstname'].' '.$row['lastname']) ?></a></td>
                                    <td><a href="mailto:"'.<?= $row['email'] ?>.'"><?= $row['email'] ?></a></td>
                                    <td><a href="tel:"'.<?= $row['phone'] ?>.'"><?= $row['phone'] ?></a></td>
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