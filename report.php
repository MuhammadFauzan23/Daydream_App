<?php
session_start();
$username = $_SESSION['username'];
?>

<?php
@session_start();
include './auth/koneksi.php';
if($_SESSION['username']){
?>


<?php
include './pages/header.php';
?>

<?php
include './pages/sidebar.php';
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
              <li class="breadcrumb-item active" aria-current="page">Report Bulanan</li>
            </ol>
          </nav>
          <h2 class="h4">Report</h2>
          <p class="mb-0">Karyawan melakukan report kepada pemilik.</p>
          <!-- <h3>Halo, <?php echo $user; ?></h3> -->
        </div>
      </div>

      <div class="row">
        <div>
        <a class="btn btn-gray-800 mt-2 animate-up-2 primary mb-4" href="cetak_report" type="submit">Cetak Report</a>
        </div>
        <div class="col-12 col-xl-12">
          <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-1">Search</h2>
            <?php 
            // var_dump($_SESSION['user_id']);
            // var_dump($var_user_id);
            ?>

            <!-- Mulai Form -->

           
       
          <div class="panel-body">
          <div class="col-md-12 col-lg-12">
            <div class="form-group">

            <form method="POST" action="#">
            <div class="row align-items-center mt-3">
            <div class="col-md-6">
                <label for="tanggal">Tanggal</label>
                <div class="input-group">
                    <span class="input-group-text" id="tanggal">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                      </span>
                      <select name="bulan">
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="12">November</option>
                          <option value="12">Desember</option>
                      </select>

                      <select name="tahun">
                            <?php
                            $mulai= date('Y') - 50;
                            for($i = $mulai;$i<$mulai + 100;$i++){
                                $sel = $i == date('Y') ? ' selected="selected"' : '';
                                echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                            }
                            ?>
                      </select>
                  </div>
                  <input class="btn btn-gray-800 mt-2 animate-up-2 primary mb-2" name="searching" type="submit" value="Filter">
              </form> 
              <a href="updatereport" class="btn btn-gray-800 mt-2 animate-up-2 primary mb-2" name="update" type="submit" value="Update">Update</a>
              </div>


      <div class="card card-body border-3 shadow table-wrapper table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">No Reff</th>
              <th class="border-gray-200">Akun</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Keterangan</th>
            </tr>
          </thead>
          <tbody>
          <?php
                $no = 1;
               if(isset($_POST['searching'])) {
                $bulan = $_POST['bulan'];
                $tahun = $_POST['tahun'];

              $query = "SELECT * FROM backup 
              INNER JOIN akun ON backup.no_akun = akun.no_reff 
              WHERE backup.umkm
              AND MONTH(backup.tgl_transaksi) = $bulan
              AND YEAR(backup.tgl_transaksi) = $tahun
              ORDER BY backup.tgl_transaksi ASC";
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
              <td><?php echo $data['keterangan'];?></td>
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
              <td><?php echo $data['keterangan'];?></td>            
            </tr> 
            <?php
              }
            ?>

            <?php
                $tmp_date = $data['tgl_transaksi'];
            }
            ?>
            
          </tbody>        
        </table>
        </div>
              
            

            </div>      
          </div>
        </div>
        </div>
      </div>
<?php
include('./pages/footer.php'); #Footer
?>
</main>
<?php
include('./pages/script.php'); #Script
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