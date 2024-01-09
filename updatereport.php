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
    mysqli_query($koneksi, "UPDATE backup set tgl_transaksi='$tgl_transaksi', keterangan='$keterangan', no_akun='$no_akun', nama_akun='$nama_akun', saldo='$saldo', jenis='$jenis', user_id='$user_id' WHERE id='$id'");
}

echo "<script>alert('Data Berhasil Di Update.');window.location='report';</script>";
?>
