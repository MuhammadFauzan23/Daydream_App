<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "koneksi.php";
	// membuat variabel untuk menampung data dari form
  
  $nama     = $_POST['nama'];
  $user_id  = $_POST['user_id'];
  $username = $_POST['username'];
  $pass     = $_POST['pass'];
  $gaji     = $_POST['gaji'];
  $role     = $_POST['role'];

  session_start();
$name = $_SESSION['nama'];
$query = mysqli_query($koneksi, "SELECT * FROM user2 WHERE nama = '$name'");
while ($login = mysqli_fetch_array($query))
{

  //Telegram
  $botToken = '5855899234:AAFGZ9iv3LS8tdVTab6UZk7qRg1Datw4fY0';
  $chatId = '1686978185';
  
  // Mendapatkan alamat IP pengguna yang login
  // $userIP = $_SERVER['REMOTE_ADDR'];
  
  // Mengganti bagian pesan yang dikirim ke bot Telegram dengan informasi pengguna yang diubah
  $message =  $login['nama']. ' Telah Mengubah:' . "\n";
  $message .= 'Nama: ' . $nama . "\n";
  $message .= 'User ID: ' . $user_id . "\n";
  $message .= 'Username: ' . $username . "\n";
  $message .= 'Gaji: ' . $gaji . "\n";
  $message .= 'Role: ' . $role . "\n";
  $message .= 'Password: ' . $pass . "\n";
  
  // Mengirim pesan ke bot Telegram
  $apiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$chatId}&text=" . urlencode($message);
  $response = file_get_contents($apiUrl);
}

  if(isset($user_id)) {
    $new_hash = password_hash($pass, PASSWORD_BCRYPT);
    
    if(empty($pass))
    {
      $update = mysqli_query($koneksi, "UPDATE user2 SET username='$username', nama='$nama', role='$role', gaji='$gaji' WHERE user_id='$user_id'");  
    }else{
    $update = mysqli_query($koneksi, "UPDATE user2 SET username='$username', nama='$nama', pass='$new_hash', role='$role', gaji='$gaji' WHERE user_id='$user_id'");
    }

    if(!$update) {
      die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //Ini masih tester
      echo "<script>alert('Data berhasil diubah.');window.location='../manageuser';</script>";
    }
  } else {
    die("ID tidak ditemukan");
  }
  ?>