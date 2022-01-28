<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == "tambah") {
        $id_kriteria = $_GET['id_kriteria'];
?>
        <div class="section-heading mb-5">
            <h3><i class="fa fa-book"></i>. Tambah SubKriteria</h3>
        </div>
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form id="contact" method="post" enctype="multipart/form-data" action="?page=subkriteria&aksi=proses_tambah">
                    <?php
                    echo "<input type=hidden name=id_kriteria value=" . $id_kriteria . " />";
                    ?>
                    <div class="form-top-left">
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value='<?php echo $nama; ?>' id="w3lName" placeholder="Nama" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label>Bobot</label>
                            <input type="number" class="form-control" name="bobot" value='<?php echo $nama; ?>' id="w3lName" placeholder="Bobot Subkriteria" required autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
        </div>
    <?php
    } else if ($_GET['aksi'] == "edit") {
        $id = $_GET['id'];
        $id_kriteria = $_GET['id_kriteria'];
        $query = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id_subkriteria='" . $id . "'");
        $result = mysqli_fetch_array($query);
        $nama = $result['nama'];
        $bobot = $result['bobot'];
    ?>
        <div class="section-heading mb-5">
            <h3><i class="fa fa-book"></i>. Edit SubKriteria</h3>
        </div>
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form id="contact" method="post" enctype="multipart/form-data" action="?page=subkriteria&aksi=proses_edit">
                    <?php
                    echo "<input type=hidden name=id_subkriteria value=" . $id . " />";
                    echo "<input type=hidden name=id_kriteria value=" . $id_kriteria . " />";
                    ?>
                    <div class="form-top">
                        <div class="form-top-left">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" value='<?php echo $nama; ?>' id="w3lName" placeholder="Nama" required autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label>
                                    <center>Bobot</center>
                                </label>
                                <input type="number" class="form-control" name="bobot" value='<?php echo $bobot; ?>' id="w3lName" placeholder="Bobot Subkriteria" required autocomplete="off">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
        </div>
    <?php
    } else if ($_GET['aksi'] == "proses_tambah") {
        $nama = $_POST['nama'];
        $bobot = $_POST['bobot'];
        $id_kriteria = $_POST['id_kriteria'];
        $query = "INSERT INTO subkriteria(id_kriteria, nama, bobot) VALUES('" . $id_kriteria . "','" . $nama . "', '" . $bobot . "')";
        $result = mysqli_query($koneksi, $query) or die(mysqli_error($query));
        if ($result) {
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Berhasil Menambah Data Subkriteria";
            header('location:home.php?page=subkriteria&id_kriteria=' . $id_kriteria);
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Menambah Data Subkriteria";
            header('location:home.php?page=subkriteria&id_kriteria=' . $id_kriteria);
        }
    } else if ($_GET['aksi'] == "proses_edit") {
        $id = $_POST['id_subkriteria'];
        $nama = $_POST['nama'];
        $bobot = $_POST['bobot'];
        $id_kriteria = $_POST['id_kriteria'];
        $query = "UPDATE subkriteria SET nama='" . $nama . "', bobot='" . $bobot . "' WHERE id_subkriteria='" . $id . "'";
        $result = mysqli_query($koneksi, $query) or die(mysqli_error($query));
        if ($result) {
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Berhasil Mengedit Data Subkriteria";
            header('location:home.php?page=subkriteria&id_kriteria=' . $id_kriteria);
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Mengedit Data Subkriteria";
            header('location:home.php?page=subkriteria&id_kriteria=' . $id_kriteria);
        }
    } else {
        $id_kriteria = $_GET['id_kriteria'];
        $query = "DELETE FROM subkriteria WHERE id_subkriteria = '" . $_GET['id'] . "'";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Data Subkriteria Berhasil Dihapus";
            header('location:home.php?page=subkriteria&id_kriteria=' . $id_kriteria);
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Menghapus Data Subkriteria";
            header('location:home.php?page=subkriteria&id_kriteria=' . $id_kriteria);
        }
    }
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='" . $_GET['id_kriteria'] . "'");
    $result = mysqli_fetch_array($query);
    $nama_kat = $result['nama'];
    ?>
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
    <div class="section-heading mb-4">
        <h3><i class="fa fa-book"></i>. Data SubKriteria</h3>
    </div>
    <!-- general form elements -->
    <div class="box box-success">
        <div class="box-header">
            <a href="?page=kriteria" class="btn btn-warning btn-sm">Kembali</a><br>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>Nama Subkriteria</th>
                                <th>
                                    <center>Bobot</center>
                                </th>
                                <th>
                                    <center><a <?php echo "href=?page=subkriteria&aksi=tambah&id_kriteria=" . $_GET['id_kriteria']; ?> class="btn btn-primary"><i class='fa fa-plus'></i> Tambah Subkriteria</a></center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id_kriteria='" . $_GET['id_kriteria'] . "'");
                            while ($result = mysqli_fetch_array($query)) {
                                $id = $result['id_subkriteria'];
                                $nama = $result['nama'];
                                $bobot = $result['bobot'];

                                echo "<tr>";
                                echo "<td style='vertical-align:middle'>" . $nama . "</td>";
                                echo "<td style='vertical-align:middle'><center>" . $bobot . "</center></td>";
                                echo "<td style='vertical-align:middle'>
                    <center>
                      <a class='btn btn-success btn-sm' href=?page=subkriteria&aksi=edit&id=" . $id . "&id_kriteria=" . $_GET['id_kriteria'] . "><i class='fa fa-cogs'></i> Edit</a> |
                      <a class='btn btn-danger btn-sm' href=?page=subkriteria&aksi=hapus&id=" . $id . "&id_kriteria=" . $_GET['id_kriteria'] . "><i class=' fa fa-trash-o'></i> Hapus</a>
                    </center>
                  </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
}
    ?>