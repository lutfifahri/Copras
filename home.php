<?php
include 'koneksi.php';
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PT Perkebunan Nusantara IV (Persero) </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="dist/img/daun_teh.jpg" rel="icon">
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->

    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-green">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo"><b>SPK - </b>COPRAS</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs"><?php echo $_SESSION['nama_admin']; ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <center>
                        <img src="dist/img/logo-ptpn4.png" width="210" height="75" />
                    </center>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <?php
                    if ($_SESSION['jabatan'] == "Administrator") {
                    ?>
                        <li class="treeview">
                            <a href="?page=dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="?page=kriteria">
                                <i class="fa fa-book"></i>
                                <span>Kriteria</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="?page=daun">
                                <i class="fa fa-male"></i>
                                <span>Jenis Daun</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="?page=analisa">
                                <i class="fa fa-bar-chart"></i>
                                <span>Perbandingan (Analisa)</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="?page=profil">
                                <i class="fa fa-user"></i>
                                <span>Update Profile</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-print"></i>
                            <span>Laporan</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a target="_blank" href="laporan_daun.php"><i class="fa fa-circle-o"></i> Laporan Daun</a></li>
                            <li><a target="_blank" href="laporan_analisa.php"><i class="fa fa-circle-o"></i> Laporan Analisa</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#myModal">
                            <i class="fa  fa-power-off"></i> <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box-body">
                    <!-- Default box -->
                    <?php include 'section.php'; ?>
                </div><!-- /.box -->
        </div>





        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- konten modal-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Pemberitahuan !!!</h4>
                    </div>
                    <div class="modal-body">
                        <p>Yakin Anda Ingin Keluar .?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <a href="proses_login.php?aksi=out" class="btn btn-danger">Logout</a>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>

        <!-- jQuery 2.1.3 -->
        <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            /** tambah class active jika di klik */
            var url = window.location;
            // ini untuk menambahkan class active pada menu yg tidak memiliki anak atau single link
            $('ul.sidebar-menu a').filter(function() {
                return this.href == url;
            }).parent().addClass('active');
            // ini untuk menu beranak, jadi otomatis akan terbuka sesuai dengan link tujuan
            $('ul.treeview-menu a').filter(function() {
                return this.href == url;
            }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
        </script>
</body>

</html>