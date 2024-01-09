<?php
// Koneksi ke database
include 'koneksi.php';

// Cek apakah tombol "Ya" pada modal di klik
if (isset($_POST['ya'])) {
  $user_id = $_POST['user_id'];

  // Query untuk menghapus data dari database
  $query = "DELETE FROM user2 WHERE user_id = '$user_id'";
  $result = mysqli_query($koneksi, $query);

  // Jika query berhasil dijalankan, redirect ke halaman manageuser
  if ($result) {
    echo "<script>alert('Akun berhasil dihapus.');window.location=' ../manageuser';</script>";
  } else {
    echo "Error: " . mysqli_error($koneksi);
  }
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>

