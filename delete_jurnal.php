<?php
// Koneksi ke database
include 'auth/koneksi.php';

// Cek apakah tombol "Ya" pada modal di klik
if (isset($_POST['ya'])) {
  $id = $_POST['id'];

  // Query untuk menghapus data dari database
  $query = "DELETE FROM transaksi WHERE id = '$id'";
  $result = mysqli_query($koneksi, $query);

  // Jika query berhasil dijalankan, redirect ke halaman manageuser
  if ($result) {
      echo "<script>alert('Data berhasil dihapus.');window.location=' jurnalumum';</script>";
  } else {
    echo "Error: " . mysqli_error($koneksi);
  }
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>


