<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "./auth/koneksi.php";
	// membuat variabel untuk menampung data dari form
  $nama_akun  = $_POST['nama_akun'];
  $no_reff    = $_POST['no_reff'];
  $ket_akun   = $_POST['ket_akun'];

      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE akun set nama_akun='$nama_akun', no_reff='$no_reff', ket_akun='$ket_akun' where no_reff='$no_reff'";
      $result = mysqli_query($koneksi, $query);
      
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
        
          echo "<script>alert('Data berhasil diubah.');window.location='akun';</script>";
          
      }
      
?>      