<?php
$server = "localhost";
$username = "root";
$password = "12345678";
$database = "spk_copras";
// koneksi dan memilih database di server
$koneksi = mysqli_connect($server, $username, $password, $database);

$query = mysqli_query($koneksi, "SELECT * FROM kriteria");
while ($result = mysqli_fetch_array($query)) {

    $data = array([
        'data' => [
            'id' => $result['id_kriteria'],
            'nama' => $result['nama'],
            'bobot' => $result['bobot']
        ]
    ]);
}

echo json_encode($data);
