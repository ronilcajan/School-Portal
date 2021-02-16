<?= $this->extend('layout/base') ?>
<?= $this->section('section') ?>

	<section id="wrapper">
		<div class="login-box">
            <div class="white-box">
                <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <?= session()->get('error') ?>
                    </div>
                <?php endif; ?>
				<form class="form-horizontal form-material" method="POST" id="loginform" action="<?= site_url('loginAttempt') ?>">
				<?= csrf_field() ?>
                    <h3 class="box-title m-b-20"><?= strpos(uri_string(),'student') ? 'Student' : 'Faculty' ?> Portal</h3>
                    <p>Please Sign in!</p>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <?= strpos(uri_string(),'student') ? '<input class="form-control" type="text" name="login" required="" placeholder="Enter ID#" value="'.set_value('login').'">' : '<input class="form-control" type="email" name="login" required="" value="'.set_value('login').'" placeholder="Enter Email">' ?> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <input type="hidden" value="<?= strpos(uri_string(),'student') ? 'student' : 'faculty' ?>" name="user_type">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Login</button>
                        </div>
                    </div>
				</form>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>
