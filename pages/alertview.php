<?php

session_start();
$name = $_SESSION['nama'];
$query = mysqli_query($koneksi, "SELECT * FROM user2 WHERE nama = '$name'");
while ($login = mysqli_fetch_array($query))
{

    //Telegram
  $botToken = '6289609839:AAG8Q_SCJUC1jc1OgcD6r2kJQutZr7hoKR4';
  $chatId = '1686978185';
  
  // Mendapatkan alamat IP pengguna yang login
  $userIP = $_SERVER['REMOTE_ADDR'];

  //membuat jeda 1 menit
  #sleep(60);
  
  // Membuat pesan yang berisi informasi login dan alamat IP
  $message = $login['nama']. ' Telah Login Ke Daydream Akuntansi.' . "\n";
  #$message .= 'Alamat IP: ' . $userIP;
  
  // Mengirim pesan ke bot Telegram
  $apiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$chatId}&text=" . urlencode($message);
  $response = file_get_contents($apiUrl);
}
?>