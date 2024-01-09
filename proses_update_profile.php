<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "../pages/auth/koneksi.php";
	// membuat variabel untuk menampung data dari form
  $nama     = $_POST['nama'];
  $email    = $_POST['email'];
  $user_id  = $_POST['user_id'];
  $umkm     = $_POST['umkm'];
  $no_hp    = $_POST['no_hp'];
  $username = $_POST['user'];



      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE user2 set nama='$nama', email='$email' , umkm='$umkm', username='$username', no_hp='$no_hp' where user_id = $user_id";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location=' ../pages/settings.php';</script>";
      }
?>      