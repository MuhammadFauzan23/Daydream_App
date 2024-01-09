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
    <div id="printable-content">
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
              <li class="breadcrumb-item active" aria-current="page">Jurnal Umum</li>
            </ol>
          </nav>
          <h2 class="h4">Jurnal Umum</h2>
          <p class="mb-0">Berisi jurnal umum yang bersumber dari transaksi.</p>
        

      </div>
    </div>
      </div>
      <?php
        include('./auth/koneksi.php');
        // Masih Beta Test
        $allowed_roles = ['Developer'];
        if(!in_array($_SESSION['role'], $allowed_roles))
        {
          $release = 'style="display: none;"';
        }else{
          $release = '';
        }
      ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// Fungsi untuk filter data Jurnal Umum berdasarkan date range
function filterDataByDateRange($startDate, $endDate)
{
  // Lakukan koneksi ke database (pastikan ini sudah ada di file koneksi.php)
  include 'auth/koneksi.php';

  // Gunakan query untuk mengambil data Jurnal Umum berdasarkan date range
  $query = "SELECT * FROM transaksi 
            INNER JOIN akun ON transaksi.no_akun = akun.no_reff 
            WHERE transaksi.user_id = {$_SESSION['user_id']}
            AND tgl_transaksi >= '$startDate' 
            AND tgl_transaksi <= '$endDate'
            ORDER BY transaksi.tgl_transaksi ASC";

  $result = $koneksi->query($query);

  // Simpan hasil query ke dalam array
  $filteredData = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $filteredData[] = $row;
    }
  }

  // Tutup koneksi ke database
  $koneksi->close();

  return $filteredData;
}
?>
      <!-- Pengelompokkan -->
      <div class="row align-items-center">
        <!-- onsubmit="return showDate()" -->
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
                  <a class="btn btn-gray-800 mt-2 animate-up-2 primary mb-2" href="cetak_jurnalumum">Cetak Jurnal Umum</a>
                  <a class="btn btn-gray-800 mt-2 animate-up-2 primary mb-2" href="proses_release" <?php echo $release ?> type="submit">Release</a> 
              </div>
            </div>
<?php
if (isset($_POST['filter'])) {
  $from = $_POST['from'];
  $to = $_POST['to'];

  // Simpan date range dalam sesi untuk digunakan di halaman "cetak_jurnalumum.php"
  $_SESSION['date_range'] = array('from' => $from, 'to' => $to);

  // Filter data Jurnal Umum berdasarkan date range
  $filteredData = filterDataByDateRange($from, $to);
}
?>


<!-- Tampilkan hasil filter date range di bawah elemen input -->
<?php if (isset($filteredData) && !empty($filteredData)) : ?>
<div id="filteredJurnalUmum">
  <div class="card card-body border-3 shadow table-wrapper table-responsive">
    <table class="table">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">No Reff</th>
              <th class="border-gray-200">Akun</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $no = 1;
                if(isset($_POST['filter'])) {
                $from = $_POST['from'];
                $to = $_POST['to'];

              $query = "SELECT * FROM transaksi 
              INNER JOIN akun ON transaksi.no_akun = akun.no_reff 
              WHERE transaksi.user_id = {$_SESSION['user_id']}
              AND tgl_transaksi >= '$from' 
              AND tgl_transaksi <= '$to'
              ORDER BY transaksi.tgl_transaksi ASC";
              }else{
                echo"<script>alert('Data Tidak Ada.');<script>";
              }
               if (!empty($query)) {
                $report = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                // Lanjutkan pemrosesan data
            } else {
                echo "Silahkan Masukkan Bulan Dan Tahun"; // Pesan error jika query kosong
            }

              $tmp_date = "";
               while($data  = mysqli_fetch_array($report)){
                if ($data['jenis'] == "Debit") {
             ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] : "";?></td>
              <td><?php echo $data['no_akun'];?></td>
              <td><?php echo $data['nama_akun'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td>
                  <a class="btn btn-primary"   href="edit_jurnal.php?id=<?php echo $data['id']; ?>">Edit</a>
                  <a class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#modal-delete<?php echo $data['id']; ?>">Delete</a>                
              </td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] : "";?></td>
              <td><?php echo $data['no_akun'];?></td>
              <td><?php echo $data['nama_akun'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>  
              <td>
                  <a class="btn btn-primary"   href="edit_jurnal.php?id=<?php echo $data['id']; ?>">Edit</a>
                  <a class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#modal-delete<?php echo $data['id']; ?>">Delete</a>                
              </td>     
            </tr> 
            <?php
              }
            ?>

<div class="modal fade" id="modal-delete<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-delete-label">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin akan menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <form method="post" action="delete_jurnal">
          <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <button type="submit" name="ya" class="btn btn-primary">Ya</button>
        </form>
      </div>
    </div>
  </div>
</div>

            <?php
                $tmp_date = $data['tgl_transaksi'];
              }
            ?>
          </tbody>        
        </table>
          </div>
            </div>
            </div>
        <?php 
        endif; 
        ?>  
        </div>

<?php
include('./pages/footer.php'); #Footer
?>
</main>
<?php
include('./pages/script.php'); #Script
?>
</div>
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
<script>
function filterJurnalUmum() {
  // Ambil nilai dari input tanggal
  var startDate = document.getElementById("startDate").value;
  var endDate = document.getElementById("endDate").value;

  // Filter data Jurnal Umum sesuai dengan date range
  var filteredData = filterDataByDateRange(startDate, endDate);

  // Tampilkan hasil filter pada halaman Jurnal Umum
  displayFilteredData(filteredData);
}
</script>

<!-- <script>
    function showDate() {
        var fromDate = document.getElementById("from").value;
        var toDate = document.getElementById("to").value;
        alert("Tanggal dari: " + fromDate + "\nTanggal hingga: " + toDate);
    }
</script> -->

<style>
/* CSS untuk menyembunyikan elemen selain "printable-content" saat mencetak */
@media print {
  body * {
    visibility: hidden;
  }

  #printable-content, #printable-content * {
    visibility: visible;
  }

  #printable-content {
    position: relative;
    left: 0;
    top: 0;
  }
}
</style>