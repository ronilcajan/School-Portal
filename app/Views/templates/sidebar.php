<aside class="sidebar">
    <div class="scroll-sidebar">
        <?php 
        $db = db_connect();
            $id= session()->get('id');
            if(session()->get('user_type') == 'faculty'){
                $query = $db->query("SELECT firstname,lastname,img FROM login_portal JOIN faculty ON login_portal.email = faculty.email WHERE faculty.id=$id");
            }else{
                $query = $db->query("SELECT firstname,lastname,img FROM login_portal JOIN students ON login_portal.id_number = students.student_ID WHERE students.id=$id");
            }
            $result = $query->getResultArray();
        ?>
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div class="profile-image">
                    <img src="<?= empty($result[0]['img']) ? site_url('/plugins/images/users/hanna.jpg') : site_url('uploads').'/'.$result[0]['img'] ?>" alt="user-img" class="img-circle">
                    <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-success">
                            <i class="fa fa-check"></i>
                        </span>
                    </a>
                </div>
                <p class="profile-text m-t-15 font-16"><a href="<?= session('user_type')=='student' ? site_url('student/my-profile') : site_url('faculty/my-profile') ?>"> <?= $result[0]['firstname'].' '.$result[0]['lastname'] ?></a></p>
                <p class="profile-text"><?= session('user_type')=='student' ? 'Student' : 'Faculty' ?></p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="side-menu">
            <?php ?>
                <?php if(session('user_type') == 'faculty'): ?>
                    <li>
                        <a class="waves-effect <?= strpos(uri_string(),'dashboard') ? 'active' : null ?>" href="<?= site_url('faculty/dashboard') ?>" aria-expanded="false">
                            <i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> Dashboard </span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect <?= strpos(uri_string(),'students') || strpos(uri_string(),'myStudent') ? 'active' : null ?>" href="<?= site_url('faculty/students') ?>" aria-expanded="false">
                            <i class="fa fa-users fa-fw"></i> <span class="hide-menu"> Students </span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect <?= strpos(uri_string(),'activity') ? 'active' : null ?>" href="<?= site_url('faculty/activity') ?>" aria-expanded="false">
                            <i class="fa fa-list-alt fa-fw"></i> <span class="hide-menu"> Activities </span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect <?= strpos(uri_string(),'grade') ? 'active' : null ?>" href="<?= site_url('faculty/grades') ?>" aria-expanded="false">
                            <i class="icon-badge fa-fw"></i> <span class="hide-menu"> Grades </span>
                        </a>
                    </li>
                    <!-- <li>
                        <a class="waves-effect  <?= strpos(uri_string(),'clearance') ? 'active' : null ?>" href="<?= site_url('faculty/clearance') ?>" aria-expanded="false">
                            <i class="fa fa-file fa-fw"></i> <span class="hide-menu"> Clearance </span>
                        </a>
                    </li> -->
                <?php endif ?>

                <?php if(session('user_type') == 'student'): ?>
                    <li>
                        <a class="waves-effect <?= strpos(uri_string(),'dashboard') ? 'active' : null ?>" href="<?= site_url('student/dashboard') ?>" aria-expanded="false">
                            <i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> Dashboard </span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect <?= strpos(uri_string(),'subjects') ? 'active' : null ?>" href="<?= site_url('student/subjects') ?>" aria-expanded="false">
                            <i class="fa fa-book fa-fw"></i> <span class="hide-menu"> Subjects </span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect <?= strpos(uri_string(),'grades') ? 'active' : null ?>" href="<?= site_url('student/grades') ?>" aria-expanded="false">
                            <i class="icon-badge fa-fw"></i> <span class="hide-menu"> Grades </span>
                        </a>
                    </li>
                    <!-- <li>
                        <a class="waves-effect  <?= strpos(uri_string(),'clearance') ? 'active' : null ?>" href="<?= site_url('student/clearance') ?>" aria-expanded="false">
                            <i class="fa fa-file fa-fw"></i> <span class="hide-menu"> Clearance </span>
                        </a>
                    </li> -->
                <?php endif ?>
                
            </ul>
        </nav>
    </div>
</aside>