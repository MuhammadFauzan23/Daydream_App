<?php
include './auth/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM transaksi");

// Membuat salinan data ke data baru (misalnya tabel baru)
while ($data = mysqli_fetch_assoc($query)) {
    $id                 = $data['id'];
    $tgl_transaksi      = $data['tgl_transaksi'];
    $keterangan         = $data['keterangan'];
    $no_akun            = $data['no_akun'];
    $nama_akun          = $data['nama_akun'];
    $saldo              = $data['saldo'];
    $jenis              = $data['jenis'];
    $user_id            = $data['user_id'];
    
    // Simpan data ke tabel baru
    mysqli_query($koneksi, "INSERT INTO backup (id, tgl_transaksi, keterangan, no_akun, nama_akun, saldo, jenis, user_id) VALUES ('$id', '$tgl_transaksi', '$keterangan', '$no_akun', '$nama_akun', '$saldo', '$jenis', '$user_id')");
}

echo "<script>alert('Data Berhasil Di Release.');window.location='jurnalumum';</script>";
?>
