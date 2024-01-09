<?php
// memanggil library FPDF
session_start();
require('library/fpdf.php');
include './auth/koneksi.php';
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
 
$pdf->SetFont('Times','B',13);
$pdf->Cell(200,10,'Cetak Jurnal Umum',0,0,'C');
 
$pdf->Cell(20,7,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(20,7,'Tanggal',1,0,'C');
$pdf->Cell(20,7,'No Reff' ,1,0,'C');
$pdf->Cell(60,7,'Akun',1,0,'C');
$pdf->Cell(30,7,'Debit',1,0,'C');
$pdf->Cell(30,7,'Kredit',1,0,'C');


 
 
$pdf->Cell(20,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
$query = mysqli_query($koneksi,"SELECT  * FROM transaksi INNER JOIN akun ON transaksi.no_akun = akun.no_reff WHERE transaksi.user_id={$_SESSION['user_id']} ORDER BY tgl_transaksi ASC") or die($koneksi);


$tmp_date = "";
while($data = mysqli_fetch_array($query)){
    if($data['jenis']=="Debit")
    {
  $pdf->Cell(20,7, $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] : "", 1, 0, 'C');
  $pdf->Cell(20,7, $data['no_akun'],1,1);
  $pdf->Cell(60,7, $data['nama_akun'],1,1);
  $pdf->Cell(30, 7, "Rp. " . number_format($data['saldo'], 0, ".", "."), 1, 1);
  $pdf->Cell(30,7, "Rp 0", 0, 1);
  }elseif($data['jenis']=="Kredit")
  {
  $pdf->Cell(20,7, $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] : "", 1, 0, 'C'); 
  $pdf->Cell(20,7, $data['no_akun'],1,1);
  $pdf->Cell(60,7, $data['nama_akun'],1,1);
  $pdf->Cell(30,7, "Rp 0", 0, 1);
  $pdf->Cell(30, 7, "Rp. " . number_format($data['saldo'], 0, ".", "."), 1, 1);
  }
}

$tmp_date = $data['tgl_transaksi'];

$pdf->Output();
 
?>