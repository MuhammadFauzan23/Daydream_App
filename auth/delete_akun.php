<?php
// Koneksi ke database
include 'koneksi.php';

// Cek apakah tombol "Ya" pada modal di klik
if (isset($_POST['ya'])) {
  $no_reff = $_POST['no_reff'];

  // Query untuk menghapus data dari database
  $query = "DELETE FROM akun WHERE no_reff = '$no_reff'";
  $result = mysqli_query($koneksi, $query);

  // Jika query berhasil dijalankan, redirect ke halaman manageuser
  if ($result) {
    echo "<script>alert('Data berhasil dihapus.');window.location=' ../akun';</script>";
  } else {
    echo "Error: " . mysqli_error($koneksi);
  }
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>

