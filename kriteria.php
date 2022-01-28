<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == "tambah") {
?>
        <h4>Tambah Kriteria</h4>
        <div class="card">
            <div class="card-body">
                <form id="contact" method="post" enctype="multipart/form-data" action="?page=kriteria&aksi=proses_tambah">
                    <div class="form-top">
                        <div class="form-top-left">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" id="w3lName" placeholder="Nama" required autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label>Bobot (%)</label>
                                <input type="number" class="form-control" name="bobot" value='<?php echo $bobot; ?>' id="w3lName" placeholder="Bobot Kriteria" required autocomplete="off">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button> |
                        <a href="?page=kriteria" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
        </div>
    <?php
    } else if ($_GET['aksi'] == "edit") {
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='" . $id . "'");
        $result = mysqli_fetch_array($query);
        $nama = $result['nama'];
        $bobot = $result['bobot'];
    ?>
        <div class="section-heading mb-4">
            <h3><i class="fa fa-book"></i>. Edit Data Kriteria</h3>
        </div>
        <!-- general form elements -->
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form id="contact" method="post" enctype="multipart/form-data" action="?page=kriteria&aksi=proses_edit">
                    <?php
                    echo "<input type=hidden name=id_kriteria value=" . $id . " />";
                    ?>
                    <div class="form-top">
                        <div class="form-top-left">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" value='<?php echo $nama; ?>' id="w3lName" placeholder="Nama" required autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label>Bobot (%)</label>
                                <input type="number" class="form-control" name="bobot" value='<?php echo $bobot; ?>' id="w3lName" placeholder="Bobot Kriteria %" required autocomplete="off">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button> |
                        <a href="?page=kriteria" class="btn btn-primary">Cancel</a>
                </form>
            </div>
        </div>
        </div>
    <?php
    } else if ($_GET['aksi'] == "proses_tambah") {
        $nama = $_POST['nama'];
        $bobot = $_POST['bobot'];

        $query = "INSERT INTO kriteria(nama, bobot) VALUES('" . $nama . "', '" . $bobot . "')";
        $result = mysqli_query($koneksi, $query) or die(mysqli_error($query));
        if ($result) {
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Berhasil Menambah Data Kriteria";
            header('location:home.php?page=kriteria');
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Menambah Data Kriteria";
            header('location:home.php?page=kriteria');
        }
    } else if ($_GET['aksi'] == "proses_edit") {
        $id = $_POST['id_kriteria'];
        $nama = $_POST['nama'];
        $bobot = $_POST['bobot'];

        $query = "UPDATE kriteria SET nama='" . $nama . "', bobot='" . $bobot . "' WHERE id_kriteria='" . $id . "'";
        $result = mysqli_query($koneksi, $query) or die(mysqli_error($query));
        if ($result) {
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Berhasil Mengedit Data Kriteria";
            header('location:home.php?page=kriteria');
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Mengedit Data Kriteria";
            header('location:home.php?page=kriteria');
        }
    } else {
        $query = "DELETE FROM kriteria WHERE id_kriteria = '" . $_GET['id'] . "'";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Data Kriteria Berhasil Dihapus";
            header('location:home.php?page=kriteria');
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Menghapus Data Kriteria";
            header('location:home.php?page=kriteria');
        }
    }
} else {
    ?>
    <div class="section-heading mb-5">
        <h3><i class="fa fa-book"></i>. Data Kriteria</h3>
    </div>

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

    <!-- general form elements -->
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <br>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>
                            <center>Nama Kriteria</center>
                        </th>
                        <th>
                            <center>Bobot</center>
                        </th>
                        <th>
                            <center> <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1"><i class='fa fa-plus'></i> Tambah</button></center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM kriteria");
                    while ($result = mysqli_fetch_array($query)) {
                        $id = $result['id_kriteria'];
                        $nama = $result['nama'];
                        $bobot = $result['bobot'];

                        echo "<tr>";
                        echo "<td style='vertical-align:middle'><center>" . $nama . "</center></td>";
                        echo "<td style='vertical-align:middle'><center>" . $bobot . " %</center></td>";
                        echo "<td style='vertical-align:middle'>
                    <center>
                      <a class=' btn btn-success btn-sm' href=?page=kriteria&aksi=edit&id=" . $id . "><i class='fa fa-cogs'></i> Edit</a> |
                      <a class=' btn btn-danger btn-sm'  href=?page=kriteria&aksi=hapus&id=" . $id . " onclick='return confirm('Anda yakin ingin menghapus data ini ?')'><i class=' fa fa-trash-o'></i> Hapus</a> |
                      <a class='btn btn-primary btn-sm' href=?page=subkriteria&id_kriteria=" . $id . ">Subkriteria</a>
                    </center>
                  </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php
    }
        ?>



        <!-- Modal Tambah Data -->
        <div id="myModal1" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- konten modal-->
                <div class="box box-success">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Pemberitahuan !!! Isi Data Kriteria</h4>
                    </div>
                    <div class="modal-body">
                        <!-- form start -->
                        <form id="contact" method="post" enctype="multipart/form-data" action="?page=kriteria&aksi=proses_tambah">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <div class="form-group mb-3">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" id="w3lName" placeholder="Nama" required autocomplete="off">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Bobot (%)</label>
                                        <input type="number" class="form-control" name="bobot" id="w3lName" placeholder="Bobot Kriteria" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->