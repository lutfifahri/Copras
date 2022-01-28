<div class="col-12 grid-margin stretch-card">
    <h3><i class="fa fa-bar-chart"></i>. Analisa Metode COPRAS</h3><br>
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM daun");
    $row = mysqli_num_rows($query);
    ?>

    <div class="card">
        <!-- general form elements -->
        <div class="box box-success">
            <div class="box-header">
                <div class="col-md-12">
                    <div class="callout callout-success">
                        <h5><strong>Nilai Bobot Kriteria</strong></h5>
                        <table class="table table-bordered table-hover" id="example1">
                            <thead>
                                <tr>
                                    <th>Nilai Kecocokan</th>
                                    <th>Bilangan Bobot</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>0 - 20</td>
                                    <td>Sangat Buruk</td>
                                </tr>
                                <tr>
                                    <td scope="row">2</td>
                                    <td>21 - 40</td>
                                    <td>Buruk</td>
                                </tr>
                                <tr>
                                    <td scope="row">3</td>
                                    <td>41 - 60</td>
                                    <td>Cukup</td>
                                </tr>
                                <tr>
                                    <td scope="row">4</td>
                                    <td>61 - 80</td>
                                    <td>Bagus</td>
                                </tr>
                                <tr>
                                    <td scope="row">5</td>
                                    <td>81 - 100</td>
                                    <td>Sangat Bagus</td>
                                </tr>
                            </tbody>
                        </table>
                        <p>Keterangan :</p>
                        <ul>
                            <li>Dari masing-masing kriteria tersebut akan ditentukan bobot-bobotnya. Setiap kriteria pada bobot akan diberikan nilai diatas</li>
                            <li>Berdasarkan data-data yang didapat dalam penelitian, maka data alternatif (Jenis Daun Teh) dan kriteria dapat dilihat
                                tabel dibawah ini
                            </li>
                        </ul>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <h3 class="box-title">Penyederhanaan Rating Nilai </h3>
                <table class="table table-bordered" style="background-color:white;font-size:13px;">
                    <thead>
                        <tr>
                            <th>Nama Jenis Daun</th>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
                            while ($result = mysqli_fetch_array($query)) {
                                echo "<th>" . $result['nama'] . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query2 = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun");
                        while ($result2 = mysqli_fetch_array($query2)) {
                            $id_daun = $result2['id_daun'];
                            $nama = $result2['nama'];
                            echo "<tr>";
                            echo "<td>$nama</td>";
                            $query3 = mysqli_query($koneksi, "SELECT subkriteria.nama as subkriteria
							FROM kriteria_daun, subkriteria
							WHERE kriteria_daun.id_subkriteria=subkriteria.id_subkriteria AND kriteria_daun.id_daun='" . $id_daun . "'");
                            while ($result3 = mysqli_fetch_array($query3)) {
                                $s = $result3['subkriteria'];
                                echo "<td>$s</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="box box-success">
            <div class="box-header">
                <div class="col-md-12">
                    <div class="callout callout-success">
                        <p>Untuk menyelesaikan masalah diatas dengan Metode COPRAS akan dilakukan dengan langkah-langkah yang telah dijelaskan.</p>
                    </div>
                </div>
                <br>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <h4 class="sub-title"><strong>1. Tabel Matriks Keputusan</strong></h4>
                <table class="table table-bordered" style="background-color:white;font-size:13px;">
                    <thead>
                        <tr>
                            <th>Nama Jenis Daun</th>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
                            while ($result = mysqli_fetch_array($query)) {
                                echo "<th>" . $result['nama'] . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total1 = array();
                        $query2 = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun");
                        while ($result2 = mysqli_fetch_array($query2)) {
                            $id_daun = $result2['id_daun'];
                            $nama = $result2['nama'];
                            echo "<tr>";
                            echo "<td>$nama</td>";
                            $query3 = mysqli_query($koneksi, "SELECT subkriteria.bobot as subkriteria
							FROM kriteria_daun, subkriteria
							WHERE kriteria_daun.id_subkriteria=subkriteria.id_subkriteria AND kriteria_daun.id_daun='" . $id_daun . "'");
                            $i = 0;
                            while ($result3 = mysqli_fetch_array($query3)) {
                                $s = $result3['subkriteria'];
                                echo "<td>$s</td>";
                                $total1[$i] += $s;
                                $i++;
                            }
                            echo "</tr>";
                        }
                        echo "<tr class='bg-primary font-weight-medium text-white'>";
                        echo "<td>Total</td>";
                        for ($i = 0; $i < count($total1); $i++) {
                            echo "<td>" . $total1[$i] . "</td>";
                        }
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="box box-success">
                <div class="box-header">
                    <div class="col-md-12">
                        <div class="callout callout-success">
                            <h5><strong>Keterangan :</strong></h5>
                            <ul>
                                <li><strong>Contoh :</strong> Hasil nilai Total <strong>23</strong>, Didapat dari Kriteria <strong>Aroma</strong> yaitu : <strong>5 + 4 + 5 + 4 + 5 = 23</strong> </li>
                                <li>Begitu Seterusnya</li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <h4 class="sub-title"><strong>2. Tabel Nomalisasi Matriks X</strong></h4>
                    <table class="table table-bordered" style="background-color:white;font-size:13px;">
                        <thead>
                            <tr>
                                <th>Nama Jenis Daun</th>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
                                while ($result = mysqli_fetch_array($query)) {
                                    echo "<th>" . $result['nama'] . "</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query2 = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun");
                            while ($result2 = mysqli_fetch_array($query2)) {
                                $id_daun = $result2['id_daun'];
                                $nama = $result2['nama'];
                                $hasil = 1.0;
                                echo "<tr>";
                                echo "<td>$nama</td>";
                                $query4 = mysqli_query($koneksi, "SELECT SUM(bobot) as total FROM kriteria");
                                $result4 = mysqli_fetch_array($query4);
                                $total = $result4['total'];
                                $i = 0;
                                $query3 = mysqli_query($koneksi, "SELECT kriteria.bobot as bobot, kriteria_daun.id_kriteria as id_kriteria, subkriteria.bobot as subkriteria
							FROM kriteria_daun, subkriteria, kriteria WHERE kriteria_daun.id_kriteria=kriteria.id_kriteria
							AND kriteria_daun.id_subkriteria=subkriteria.id_subkriteria AND kriteria_daun.id_daun='" . $id_daun . "'");
                                while ($result3 = mysqli_fetch_array($query3)) {
                                    $id = $result3['id_kriteria'];
                                    $sub = $result3['subkriteria'];

                                    $nilai = $sub / $total1[$i];
                                    $nilai = round($nilai, 2);
                                    echo "<td>" . $nilai . "</td>";

                                    $i++;
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    $query = "TRUNCATE TABLE hasil";
    $result = mysqli_query($koneksi, $query);

    ?>
    <div class="card">
        <div class="box box-success">
            <div class="box-header">
                <div class="col-md-12">
                    <div class="callout callout-success">
                        <p>Hasil nilai : 0.22, 0.17, 0.22, 0.17, 0.22 ?</p>
                        <h5><strong>Keterangan :</strong></h5>
                        <ul>
                            <li>Pada langkah <strong>1. Tabel Matriks Keputusan</strong> terdapat nilai kriteria (Aroma) Kebawah Yaitu : <strong>5 + 4 + 5 + 4 + 5 = 23</strong> </li>
                            <p>Sehingga :</p>
                            <li>Daun Teh TRI : 5 / 23 = 0.22</li>
                            <li>Daun Teh BT : 4 / 23 = 0.17</li>
                            <li>Daun Teh HITAM : 5 / 23 = 0.22</li>
                            <li>Daun Teh GAMBUNG : 4 / 23 = 0.17</li>
                            <li>Daun Teh HIJAU : 5 / 23 = 0.22</li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <h4 class="sub-title"><strong>3. Tabel Matriks Normalisasi Tertimbang</strong> yang di Normalisasikan = X<sub>ij</sub> * W<sub>J</sub></h4>
                <table class="table table-bordered" style="background-color:white;font-size:13px;">
                    <thead>
                        <tr>
                            <th>Nama Jenis Daun</th>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria");
                            while ($result = mysqli_fetch_array($query)) {
                                echo "<th>" . $result['nama'] . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query2 = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun");
                        while ($result2 = mysqli_fetch_array($query2)) {
                            $id_daun = $result2['id_daun'];
                            $nama = $result2['nama'];
                            $hasil = 1.0;
                            echo "<tr>";
                            echo "<td>$nama</td>";
                            $query4 = mysqli_query($koneksi, "SELECT SUM(bobot) as total FROM kriteria");
                            $result4 = mysqli_fetch_array($query4);
                            $total = $result4['total'];
                            $i = 0;
                            $query3 = mysqli_query($koneksi, "SELECT kriteria.bobot as bobot, kriteria_daun.id_kriteria as id_kriteria, subkriteria.bobot as subkriteria
								FROM kriteria_daun, subkriteria, kriteria WHERE kriteria_daun.id_kriteria=kriteria.id_kriteria
								AND kriteria_daun.id_subkriteria=subkriteria.id_subkriteria AND kriteria_daun.id_daun='" . $id_daun . "'");
                            while ($result3 = mysqli_fetch_array($query3)) {
                                $id = $result3['id_kriteria'];
                                $sub = $result3['subkriteria'];
                                $bobot = $result3['bobot'];

                                $nilai = $sub / $total1[$i];
                                $nilai = round($nilai, 2);
                                $nilai *= $bobot;
                                $nilai = round($nilai, 2);
                                echo "<td>" . $nilai . "</td>";

                                $i++;
                            }
                            echo "</tr>";
                        }
                        // echo "<tr>";
                        // 	echo "<td></td>";
                        // 	echo "<td><strong>Max</strong></td>";
                        // 	echo "<td><strong>".$s_max."</strong></td>";
                        // 	echo "<td><strong>".$r_max."</strong></td>";
                        // echo "<tr>";
                        // echo "<tr>";
                        // 	echo "<td></td>";
                        // 	echo "<td><strong>Min</strong></td>";
                        // 	echo "<td><strong>".$s_min."</strong></td>";
                        // 	echo "<td><strong>".$r_min."</strong></td>";
                        // echo "<tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="box box-success">
                <div class="box-header">
                    <div class="col-md-12">
                        <div class="callout callout-success">
                            <p>Hasil nilai : 4.4, 3.4, 4.4, 3.4, 4.4 ?</p>
                            <h5><strong>Keterangan :</strong></h5>
                            <ul>
                                <li><strong>X</strong><sub>ij</sub> = Nilai yang terdapat pada Tabel Normalisasi Matriks X Diatas.</li>
                                <li><strong>W</strong><sub>J</sub> = Bobot Nilai Yang ditentukan Perusahaan yaitu : <strong>20 , 20, 10, 50</strong></li>
                                <li>Pada langkah <strong>2. Tabel Normalisasi Matriks X</strong> terdapat hasil nilai kriteria (Aroma) Kebawah yaitu : <strong>0.22 , 0.17, 0.22, 0.17, 0.22</strong> </li>
                                <p>Sehingga : <strong>X <sub>ij</sub></strong> * <strong>W <sub>j</sub></strong></p>
                                <li>Daun Teh TRI : 0.22 * 20 = <strong>4.4</strong></li>
                                <li>Daun Teh BT : 0.17 * 20 = <strong>3.4</strong></li>
                                <li>Daun Teh HITAM : 0.22 * 20 = <strong>4.4</strong></li>
                                <li>Daun Teh GAMBUNG : 0.17 * 20 = <strong>3.4</strong></li>
                                <li>Daun Teh HIJAU : 0.22 * 20 = <strong>4.4</strong></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <h4 class="sub-title"><strong>4. Tabel Perhitungan S+, S-</strong></h4>
                    <table class="table table-bordered" style="background-color:white;font-size:13px;">
                        <thead>
                            <tr>
                                <th>Nama Jenis Daun</th>
                                <th>S+</th>
                                <th>S-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s_plus = 0.0;
                            $s_minus = 0.0;
                            $total1_sminus = 0.0;
                            $j = 0;
                            $query2 = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun");
                            while ($result2 = mysqli_fetch_array($query2)) {
                                $id_daun = $result2['id_daun'];
                                $nama = $result2['nama'];
                                $hasil = 1.0;
                                $plus = 0.0;
                                $minus = 0.0;
                                $p_splus = "(";
                                $p_sminus = "(";
                                echo "<tr>";
                                echo "<td>$nama</td>";
                                $query4 = mysqli_query($koneksi, "SELECT SUM(bobot) as total FROM kriteria");
                                $result4 = mysqli_fetch_array($query4);
                                $total = $result4['total'];
                                $i = 0;
                                $query3 = mysqli_query($koneksi, "SELECT kriteria.bobot as bobot, kriteria.kelompok as kelompok,
							kriteria_daun.id_kriteria as id_kriteria, subkriteria.bobot as subkriteria
							FROM kriteria_daun, subkriteria, kriteria WHERE kriteria_daun.id_kriteria=kriteria.id_kriteria
							AND kriteria_daun.id_subkriteria=subkriteria.id_subkriteria AND kriteria_daun.id_daun='" . $id_daun . "'");
                                while ($result3 = mysqli_fetch_array($query3)) {
                                    $id = $result3['id_kriteria'];
                                    $sub = $result3['subkriteria'];
                                    $bobot = $result3['bobot'];
                                    $kelompok = $result3['kelompok'];

                                    $nilai = $sub / $total1[$i];
                                    $nilai = round($nilai, 2);
                                    $nilai *= $bobot;
                                    $nilai = round($nilai, 2);

                                    if ($kelompok == "Menguntungkan") {
                                        $p_splus .= $nilai . " + ";
                                        $plus += $nilai;
                                    } else {
                                        $p_sminus .= $nilai . " + ";
                                        $minus += $nilai;
                                    }

                                    $i++;
                                }
                                $psplus = substr($p_splus, 0, (strlen($p_splus) - 2)) . ")";
                                $psminus = substr($p_sminus, 0, (strlen($p_sminus) - 2)) . ")";
                                $s_plus += $plus;
                                $s_minus += $minus;

                                $val = (1 / $minus);
                                $total1_sminus += $val;

                                echo "<td>" . $psplus . " = <strong>" . $plus . "</strong></td>";
                                echo "<td>" . $psminus . " = <strong>" . $minus . "</strong></td>";
                                echo "</tr>";
                                $j++;
                            }
                            echo "<tr class='bg-primary text-white'>";
                            echo "<td>Total</td>";
                            echo "<td>-</td>";
                            echo "<td><strong>" . $s_minus . "</strong></td>";
                            echo "</tr>";
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="box box-success">
                <div class="box-header">
                    <div class="col-md-12">
                        <div class="callout callout-success">
                            <h5><strong>Keterangan :</strong></h5>
                            <ul>
                                <li><strong>S</strong><sub>+</sub> = Aroma (4.4) + Warna (4.4) + Luas (7.5) = 16.3 </li>
                                <li><strong>S</strong><sub>-</sub> = Rasa (1.9)</li>

                            </ul>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <h4 class="sub-title"><strong>5. Perhitungann Bobot S- Relative</strong></h5>
                        <table class="table table-bordered" style="background-color:white;font-size:13px;">
                            <thead>
                                <tr>
                                    <th>Nama Jenis Daun</th>
                                    <th>1 / S-i</th>
                                    <th>S-i * Total S-i</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = 0;
                                $query2 = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun");
                                while ($result2 = mysqli_fetch_array($query2)) {
                                    $id_daun = $result2['id_daun'];
                                    $nama = $result2['nama'];
                                    $hasil = 1.0;
                                    $plus = 0.0;
                                    $minus = 0.0;
                                    $p_splus = "(";
                                    $p_sminus = "(";
                                    echo "<tr>";
                                    echo "<td>$nama</td>";
                                    $query4 = mysqli_query($koneksi, "SELECT SUM(bobot) as total FROM kriteria");
                                    $result4 = mysqli_fetch_array($query4);
                                    $total = $result4['total'];
                                    $i = 0;
                                    $query3 = mysqli_query($koneksi, "SELECT kriteria.bobot as bobot, kriteria.kelompok as kelompok,
							kriteria_daun.id_kriteria as id_kriteria, subkriteria.bobot as subkriteria
							FROM kriteria_daun, subkriteria, kriteria WHERE kriteria_daun.id_kriteria=kriteria.id_kriteria
							AND kriteria_daun.id_subkriteria=subkriteria.id_subkriteria AND kriteria_daun.id_daun='" . $id_daun . "'");
                                    while ($result3 = mysqli_fetch_array($query3)) {
                                        $id = $result3['id_kriteria'];
                                        $sub = $result3['subkriteria'];
                                        $bobot = $result3['bobot'];
                                        $kelompok = $result3['kelompok'];

                                        $nilai = $sub / $total1[$i];
                                        $nilai = round($nilai, 2);
                                        $nilai *= $bobot;
                                        $nilai = round($nilai, 2);

                                        if ($kelompok == "Menguntungkan") {
                                            $plus += $nilai;
                                        } else {
                                            $minus += $nilai;
                                        }

                                        $i++;
                                    }
                                    $val = 1 / $minus;
                                    $val = round($val, 2);

                                    $val2 = $minus * $total1_sminus;
                                    $val2 = round($val2, 2);

                                    echo "<td>1 / " . $minus . " = <strong>" . $val . "</strong></td>";
                                    echo "<td>" . $minus . " * " . $total1_sminus . " = <strong>" . $val2 . "</strong></td>";
                                    echo "</tr>";
                                    $j++;
                                }
                                echo "<tr class='bg-primary text-white'>";
                                echo "<td>Total</td>";
                                echo "<td>$total1_sminus</td>";
                                echo "<td>-</td>";
                                echo "</tr>";
                                ?>
                            </tbody>
                        </table>
                </div>
            </div>

            <div class="card">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <br>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <h4 class="sub-title"><strong>6. Tabel Perhitungan Q</strong></h4>
                        <table class="table table-bordered" style="background-color:white;font-size:13px;">
                            <thead>
                                <tr>
                                    <th>Nama Jenis Daun</th>
                                    <th>(Total S-) / (S-i * Total S-i) + (S+)</th>
                                    <th>Nilai Q</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = 0;
                                $maxq = 0.0;
                                $query2 = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun");
                                while ($result2 = mysqli_fetch_array($query2)) {
                                    $id_daun = $result2['id_daun'];
                                    $nama = $result2['nama'];
                                    $hasil = 1.0;
                                    $plus = 0.0;
                                    $minus = 0.0;

                                    echo "<tr>";
                                    echo "<td>$nama</td>";
                                    $query4 = mysqli_query($koneksi, "SELECT SUM(bobot) as total FROM kriteria");
                                    $result4 = mysqli_fetch_array($query4);
                                    $total = $result4['total'];
                                    $i = 0;
                                    $query3 = mysqli_query($koneksi, "SELECT kriteria.bobot as bobot, kriteria.kelompok as kelompok,
							kriteria_daun.id_kriteria as id_kriteria, subkriteria.bobot as subkriteria
							FROM kriteria_daun, subkriteria, kriteria WHERE kriteria_daun.id_kriteria=kriteria.id_kriteria
							AND kriteria_daun.id_subkriteria=subkriteria.id_subkriteria AND kriteria_daun.id_daun='" . $id_daun . "'");
                                    while ($result3 = mysqli_fetch_array($query3)) {
                                        $id = $result3['id_kriteria'];
                                        $sub = $result3['subkriteria'];
                                        $bobot = $result3['bobot'];
                                        $kelompok = $result3['kelompok'];

                                        $nilai = $sub / $total1[$i];
                                        $nilai = round($nilai, 2);
                                        $nilai *= $bobot;
                                        $nilai = round($nilai, 2);

                                        if ($kelompok == "Menguntungkan") {
                                            $plus += $nilai;
                                        } else {
                                            $minus += $nilai;
                                        }

                                        $i++;
                                    }
                                    $val = 1 / $minus;
                                    $val = round($val, 2);

                                    $val2 = $minus * $total1_sminus;
                                    $val2 = round($val2, 2);

                                    $q = ($s_minus / $val2) + $plus;
                                    $q = round($q, 4);

                                    if ($q > $maxq) {
                                        $maxq = $q;
                                    }
                                    echo "<td>(" . $s_minus . ") / (" . $val2 . ") + (" . $plus . ")</td>";
                                    echo "<td><strong>" . $q . "</strong></td>";
                                    echo "</tr>";
                                    $j++;
                                }

                                echo "<tr class='bg-primary text-white'>";
                                echo "<td><strong>Max Q</strong></td>";
                                echo "<td></td>";
                                echo "<td><strong>" . $maxq . "</strong></td>";
                                echo "</tr>";
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
            $j = 0;
            //$maxq = 0.0;
            $q_max = array();
            $query2 = mysqli_query($koneksi, "SELECT * FROM daun ORDER BY id_daun");
            while ($result2 = mysqli_fetch_array($query2)) {
                $id_daun = $result2['id_daun'];
                $nama = $result2['nama'];
                $hasil = 1.0;
                $plus = 0.0;
                $minus = 0.0;

                // echo "<tr>";
                // echo "<td>$nama</td>";
                $query4 = mysqli_query($koneksi, "SELECT SUM(bobot) as total FROM kriteria");
                $result4 = mysqli_fetch_array($query4);
                $total = $result4['total'];
                $i = 0;
                $query3 = mysqli_query($koneksi, "SELECT kriteria.bobot as bobot, kriteria.kelompok as kelompok,
					kriteria_daun.id_kriteria as id_kriteria, subkriteria.bobot as subkriteria
					FROM kriteria_daun, subkriteria, kriteria WHERE kriteria_daun.id_kriteria=kriteria.id_kriteria
					AND kriteria_daun.id_subkriteria=subkriteria.id_subkriteria AND kriteria_daun.id_daun='" . $id_daun . "'");
                while ($result3 = mysqli_fetch_array($query3)) {
                    $id = $result3['id_kriteria'];
                    $sub = $result3['subkriteria'];
                    $bobot = $result3['bobot'];
                    $kelompok = $result3['kelompok'];

                    $nilai = $sub / $total1[$i];
                    $nilai = round($nilai, 2);
                    $nilai *= $bobot;
                    $nilai = round($nilai, 2);

                    if ($kelompok == "Menguntungkan") {
                        $plus += $nilai;
                    } else {
                        $minus += $nilai;
                    }

                    $i++;
                }
                $val = 1 / $minus;
                $val = round($val, 2);

                $val2 = $minus * $total1_sminus;
                $val2 = round($val2, 2);

                $q = ($s_minus / $val2) + $plus;
                $q = round($q, 4);

                $p = ($q / $maxq);
                $p = round($p, 4);
                $p *= 100;

                // echo "<td>".$q." / ".$maxq."</td>";
                // echo "<td><strong>".$p."</strong></td>";
                // echo "</tr>";

                $q_max[$j] = $q . " / " . $maxq;

                $query = "INSERT INTO hasil(id_daun, perhitungan, nilai) VALUES('" . $id_daun . "', '" . $q . " / " . $maxq . "', '" . $p . "')";
                $result = mysqli_query($koneksi, $query);

                $j++;
            }
            ?>

            <div class="card">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <br>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <h4 class="sub-title"><strong>7. Tabel Perhitungan Performance Index (P)</strong></h4>
                        <table class="table table-bordered" style="background-color:white;font-size:13px;">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama Jenis Daun</th>
                                    <th>Q / Max Q</th>
                                    <th>Nilai P</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = 0;
                                //$maxq = 0.0;
                                $rank = 1;
                                $query2 = mysqli_query($koneksi, "SELECT * FROM daun, hasil WHERE daun.id_daun=hasil.id_daun ORDER BY hasil.nilai DESC");
                                while ($result2 = mysqli_fetch_array($query2)) {
                                    $id_daun = $result2['id_daun'];
                                    $nama = $result2['nama'];
                                    $nilai = $result2['nilai'];
                                    $perhitungan = $result2['perhitungan'];

                                    echo "<tr>";
                                    echo "<td>" . $rank . "</td>";
                                    echo "<td>" . $nama . "</td>";
                                    echo "<td>" . $perhitungan . "</td>";
                                    echo "<td><strong>" . $nilai . "</strong></td>";
                                    echo "</tr>";

                                    $rank++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <script src="assets/js/chart/Chart.min.js"></script>
                <div class="card">
                    <div class="box box-success">
                        <div class="box-header">
                            <div class="col-md-12">
                                <div class="callout callout-success">
                                    <b>Berdasarkan perhitungan Performance Index (P) Tersebut, maka didapat daun teh terbaik yaitu :</b>
                                    <ul>
                                        <?php
                                        $j = 0;
                                        //$maxq = 0.0;
                                        $rank = 1;
                                        $query2 = mysqli_query($koneksi, "SELECT * FROM daun, hasil WHERE daun.id_daun=hasil.id_daun ORDER BY hasil.nilai DESC LIMIT 1");
                                        while ($result2 = mysqli_fetch_array($query2)) {
                                            $id_daun = $result2['id_daun'];
                                            $nama = $result2['nama'];
                                            $nilai = $result2['nilai'];
                                            $perhitungan = $result2['perhitungan'];

                                            echo "<li><strong>Nama Jenis Daun :</strong> " . $nama . "</li>";
                                            echo "<li><strong>Q / Max Q  : </strong>" . $perhitungan . "</li>";
                                            echo "<li><strong>Nilai P </strong> : " . $nilai . "</li>";
                                        }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <h1 class="h3 mb-2 text-gray-800">Grafik Perangkingan Jenis Daun</h1>
                            <!-- Content Row -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <!-- Area Chart -->
                                    <div class="card shadow mb-8">
                                        <div class="card-body">
                                            <div class="chart-area">
                                                <canvas id="myAreaChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        Chart.defaults.global.defaultFontFamily = 'Segoe UI', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#858796';

                        function number_format(number, decimals, dec_point, thousands_sep) {
                            // *     example: number_format(1234.56, 2, ',', ' ');
                            // *     return: '1 234,56'
                            number = (number + '').replace(',', '').replace(' ', '');
                            var n = !isFinite(+number) ? 0 : +number,
                                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                                s = '',
                                toFixedFix = function(n, prec) {
                                    var k = Math.pow(10, prec);
                                    return '' + Math.round(n * k) / k;
                                };
                            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                            if (s[0].length > 3) {
                                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                            }
                            if ((s[1] || '').length < prec) {
                                s[1] = s[1] || '';
                                s[1] += new Array(prec - s[1].length + 1).join('0');
                            }
                            return s.join(dec);
                        }

                        // Area Chart Example
                        var ctx = document.getElementById("myAreaChart");
                        var myLineChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                <?php
                                $query = mysqli_query($koneksi, "SELECT daun.nama as nama, hasil.nilai as total FROM daun, hasil WHERE daun.id_daun=hasil.id_daun ORDER BY hasil.nilai DESC");
                                $row = mysqli_num_rows($query);
                                $i = 0;

                                $init_label = "labels: [";
                                $nama = array();
                                $total = array();
                                // $nama_sales = array();
                                while ($result = mysqli_fetch_array($query)) {
                                    //$nama_sales[$i] = $result['nama'];
                                    if ($i == ($row - 1)) {
                                        $init_label .= "'" . $result['nama'] . "'],";
                                    } else {
                                        $init_label .= "'" . $result['nama'] . "',";
                                    }
                                    $nama[$i] = $result['nama'];
                                    $total[$i] = $result['total'];
                                    $i++;
                                }
                                echo $init_label;
                                ?>
                                //labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "Skor",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.5)",
                                    borderColor: "rgba(78, 115, 223, 1)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,

                                    //data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                                    <?php
                                    $init_label = "data: [";
                                    for ($i = 0; $i < count($nama); $i++) {
                                        //$bul = $$total[$i][$i];
                                        if ($i == ((count($nama) - 1))) {
                                            $init_label .= "'" . $total[$i] . "'],";
                                        } else {
                                            $init_label .= "'" . $total[$i] . "',";
                                        }
                                    }
                                    echo $init_label;
                                    ?>
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                scales: {
                                    xAxes: [{
                                        time: {
                                            unit: 'date'
                                        },
                                        gridLines: {
                                            display: false,
                                            drawBorder: false
                                        },
                                        ticks: {
                                            maxTicksLimit: 10
                                        }
                                    }],
                                    yAxes: [{
                                        ticks: {
                                            maxTicksLimit: 10,
                                            padding: 10,
                                            // Include a dollar sign in the ticks
                                            callback: function(value, index, values) {
                                                return number_format(value);
                                            }
                                        },
                                        gridLines: {
                                            color: "rgb(234, 236, 244)",
                                            zeroLineColor: "rgb(234, 236, 244)",
                                            drawBorder: false,
                                            borderDash: [2],
                                            zeroLineBorderDash: [2]
                                        }
                                    }],
                                },
                                legend: {
                                    display: false
                                },
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    intersect: false,
                                    mode: 'index',
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function(tooltipItem, chart) {
                                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ':' + number_format(tooltipItem.yLabel);
                                        }
                                    }
                                }
                            }
                        });
                    </script>

                    <a class="btn btn-warning col-md-12" target="_blank" href="laporan_analisa.php">Cetak Laporan</a><br><br>
                </div>
            </div>