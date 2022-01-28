<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PT Perkebunan Nusantara IV (Persero) </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="dist/img/daun_teh.jpg" />
</head>
<style type="text/css">
    body {
        background: url(dinas.jpg) no-repeat fixed;
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        background-size: 100% 100%;
    }

    p {
        font-family: 'Times New Roman', Times, serif;
    }
</style>

<?php
if (isset($_SESSION['success'])) {
    if ($_SESSION['success'] == 1) {
        echo "<div class=\"alert alert-success\">" . $_SESSION['message'] . "</div>";
    } else {
        echo "<div class=\"alert alert-warning\">" . $_SESSION['message'] . "</div>";
    }
    unset($_SESSION['success']);
}
?>

<body class="login-page">
    <?php
    if (isset($_SESSION['success'])) {
        if ($_SESSION['success'] == 1) {
            echo "<div class=\"alert alert-success\">" . $_SESSION['message'] . "</div>";
        } else {
            echo "<div class=\"alert alert-warning\">" . $_SESSION['message'] . "</div>";
        }
        unset($_SESSION['success']);
    }
    ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>SPK</b> - COPRAS</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <h4 class="mb-3">
                <center>Selamat Datang Di Aplikasi SPK</center>
            </h4>
            <form method="post" id="contact" action="proses_login.php">
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Masukan Username" autocomplete="off" required="" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Masukan Password" autocomplete="off" required="" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <button type="submit" class="btn btn-primary btn-sm">Sign In</button>
                    </div><!-- /.col -->
                </div>
            </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>

</body>

</html>