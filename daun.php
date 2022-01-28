<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == "tambah") {
?>
        <div class="section-heading">
            <h4>Tambah Jenis Daun</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form id="contact" method="post" enctype="multipart/form-data" action="?page=daun&aksi=proses_tambah">
                    <div class="form-top">
                        <div class="form-top-left">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value='<?php echo $nama; ?>' id="w3lName" placeholder="Nama" required autocomplete="off">
                            </div>
                            <?php
                            $hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
                            while ($baris = mysqli_fetch_array($hasil)) {
                                $idK = $baris['id_kriteria'];
                                $labelK = $baris['nama'];
                                echo "<div class='form-group mb-3'>
  							     <label>" . $labelK . "</label>";
                                echo "<select name=" . $idK . " class=form-control>";
                                $hasil2 = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id_kriteria='" . $idK . "' ORDER BY bobot DESC");
                                while ($baris2 = mysqli_fetch_array($hasil2)) {
                                    echo "<option value=" . $baris2['id_subkriteria'] . ">" . $baris2['nama'] . "</option>";
                                }
                                echo "</select></div>";
                            }
                            ?>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button> |
                        <a href="?page=daun" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
        </div>
    <?php
    } else if ($_GET['aksi'] == "edit") {
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT * FROM daun WHERE id_daun='" . $id . "'");
        $result = mysqli_fetch_array($query);
        $nama = $result['nama'];
        $bobot = $result['bobot'];
    ?>
        <div class="section-heading mb-5">
            <h3><i class="fa fa-male"></i>. Edit Jenis Daun</h3>
        </div>
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form id="contact" method="post" enctype="multipart/form-data" action="?page=daun&aksi=proses_edit">
                    <?php
                    echo "<input type=hidden name=id_daun value=" . $id . " />";
                    ?>
                    <div class="form-top">
                        <div class="form-top-left">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value='<?php echo $nama; ?>' id="w3lName" placeholder="Nama" required autocomplete="off">
                            </div>
                            <?php
                            $hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
                            while ($baris = mysqli_fetch_array($hasil)) {
                                $idK = $baris['id_kriteria'];
                                $labelK = $baris['nama'];
                                $hasil3 = mysqli_query($koneksi, "SELECT * FROM kriteria_daun WHERE id_kriteria='" . $idK . "' AND id_daun='" . $id . "'");
                                $result3 = mysqli_fetch_array($hasil3);
                                $sub = $result3['id_subkriteria'];
                                echo "<div class='form-group mb-3'>
								    <label>" . $labelK . "</label>";
                                echo "<select name=" . $idK . " class=form-control>";
                                $hasil2 = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id_kriteria='" . $idK . "' ORDER BY bobot DESC");
                                while ($baris2 = mysqli_fetch_array($hasil2)) {
                                    if ($baris2['id_subkriteria'] == $sub) {
                                        echo "<option value=" . $baris2['id_subkriteria'] . " selected>" . $baris2['nama'] . "</option>";
                                    } else {
                                        echo "<option value=" . $baris2['id_subkriteria'] . ">" . $baris2['nama'] . "</option>";
                                    }
                                }
                                echo "</select></div>";
                            }
                            ?>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button> |
                        <a href="?page=daun" class="btn btn-primary">Cancel</a>
                </form>
            </div>
        </div>
        </div>
    <?php
    } else if ($_GET['aksi'] == "proses_tambah") {
        $nama = $_POST['nama'];

        $query = "INSERT INTO daun(nama) VALUES('" . $nama . "')";
        $result = mysqli_query($koneksi, $query) or die(mysqli_error($query));
        if ($result) {
            $query = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun DESC");
            $result = mysqli_fetch_array($query);
            $id_daun = $result['id_daun'];
            $hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
            while ($baris = mysqli_fetch_array($hasil)) {
                $idK = $baris['id_kriteria'];
                $idS = $_POST[$idK];
                $query3 = "INSERT INTO kriteria_daun(id_daun, id_kriteria, id_subkriteria)
				VALUES('" . $id_daun . "','" . $idK . "','" . $idS . "')";
                $result3 = mysqli_query($koneksi, $query3);
            }
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Berhasil Menambah Data Jenis Daun";
            header('location:home.php?page=daun');
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Menambah Data Jenis Daun";
            header('location:home.php?page=daun');
        }
    } else if ($_GET['aksi'] == "proses_edit") {
        $id = $_POST['id_daun'];
        $nama = $_POST['nama'];

        $query = "UPDATE daun SET nama='" . $nama . "' WHERE id_daun='" . $id . "'";
        $result = mysqli_query($koneksi, $query) or die(mysqli_error($query));
        if ($result) {
            $query2 = "DELETE FROM kriteria_daun WHERE id_daun='" . $_POST['id_daun'] . "'";
            $result2 = mysqli_query($koneksi, $query2);
            $hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
            while ($baris = mysqli_fetch_array($hasil)) {
                $idK = $baris['id_kriteria'];
                $idS = $_POST[$idK];
                $query3 = "INSERT INTO kriteria_daun(id_daun, id_kriteria, id_subkriteria)
				VALUES('" . $id . "','" . $idK . "','" . $idS . "')";
                $result3 = mysqli_query($koneksi, $query3);
            }
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Berhasil Mengedit Data Jenis Daun";
            header('location:home.php?page=daun');
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Mengedit Data Jenis Daun";
            header('location:home.php?page=daun');
        }
    } else {
        $query = "DELETE FROM daun WHERE id_daun = '" . $_GET['id'] . "'";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            $_SESSION['success'] = 1;
            $_SESSION['message'] = "Data Jenis Daun Berhasil Dihapus";
            header('location:home.php?page=daun');
        } else {
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Gagal Menghapus Data Jenis Daun";
            header('location:home.php?page=daun');
        }
    }
} else {
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
    <div class="section-heading mb-5">
        <h3><i class="fa fa-male"></i>. Data Jenis Daun</h3>
    </div>
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title"></h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <table class="table-responsiv table-bordered" width="100%">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>Nama Jenis Daun</th>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
                        while ($result = mysqli_fetch_array($query)) {
                            echo "<th><center>" . $result['nama'] . "</center></th>";
                        }
                        ?>
                        <th>
                            <center> <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1"><i class='fa fa-plus'></i> Tambah</button></center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM daun");
                    while ($result = mysqli_fetch_array($query)) {
                        $id = $result['id_daun'];
                        $nama = $result['nama'];

                        echo "<tr>";
                        echo "<td style='vertical-align:middle'>" . $nama . "</td>";
                        $query2 = mysqli_query($koneksi, "SELECT s.nama as sub FROM subkriteria s, kriteria_daun kp WHERE kp.id_daun='" . $id . "' AND s.id_subkriteria=kp.id_subkriteria ORDER BY kp.id_kriteria");
                        while ($result2 = mysqli_fetch_array($query2)) {
                            echo "<td style='vertical-align:middle'><center>$result2[sub]</center></td>";
                        }
                        echo "<td style='vertical-align:middle'>
                    <center>
                      <a class='btn btn-success btn-sm' href=?page=daun&aksi=edit&id=" . $id . "><i class='fa fa-cogs'></i> Edit</a> |
                      <a class='btn btn-danger btn-sm' href=?page=daun&aksi=hapus&id=" . $id . "><i class=' fa fa-trash-o'></i> Hapus</a>
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
                <form id="contact" method="post" enctype="multipart/form-data" action="?page=daun&aksi=proses_tambah">
                    <div class="form-top">
                        <div class="form-top-left">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" id="w3lName" placeholder="Nama" required autocomplete="off">
                            </div>
                            <?php
                            $hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
                            while ($baris = mysqli_fetch_array($hasil)) {
                                $idK = $baris['id_kriteria'];
                                $labelK = $baris['nama'];
                                echo "<div class='form-group mb-3'>
  							     <label>" . $labelK . "</label>";
                                echo "<select name=" . $idK . " class=form-control>";
                                $hasil2 = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id_kriteria='" . $idK . "' ORDER BY bobot DESC");
                                while ($baris2 = mysqli_fetch_array($hasil2)) {
                                    echo "<option value=" . $baris2['id_subkriteria'] . ">" . $baris2['nama'] . "</option>";
                                }
                                echo "</select></div>";
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div>