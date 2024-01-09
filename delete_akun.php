<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "../pages/auth/koneksi.php";

      // jalankan query HAPUS berdasarkan ID yang produknya kita edit
	    $no_reff      = $_GET['no_reff'];
      $query  		= "DELETE FROM akun where no_reff='$no_reff'";
      $result 		= mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
          //tampil alert dan akan redirect ke halaman akun.php
          echo "<script>alert('Data berhasil Dihapus.');window.location=' ../pages/akun.php';</script>";
      }
?>      