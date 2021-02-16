<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-bars"></i>
        </a>
        <?php  ?>
        <div class="top-left-part">
            <a class="logo" href="<?= session('user_type')=='student' ? site_url('student/dashboard') : site_url('faculty/dashboard') ?>">
                <b>
                    <img src="<?= site_url() ?>/plugins/images/logo.png" alt="home" />
                </b>
                <span>
                    <img src="<?= site_url() ?>/plugins/images/logo-text.png" alt="homepage" class="dark-logo" />
                </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
                    <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                    <li>
                        <a href="<?= session('user_type')=='student' ? site_url('student/my-profile') : site_url('faculty/my-profile') ?>"> <i class="icon-user"></i> Profile
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= site_url('login/logout'); ?>" class="text-danger"> <i class="icon-settings"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>