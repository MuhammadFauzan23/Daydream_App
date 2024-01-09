<?php 
include 'koneksi.php';

if(isset($_POST['searching']))
{
    $tanggal = $_POST['tanggal'];
    $user_id = $_POST['user_id'];

    // Konversi format tanggal
    $tanggal = date('Y-m-d', strtotime($tanggal));

    // Query untuk mencari transaksi berdasarkan tanggal
    $query = "SELECT transaksi.tgl_transaksi, backup.no_reff, akun.akun, backup.debit, backup.kredit
              FROM backup
              INNER JOIN akun ON transaksi.no_reff = akun.no_reff
              WHERE transaksi.user_id = '$user_id' AND DATE(transaksi.tgl_transaksi) = '$tanggal'
              ORDER BY transaksi.tgl_transaksi ASC";

    // Eksekusi query
    $result = $koneksi->query($query);

    // Memproses hasil query
    if ($result->num_rows > 0) {
        // Menampilkan data transaksi
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['tgl_transaksi'] . "</td>";
            echo "<td>" . $row['no_reff'] . "</td>";
            echo "<td>" . $row['akun'] . "</td>";
            echo "<td>" . $row['debit'] . "</td>";
            echo "<td>" . $row['kredit'] . "</td>";
            echo "<td>Aksi</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Tidak ada transaksi yang ditemukan.</td></tr>";
    }
}

?>