<aside class="sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <?php 
                    $id= user_id();
                    $db = db_connect();
                    $query = $db->query("SELECT `name`,img,username FROM users JOIN user_profile ON users.id = user_profile.user_id WHERE users.id=$id");
                    $result = $query->getResultArray();
                ?>
                <div class="profile-image">
                    <img src="<?= empty($result[0]['img']) ? site_url('/plugins/images/users/hanna.jpg') : site_url('uploads').'/'.$result[0]['img'] ?>" alt="user-img" class="img-circle">
                    <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-success">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated flipInY">
                        <li><a href="<?= site_url('admin/my-profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= site_url('admin/logout') ?>" class="text-danger"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </div>
                <p class="profile-text m-t-15 font-16"><a href="<?= site_url('admin/my-profile') ?>"> <?= empty($result[0]['name']) ? ucwords($result[0]['username']) : ucwords($result[0]['name']) ?> </a></p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="side-menu">
                <li>
                    <a class="waves-effect <?= strpos(uri_string(),'dashboard') || strpos(uri_string(),'my-profile') || strpos(uri_string(),'register') ? 'active' : null ?>" href="<?= site_url('admin/dashboard') ?>" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> Dashboard </span></a>
                </li>
                <li>
                    <a class="waves-effect <?= strpos(uri_string(),'student') || strpos(uri_string(),'subject') || strpos(uri_string(),'section')  ? 'active' : null ?>" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <span class="hide-menu"> Students </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a href="<?= site_url('admin/students') ?>"><i class="fa fa-user"></i> View Students</a> </li>
                        <li> <a href="<?= site_url('admin/section') ?>"><i class="fa fa-users"></i> Year & Section</a> </li>
                        <li> <a href="<?= site_url('admin/subject') ?>"><i class="fa fa-book"></i> Subjects</a> </li>
                    </ul>
                </li>
                <!-- <li>
                    <a class="waves-effect  <?= strpos(uri_string(),'student') ? 'active' : null ?>" href="<?= site_url('admin/students') ?>" aria-expanded="false"><i class="fa fa-user fa-fw"></i> <span class="hide-menu"> Student </span></a>
                </li> -->
                <li>
                    <a class="waves-effect  <?= strpos(uri_string(),'faculty') ? 'active' : null ?>" href="<?= site_url('admin/faculty') ?>" aria-expanded="false"><i class="fa fa-briefcase fa-fw"></i> <span class="hide-menu"> Faculty </span></a>
                </li>
                <!-- <li>
                    <a class="waves-effect  <?= strpos(uri_string(),'section') ? 'active' : null ?>" href="<?= site_url('admin/section') ?>" aria-expanded="false"><i class="fa fa-users fa-fw"></i> <span class="hide-menu"> Year & Section </span></a>
                </li>
                <li>
                    <a class="waves-effect  <?= strpos(uri_string(),'subject') ? 'active' : null ?>" href="<?= site_url('admin/subject') ?>" aria-expanded="false"><i class="fa fa-book fa-fw"></i> <span class="hide-menu"> Subjects </span></a>
                </li> -->
                <li>
                    <a class="waves-effect  <?= strpos(uri_string(),'activity') ? 'active' : null ?>" href="<?= site_url('admin/activity') ?>" aria-expanded="false"><i class="fa fa-list-alt fa-fw"></i> <span class="hide-menu"> Activities </span></a>
                </li>
                <li>
                <!-- <li>
                    <a class="waves-effect  <?= strpos(uri_string(),'grades') ? 'active' : null ?>" href="<?= site_url('admin/grades') ?>" aria-expanded="false"><i class="icon-badge fa-fw"></i> <span class="hide-menu"> Grades </span></a>
                </li> -->
                <!-- <li>
                    <a class="waves-effect  <?= strpos(uri_string(),'clearance') ? 'active' : null ?>" href="<?= site_url('admin/clearance') ?>" aria-expanded="false"><i class="fa fa-file fa-fw"></i> <span class="hide-menu"> Clearance </span></a>
                </li> -->
            </ul>
        </nav>
    </div>
</aside>