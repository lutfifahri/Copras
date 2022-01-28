<?php
// memanggil library FPDF

use PDF as GlobalPDF;

require('fpdf.php');

class PDF extends FPDF
{
    // Page Header
    function Header()
    {
        // logo
        $this->Image('assets/images/logo-ptpn4.png', 10, 1);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Pindah baris
        $this->Ln(20);
        // buat garis horizontal
        $this->Line(10, 25, 200, 25);
    }

    // Page Content
    function Content()
    {
        // Pindah Posisi Ketengah Untuk Membuat Judul
        $this->Cell(65);
        // Judul
        $this->Cell(70, 10, 'DATA-DATA JENIS DAUN TEH ', 0, 0, 'C');
        // Pindah baris
        $this->Ln(5);
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->Cell(10, 8, '', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 10, 'C');
        $this->Cell(20, 6, 'NO', 1, 0, 'C');
        $this->Cell(170, 6, 'JENIS-JENIS DAUN TEH', 1, 1, 'C');

        $this->SetFont('Arial', '', 10);

        include 'koneksi.php';
        $bulans = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");

        $query2 = mysqli_query($koneksi, "SELECT * FROM daun");
        $no = 1;
        $rank = 1;
        if (mysqli_num_rows($query2) > 0) {
            while ($result2 = mysqli_fetch_array($query2)) {
                $this->Cell(20, 6, $no++, 1, 0, 'C');
                $this->Cell(170, 6, $result2['nama'], 1, 1);
                $rank++;
            }
        } else {
            echo "<tr>";
            echo "<td colspan=3 style='vertical-align:middle'><center>Data daun Masih Kosong...</center></td>";
            echo "<tr>";
        }

        // Pindah baris
        $this->Ln(10);
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 10, 'Penanggung Jawab (Admin)', 0, 1);
        $this->Ln(10);
        $this->Cell(0, 10, '( ___________________ )', 0, 1);
    }

    // Page Footer
    function Footer()
    {
        // Atur Posisi  1,5 cm dari bawah
        $this->SetY(-15);
        // Buat Garis Horizontal
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        // Arial Italic 9
        $this->SetFont('Arial', 'I', 9);
        // Nomor Halaman
        $this->Cell(0, 10, 'Halaman' . $this->PageNo() . ' dari {nb}', 0, 0, 'R');
    }
}

//Contoh pemanggilan class
// intance object dan memberikan pengaturan halaman PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content();
$pdf->Output();
