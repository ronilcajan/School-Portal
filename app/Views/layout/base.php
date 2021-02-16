<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title><?= $title ?> | OGM System</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="<?= base_url()?>/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="<?= base_url()?>/assets/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="<?= base_url()?>/assets/css/style.css?<?= date('h:j:s') ?>" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="<?= base_url()?>/assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        html,body{
            background-color:#F4F6F6;
        }
        a.portal-container div{
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            transition: all 0.3s;
        }
        a.portal-container div:hover{
            transform: scale(1.1);
        }
        @media (max-width: 767px){
            .navbar{
                position: relative;
               width: 100%;
            }
        }
        .alert li{
            list-style: none;
            width: 100%;
            text-align: left;
        }
        .alert{
            padding-left: 5;
            margin-bottom: 0;
        }
    </style>
</head>

<body class="mini-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>

    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <a class="logo" href="<?= base_url() ?>">
                    <b>
                        <img src="<?= base_url() ?>/plugins/images/logo.png" alt="home" />
                    </b>
                </a>
            </div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li>
                    <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light "><?= strtoupper('OGM System') ?></a>
                </li>
            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li class="dropdown">
                    <a class="waves-effect waves-light font-20" href="<?= base_url('/portal/student/login') ?>">
                        <i class="fa fa-user"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="waves-effect waves-light font-20" href="<?= base_url('/portal/faculty/login') ?>">
                        <i class="fa fa-suitcase"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <?= $this->renderSection('section') ?>

     <!-- jQuery -->
     <script src="<?= base_url()?>/plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url()?>/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    </script>
</body>

</html>