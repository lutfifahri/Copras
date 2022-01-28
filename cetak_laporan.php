<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A5');
// membuat halaman baru
$pdf->AddPage();

// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 14);
// mencetak string 
$pdf->Cell(190, 7, '<hr>', 0, 1, 'C');
$pdf->Cell(190, 7, 'SISTEM PENUNJANG KEPUTUSAN PEMILIHAN KUALITAS DAUN TEH TERBAIK', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, 'LAPORAN ANALISA DAUN MENGGUNAKAN METODE COPRAS', 0, 1, 'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 8, '', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 10, 'C');
$pdf->Cell(20, 6, 'NO', 1, 0, 'C');
$pdf->Cell(85, 6, 'JENIS-JENIS DAUN TEH', 1, 0, 'C');
$pdf->Cell(45, 6, 'NILAI', 1, 0, 'C');
$pdf->Cell(33, 6, 'RANGKING', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

include 'koneksi.php';
$bulans = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");

$query2 = mysqli_query($koneksi, "SELECT * FROM hasil, daun WHERE hasil.id_daun=daun.id_daun ORDER BY nilai DESC");
$no = 1;
$rank = 1;
if (mysqli_num_rows($query2) > 0) {
    while ($result2 = mysqli_fetch_array($query2)) {
        $pdf->Cell(20, 6, $no++, 1, 0, 'C');
        $pdf->Cell(85, 6, $result2['nama'], 1, 0);
        $pdf->Cell(45, 6, $result2['nilai'], 1, 0, 'C');
        $pdf->Cell(33, 6, $rank++, 1, 1, 'C');
    }
} else {
    echo "<tr>";
    echo "<td colspan=3 style='vertical-align:middle'><center>Data daun Masih Kosong...</center></td>";
    echo "<tr>";
}

$pdf->Output();
