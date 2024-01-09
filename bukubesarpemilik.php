<?php 
session_start();
$username=$_SESSION['username'];
?>

<?php 

    @session_start();

    // include "koneksi.php";
    include './auth/koneksi.php'; 

    if (@$_SESSION['username']) {     
 ?>

<?php
include('./pages/header.php'); #File Header
?>

<?php
include('./pages/sidebar.php'); #File Sidebar
?>

    <main class="content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <div class="d-block mb-4 mb-md-0">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
              <li class="breadcrumb-item">
                <a href="#">
                  <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                    ></path>
                  </svg>
                </a>
              </li>
              <li class="breadcrumb-item"><a href="#">Day Dream App</a></li>
              <li class="breadcrumb-item active" aria-current="page">Buku Besar</li>
            </ol>
          </nav>
          <h2 class="h4">Buku Besar</h2>
          <p>Berisi buku besar yang bersumber dari transaksi.</p><br>
        </div>
            <?php
              $sql = mysqli_query($koneksi, "SELECT * FROM user2 where user_id =  {$_SESSION['user_id']}");
              while ($data10=mysqli_fetch_array($sql)) {
            ?>
          <table>
            <tr>
              <td>Nama Usaha</td>
              <td></td>
              <td>:</td>
              <td><?php echo $data10['umkm'];?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td></td>
              <td>:</td>
              <td><?php echo $data10['nama'];?></td>
            </tr>            
             <tr>
              <td>Mata Uang</td>
              <td></td>
              <td>:</td>
              <td>Rp (Rupiah)</td>
            </tr>           
          </table>
          <?php
          }
          ?>        
      </div>

      <div class="row align-items-center">
            <form method="POST">
            <div class="col-md-6">
                <label for="tanggal">Tanggal</label>
                <div class="input-group">
                    <span class="input-group-text" id="tanggal">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                      </span>
                      <table>
                    <tr>
                    <td>
                      <input type="text" name="from" class="form-control" id="from" placeholder="yyyy-mm-dd" value="<?php echo isset($_POST['from']) ? $_POST['from'] : date('Y-m-d'); ?>" required/>
                    </td>
                    <td>
                    <a>-</a>
                    </td>
                    <td>  
                      <input type="text" name="to" class="form-control" id="to" placeholder="yyyy-mm-dd" value="<?php echo isset($_POST['to']) ? $_POST['to'] : date('Y-m-d'); ?>" required/>
                    </td>
                    <tr>
                    </table>
                  </div>
                  <input class="btn btn-gray-800 mt-2 animate-up-2 primary mb-2" name="filter" type="submit" value="Filter">
              </form> 
              <a href="updatereport" class="btn btn-gray-800 mt-2 animate-up-2 primary mb-2" name="update" type="submit" value="Update">Update</a>
              </div>
            </div>

<!-- Membuat Pengenalan Semua Akun transaksi -->
<?php
include "./auth/koneksi.php";

function getJurnalUmumData($nama_akun, $from = null, $to = null) {
    global $koneksi;

    $query = "SELECT * FROM transaksi 
    INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '$nama_akun'
    WHERE transaksi.umkm AND tgl_transaksi >= '$from' AND tgl_transaksi <= '$to'
    ORDER BY transaksi.tgl_transaksi ASC";

    $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

    $jumlah_saldo = 0;
    $jurnal_data = array();

    while ($data = mysqli_fetch_array($jurnal_umum)) {
        $jumlah = $data['saldo'];
        if ($data['jenis'] == "Debit") {
            $jumlah_saldo += $jumlah;
        } elseif ($data['jenis'] == "Kredit") {
            $jumlah_saldo -= $jumlah;
        }

        $data['jumlah_saldo'] = $jumlah_saldo;
        $jurnal_data[] = $data;
    }

    return $jurnal_data;
}

$jumlah_saldo1 = 0;
$jumlah_saldo2 = 0;

if (isset($_POST['filter'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];

    $jurnal_data1 = getJurnalUmumData('105-KAS DI BANK', $from, $to);
    $jurnal_data2 = getJurnalUmumData('101-KAS DI TANGAN', $from, $to);
    $jurnal_data3 = getJurnalUmumData('126-PERSEDIAAN', $from, $to);
    $jurnal_data4 = getJurnalUmumData('129-SEWA BAYAR DI MUKA', $from , $to);
    $jurnal_data5 = getJurnalUmumData('130-ASURANSI BAYAR DIMUKA', $from, $to);
    $jurnal_data6 = getJurnalUmumData('153-PERLENGKAPAN', $from, $to);
    $jurnal_data7 = getJurnalUmumData('154-PENYUSUTAN PERALATAN', $from, $to);
    $jurnal_data8 = getJurnalUmumData('200-HUTANG WESEL', $from, $to);
    $jurnal_data9 = getJurnalUmumData('201-HUTANG', $from, $to);
    $jurnal_data10 = getJurnalUmumData('209-PENDAPATAN DITERIMA DI MUKA', $from, $to);
    $jurnal_data11 = getJurnalUmumData('212-HUTANG GAJI', $from, $to);
    $jurnal_data12 = getJurnalUmumData('230-HUTANG BUNGA', $from, $to);
    $jurnal_data13 = getJurnalUmumData('311-MODAL', $from, $to);
    $jurnal_data14 = getJurnalUmumData('332-DIVIDEN', $from, $to);
    $jurnal_data15 = getJurnalUmumData('400-PENDAPATAN JASA', $from, $to);
    $jurnal_data16 = getJurnalUmumData('401-PENJUALAN', $from, $to);
    $jurnal_data17 = getJurnalUmumData('610-BEBAN IKLAN', $from, $to);
    $jurnal_data18 = getJurnalUmumData('621-BEBAN PENYUSUTAN PERALATAN', $from, $to);
    $jurnal_data19 = getJurnalUmumData('631-BEBAN PERSEDIAAN', $from, $to);
    $jurnal_data20 = getJurnalUmumData('726-BEBAN GAJI', $from, $to);
    $jurnal_data21 = getJurnalUmumData('729-BEBAN SEWA', $from, $to);
    $jurnal_data22 = getJurnalUmumData('730-BEBAN ASURANSI', $from, $to);
    $jurnal_data23 = getJurnalUmumData('731-BIAYA UTILITAS', $from, $to);
    $jurnal_data24 = getJurnalUmumData('735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN', $from, $to);
    $jurnal_data25 = getJurnalUmumData('740-BIAYA BENSIN', $from, $to);
    $jurnal_data26 = getJurnalUmumData('741-BEBAN BUNGA', $from, $to);
} else {
    $jurnal_data1 = getJurnalUmumData('105-KAS DI BANK');
    $jurnal_data2 = getJurnalUmumData('101-KAS DI TANGAN');
    $jurnal_data3 = getJurnalUmumData('126-PERSEDIAAN');
    $jurnal_data4 = getJurnalUmumData('129-SEWA BAYAR DI MUKA');
    $jurnal_data5 = getJurnalUmumData('130-ASURANSI BAYAR DIMUKA');
    $jurnal_data6 = getJurnalUmumData('153-PERLENGKAPAN');
    $jurnal_data7 = getJurnalUmumData('154-PENYUSUTAN PERALATAN');
    $jurnal_data8 = getJurnalUmumData('200-HUTANG WESEL');
    $jurnal_data9 = getJurnalUmumData('201-HUTANG');
    $jurnal_data10 = getJurnalUmumData('209-PENDAPATAN DITERIMA DI MUKA');
    $jurnal_data11 = getJurnalUmumData('212-HUTANG GAJI');
    $jurnal_data12 = getJurnalUmumData('230-HUTANG BUNGA');
    $jurnal_data13 = getJurnalUmumData('311-MODAL');
    $jurnal_data14 = getJurnalUmumData('332-DIVIDEN');
    $jurnal_data15 = getJurnalUmumData('400-PENDAPATAN JASA');
    $jurnal_data16 = getJurnalUmumData('401-PENJUALAN');
    $jurnal_data17 = getJurnalUmumData('610-BEBAN IKLAN');
    $jurnal_data18 = getJurnalUmumData('621-BEBAN PENYUSUTAN PERALATAN');
    $jurnal_data19 = getJurnalUmumData('631-BEBAN PERSEDIAAN');
    $jurnal_data20 = getJurnalUmumData('726-BEBAN GAJI');
    $jurnal_data21 = getJurnalUmumData('729-BEBAN SEWA');
    $jurnal_data22 = getJurnalUmumData('730-BEBAN ASURANSI');
    $jurnal_data23 = getJurnalUmumData('731-BIAYA UTILITAS');
    $jurnal_data24 = getJurnalUmumData('735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN');
    $jurnal_data25 = getJurnalUmumData('740-BIAYA BENSIN');
    $jurnal_data26 = getJurnalUmumData('741-BEBAN BUNGA');
}
?>

<!-- Kode HTML untuk menampilkan tabel KAS DI BANK -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">KAS DI BANK</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data1 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data1[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel KAS DI TANGAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">KAS DI TANGAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data2 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data2[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel PERSEDIAAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">PERSEDIAAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data3 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data3[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel SEWA BAYAR DI MUKA -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">SEWA BAYAR DI MUKA</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data4 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data4[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel PERLENGKAPAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">ASURANSI BAYAR DIMUKA</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data5 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data5[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel PERLENGKAPAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">PERLENGKAPAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data6 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data6[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel PENYUSUTAN PERALATAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">PENYUSUTAN PERALATAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data7 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data7[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel HUTANG WESEL -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">HUTANG WESEL</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data8 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data8[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel HUTANG -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">HUTANG</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data9 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data9[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel PENDAPATAN DITERIMA DI MUKA -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">PENDAPATAN DITERIMA DI MUKA</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data10 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data10[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel HUTANG GAJI -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">HUTANG GAJI</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data11 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data11[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel HUTANG BUNGA -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">HUTANG BUNGA</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data12 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data12[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel MODAL -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">MODAL</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data13 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data13[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel DIVIDEN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">DIVIDEN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data14 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data14[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel PENDAPATAN JASA -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">PENDAPATAN JASA</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data15 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data15[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel PENJUALAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">PENJUALAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data16 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data16[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BEBAN IKLAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BEBAN IKLAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data17 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data17[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BEBAN PENYUSUTAN PERALATAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BEBAN PENYUSUTAN PERALATAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data18 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data18[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BEBAN PERSEDIAAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BEBAN PERSEDIAAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data19 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data19[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BEBAN GAJI -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BEBAN GAJI</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data20 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data20[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BEBAN SEWA -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BEBAN SEWA</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data21 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data21[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BEBAN ASURANSI -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BEBAN ASURANSI</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data22 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data22[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BIAYA UTILITAS -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BIAYA UTILITAS</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data23 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data23[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BEBAN BIAYA PERAWATAN DAN PERBAIKAN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BEBAN BIAYA PERAWATAN DAN PERBAIKAN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data24 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data24[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BIAYA BENSIN -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BIAYA BENSIN</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data25 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data25[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Kode HTML untuk menampilkan tabel BEBAN BUNGA -->
<div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
    <h5 style="color: rgb(42, 76, 177)">BEBAN BUNGA</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">Tanggal</th>
                <th class="border-gray-200">Keterangan</th>
                <th class="border-gray-200">Debit</th>
                <th class="border-gray-200">Kredit</th>
                <th class="border-gray-200">Saldo</th>
                <th class="border-gray-200">D/K</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jurnal_data26 as $index => $data) { ?>
                <tr>
                    <td><?php echo ($index === 0 || $jurnal_data26[$index - 1]['tgl_transaksi'] !== $data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo ($data['jenis'] == 'Debit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo ($data['jenis'] == 'Kredit') ? "Rp. " . number_format($data['saldo'], 0, ".", ".") : "Rp. 0"; ?></td>
                    <td><?php echo "Rp. " . number_format($data['jumlah_saldo'], 0, ".", "."); ?></td>
                    <td><?php echo $data['jenis']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

      </div>
      </div>

    <?php
    include('./pages/footer.php');
    ?>
    </main>
    <?php
    include('./pages/script.php');
    ?>

<?php 
}else{
  ?>
          <script language="JavaScript">
          alert('Silahkan Login Terlebih Dahulu');
          document.location='auth/logindaydream';
          </script>
  <?php
}
?>