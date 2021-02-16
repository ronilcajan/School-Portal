<?= $this->extend('layout/base') ?>
<?= $this->section('section') ?>
    <section id="wrapper">
        <div class="container text-center">
            <div class="" style="margin:20%;">
                <div class="col-md-6 col-xs-12">
                    <a class="portal-container" href="<?= base_url('/portal/student/login') ?>">
                        <div class="white-box text-center">
                            <span class="text-primary"><i class="fa fa-user m-t-30" style="font-size:50px"></i></span>
                            <h6 class="m-b-30">Student Portal</h6>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xs-12">
                    <a class="portal-container" href="<?= base_url('/portal/faculty/login') ?>">
                        <div class="white-box text-center">
                            <span class="text-primary"><i class="fa fa-briefcase m-t-30" style="font-size:50px"></i></span>
                            <h6 class="m-b-30">Faculty Portal</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection('section') ?>
