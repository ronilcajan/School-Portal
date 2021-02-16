<?= $this->extend('admin/base') ?>

<?= $this->section('admin') ?>

<!-- ===== Page-Container ===== -->
<div class="container-fluid">
    <div class="row">
        <div class="login-box" style="margin-top: 0;">
            <div class="white-box">
				<?= view('Myth\Auth\Views\_message_block') ?>
                <form class="form-horizontal form-material" action="<?= site_url('admin/registerSubmit') ?>" method="post" >
					<?= csrf_field() ?>
					<h3 class="box-title m-b-20"><?=lang('Auth.register')?> a User</h3>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" type="email" required="" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="username" type="text" required="" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <select class="form-control" name="role">
                                <option selected disabled>User Role</option>
                                <option value="admin">Admin</option>
                                <!-- <option value="staff">Staff</option> -->
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="<?=lang('Auth.password')?>" autocomplet="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="pass_confirm" required="" placeholder="<?=lang('Auth.repeatPassword')?>"  autocomplet="off">
                        </div>
                    </div>
					<div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
							<button type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"><?=lang('Auth.register')?></button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
    </div>
</div>
        
<?= $this->endSection() ?>
