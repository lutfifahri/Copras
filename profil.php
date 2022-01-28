<?php
if (isset($_GET['aksi'])) {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $query = "UPDATE pengguna SET nama='" . $nama . "', username='" . $username . "',
  password='" . $password . "' WHERE id_pengguna='" . $_SESSION['id_pengguna'] . "'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        $_SESSION['success'] = 1;
        $_SESSION['message'] = "Update Profil Berhasil";
        header('location:home.php?page=profil');
    } else {
        $_SESSION['success'] = 0;
        $_SESSION['message'] = "Gagal Profil Akun";
        header('location:home.php?page=profil');
    }
} else {
?>
    <section id="featured" class="content-section">
        <div class="section-heading mb-4">
            <h3><i class="fa fa-user"></i> <span>Update Profile</span></h3>
        </div>
        <?php
        $profil = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE id_pengguna='" . $_SESSION['id_pengguna'] . "'");
        $data = mysqli_fetch_assoc($profil);
        $nama = $data['nama'];
        $username = $data['username'];
        $password = $data['password'];
        if (isset($_SESSION['success'])) {
            if ($_SESSION['success'] == 1) {
                echo "<div class=\"alert alert-success\">" . $_SESSION['message'] . "</div>";
            } else {
                echo "<div class=\"alert alert-warning\">" . $_SESSION['message'] . "</div>";
            }
            unset($_SESSION['success']);
        }
        ?>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <br>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <form method="post" id="contact" action="home.php?page=profil&aksi=update">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nama</label>
                                <input type="text" name="nama" class="form-control" value='<?php echo $nama; ?>' id="w3lName" placeholder="Nama Lengkap" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" name="username" class="form-control" value='<?php echo $username; ?>' id="w3lName" placeholder="Username" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" value='<?php echo $password; ?>' id="w3lSender" placeholder="Password" required="" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2"> Update </button>
                        </form>
                    </div>
                </div>
            </div>
    </section>
<?php
}
?>