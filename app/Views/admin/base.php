<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('templates/header.php') ?>
    <style>
        ul.alert li{
            list-style: none;
            width: 100%;
            text-align: left;
        }
        ul.alert{
            padding-left: 5;
            margin-bottom: 0;
        }
    </style>
</head>

<body class="mini-sidebar">
    <!-- ===== Main-Wrapper ===== -->
    <div id="wrapper">
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <!-- ===== Top-Navigation ===== -->
        <?= $this->include('admin/template/navbar.php') ?>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
        <?= $this->include('admin/template/sidebar.php') ?>
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
        <?= $this->renderSection('admin') ?>
            <!-- ===== Page-Container-End ===== -->
            <footer class="footer t-a-c">
            © <?= date('Y') ?> OGM System
        </footer>
        </div>
        <!-- ===== Page-Content-End ===== -->
    </div>
    <!-- ===== Main-Wrapper-End ===== -->
    <!-- ==============================
        Required JS Files
    =============================== -->
    <?= $this->include('templates/footer.php') ?>
</body>

</html>
