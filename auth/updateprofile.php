<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "koneksi.php";
	// membuat variabel untuk menampung data dari form
  
  $nama     = $_POST['nama'];
  $user_id  = $_POST['user_id'];
  $username = $_POST['username'];
  $pass     = $_POST['pass'];

  if(isset($user_id)) {
    $new_hash = password_hash($pass, PASSWORD_BCRYPT);
    
    if(empty($pass))
    {
      $update = mysqli_query($koneksi, "UPDATE user2 SET username='$username', nama='$nama' WHERE user_id='$user_id'");
    }else{
    $update = mysqli_query($koneksi, "UPDATE user2 SET username='$username', nama='$nama', pass='$new_hash' WHERE user_id='$user_id'");
    }
    if(!$update) {
      die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //Ini masih tester
      echo "<script>alert('Data berhasil diubah.');window.location='../settings';</script>";
    }
  } else {
    die("ID tidak ditemukan");
  }
  ?>