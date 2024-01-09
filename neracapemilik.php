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
          <h2 class="h4">Neraca Saldo</h2>
          <p>Berisi Neraca saldo yang bersumber dari transaksi.</p><br>
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
      <!-- Pengelompokkan -->
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
              

            <?php
            include './auth/koneksi.php';
            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

            if (isset($_POST['filter']))
            {
              $from = $_POST['from'];
              $to = $_POST['to'];
            }

              function calculateJumlahSaldo($nama_akun, $from, $to) {
              global $koneksi;

                $query = "SELECT * FROM transaksi 
                INNER JOIN akun ON transaksi.no_akun = akun.no_reff AND akun.nama_akun = '$nama_akun'
                WHERE transaksi.umkm AND tgl_transaksi >= '$from' AND tgl_transaksi <= '$to' 
                ORDER BY tgl_transaksi ASC";                
                $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

                $jumlah_saldo = 0;

                while ($data = mysqli_fetch_array($jurnal_umum)) {
                    $jumlah = $data['saldo'];
                    if ($data['jenis'] == "Debit") {
                        $jumlah_saldo += $jumlah;
                    } elseif ($data['jenis'] == "Kredit") {
                        $jumlah_saldo -= $jumlah;
                    }
                }

                return $jumlah_saldo;
            }

            if (isset($from) && (isset($to)))
            {
            // Menghitung jumlah saldo untuk akun '105-KAS DI BANK'
            $jumlah_saldo1 = calculateJumlahSaldo('105-KAS DI BANK', $from, $to);

            // Menghitung jumlah saldo untuk akun '101-KAS DI TANGAN'
            $jumlah_saldo2 = calculateJumlahSaldo('101-KAS DI TANGAN', $from, $to);

            // Menghitung jumlah saldo untuk akun '126-PERSEDIAAN'
            $jumlah_saldo3 = calculateJumlahSaldo('126-PERSEDIAAN', $from, $to);

            //Menghitung jumlah saldo untuk akun '129-SEWA BAYAR DI MUKA'
            $jumlah_saldo4 = calculateJumlahSaldo('129-SEWA BAYAR DI MUKA', $from, $to);
            
            //Menghitung jumlah saldo untuk akun '130-ASURANSI BAYAR DIMUKA'
            $jumlah_saldo5 = calculateJumlahSaldo('130-ASURANSI BAYAR DIMUKA', $from, $to);

            //Menghitung jumlah saldo untuk akun '153-PERLENGKAPAN'
            $jumlah_saldo6 = calculateJumlahSaldo('153-PERLENGKAPAN', $from, $to);

            //Menghitung jumlah saldo untuk akun '154-PENYUSUTAN PERALATAN'
            $jumlah_saldo7 = calculateJumlahSaldo('154-PENYUSUTAN PERALATAN', $from, $to);

            //Menhitung jumlah saldo untuk akun '200-HUTANG WESEL'
            $jumlah_saldo8 = calculateJumlahSaldo('200-HUTANG WESEL', $from, $to);

            //Menghitung jumlah saldo untuk akun '201-HUTANG'
            $jumlah_saldo9 = calculateJumlahSaldo('201-HUTANG', $from, $to);

            //Menghitung jumlah saldo untuk akun '209-PENDAPATAN DITERIMA DI MUKA'
            $jumlah_saldo10 = calculateJumlahSaldo('209-PENDAPATAN DITERIMA DI MUKA', $from, $to);

            //Menghitung jumlah saldo untuk akun '212-HUTANG GAJI'
            $jumlah_saldo11 = calculateJumlahSaldo('212-HUTANG GAJI', $from, $to);

            //Menghitung jumlah saldo untuk akun '230-HUTANG BUNGA'
            $jumlah_saldo12 = calculateJumlahSaldo('230-HUTANG BUNGA', $from, $to);
            
            //Menghitung jumlah saldo untuk akun '741-BEBAN BUNGA'
            $jumlah_saldo13 = calculateJumlahSaldo('741-BEBAN BUNGA', $from, $to);

            //Menghitung jumlah saldo untuk akun '621-BEBAN PENYUSUTAN PERALATAN'
            $jumlah_saldo14 = calculateJumlahSaldo('621-BEBAN PENYUSUTAN PERALATAN', $from, $to);
            
            //Menghitung jumlah saldo untuk akun '631-BEBAN PERSEDIAAN'
            $jumlah_saldo15 = calculateJumlahSaldo('631-BEBAN PERSEDIAAN', $from, $to);

            //Menghitung jumlah saldo untuk akun '726-BEBAN GAJI'
            $jumlah_saldo16 = calculateJumlahSaldo('726-BEBAN GAJI', $from, $to);

            //Menghitung jumlah saldo untuk akun '729-BEBAN SEWA'
            $jumlah_saldo17 = calculateJumlahSaldo('729-BEBAN SEWA', $from, $to);

            //Menghitung jumlah saldo untuk akun '730-BEBAN ASURANSI'
            $jumlah_saldo18 = calculateJumlahSaldo('730-BEBAN ASURANSI', $from, $to);

            //Menghitung jumlah saldo untuk akun '731-BIAYA UTILITAS'
            $jumlah_saldo19 = calculateJumlahSaldo('731-BIAYA UTILITAS', $from, $to);

            //Menghitung jumlah saldo untuk akun '735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN'
            $jumlah_saldo20 = calculateJumlahSaldo('735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN', $from, $to);

            //Menghitung jumlah saldo untuk akun '740-BIAYA BENSIN'
            $jumlah_saldo21 = calculateJumlahSaldo('740-BIAYA BENSIN', $from, $to);

            //Menghitung jumlah saldo untuk akun '311-MODAL'
            $jumlah_saldo22 = calculateJumlahSaldo('311-MODAL', $from, $to);

            //Menghitung jumlah saldo untuk akun '322-DIVIDEN'
            $jumlah_saldo23 = calculateJumlahSaldo('322-DIVIDEN', $from, $to);

            //Menghitung jumlah saldo untuk akun '400-PENDAPATAN JASA'
            $jumlah_saldo24 = calculateJumlahSaldo('400-PENDAPATAN JASA', $from, $to);

            //Menghitung jumlah saldo untuk akun '401-PENJUALAN'
            $jumlah_saldo25 = calculateJumlahSaldo('401-PENJUALAN', $from, $to);

            //Menghitung jumlah saldo untuk akun '610 - BEBAN IKLAN'
            $jumlah_saldo26 = calculateJumlahSaldo('610-BEBAN IKLAN', $from, $to);
            
            }else{

              // Menghitung jumlah saldo untuk akun '105-KAS DI BANK'
            $jumlah_saldo1 = calculateJumlahSaldo('105-KAS DI BANK', null, null);

            // Menghitung jumlah saldo untuk akun '101-KAS DI TANGAN'
            $jumlah_saldo2 = calculateJumlahSaldo('101-KAS DI TANGAN', null, null);

            // Menghitung jumlah saldo untuk akun '126-PERSEDIAAN'
            $jumlah_saldo3 = calculateJumlahSaldo('126-PERSEDIAAN', null, null);

            //Menghitung jumlah saldo untuk akun '129-SEWA BAYAR DI MUKA'
            $jumlah_saldo4 = calculateJumlahSaldo('129-SEWA BAYAR DI MUKA', null, null);
            
            //Menghitung jumlah saldo untuk akun '130-ASURANSI BAYAR DIMUKA'
            $jumlah_saldo5 = calculateJumlahSaldo('130-ASURANSI BAYAR DIMUKA', null, null);

            //Menghitung jumlah saldo untuk akun '153-PERLENGKAPAN'
            $jumlah_saldo6 = calculateJumlahSaldo('153-PERLENGKAPAN', null, null);

            //Menghitung jumlah saldo untuk akun '154-PENYUSUTAN PERALATAN'
            $jumlah_saldo7 = calculateJumlahSaldo('154-PENYUSUTAN PERALATAN', null, null);

            //Menhitung jumlah saldo untuk akun '200-HUTANG WESEL'
            $jumlah_saldo8 = calculateJumlahSaldo('200-HUTANG WESEL', null, null);

            //Menghitung jumlah saldo untuk akun '201-HUTANG'
            $jumlah_saldo9 = calculateJumlahSaldo('201-HUTANG', null, null);

            //Menghitung jumlah saldo untuk akun '209-PENDAPATAN DITERIMA DI MUKA'
            $jumlah_saldo10 = calculateJumlahSaldo('209-PENDAPATAN DITERIMA DI MUKA', null, null);

            //Menghitung jumlah saldo untuk akun '212-HUTANG GAJI'
            $jumlah_saldo11 = calculateJumlahSaldo('212-HUTANG GAJI', null, null);

            //Menghitung jumlah saldo untuk akun '230-HUTANG BUNGA'
            $jumlah_saldo12 = calculateJumlahSaldo('230-HUTANG BUNGA', null, null);
            
            //Menghitung jumlah saldo untuk akun '741-BEBAN BUNGA'
            $jumlah_saldo13 = calculateJumlahSaldo('741-BEBAN BUNGA', null, null);

            //Menghitung jumlah saldo untuk akun '621-BEBAN PENYUSUTAN PERALATAN'
            $jumlah_saldo14 = calculateJumlahSaldo('621-BEBAN PENYUSUTAN PERALATAN', null, null);
            
            //Menghitung jumlah saldo untuk akun '631-BEBAN PERSEDIAAN'
            $jumlah_saldo15 = calculateJumlahSaldo('631-BEBAN PERSEDIAAN', null, null);

            //Menghitung jumlah saldo untuk akun '726-BEBAN GAJI'
            $jumlah_saldo16 = calculateJumlahSaldo('726-BEBAN GAJI', null, null);

            //Menghitung jumlah saldo untuk akun '729-BEBAN SEWA'
            $jumlah_saldo17 = calculateJumlahSaldo('729-BEBAN SEWA', null, null);

            //Menghitung jumlah saldo untuk akun '730-BEBAN ASURANSI'
            $jumlah_saldo18 = calculateJumlahSaldo('730-BEBAN ASURANSI', null, null);

            //Menghitung jumlah saldo untuk akun '731-BIAYA UTILITAS'
            $jumlah_saldo19 = calculateJumlahSaldo('731-BIAYA UTILITAS', null, null);

            //Menghitung jumlah saldo untuk akun '735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN'
            $jumlah_saldo20 = calculateJumlahSaldo('735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN', null, null);

            //Menghitung jumlah saldo untuk akun '740-BIAYA BENSIN'
            $jumlah_saldo21 = calculateJumlahSaldo('740-BIAYA BENSIN', null, null);

            //Menghitung jumlah saldo untuk akun '311-MODAL'
            $jumlah_saldo22 = calculateJumlahSaldo('311-MODAL', null, null);

            //Menghitung jumlah saldo untuk akun '322-DIVIDEN'
            $jumlah_saldo23 = calculateJumlahSaldo('322-DIVIDEN', null, null);

            //Menghitung jumlah saldo untuk akun '400-PENDAPATAN JASA'
            $jumlah_saldo24 = calculateJumlahSaldo('400-PENDAPATAN JASA', null, null);

            //Menghitung jumlah saldo untuk akun '401-PENJUALAN'
            $jumlah_saldo25 = calculateJumlahSaldo('401-PENJUALAN', null, null);

            //Menghitung jumlah saldo untuk akun '610 - BEBAN IKLAN'
            $jumlah_saldo26 = calculateJumlahSaldo('610-BEBAN IKLAN', null, null);
            }
            ?>
                                                    

            <?php
            $total_asset = $jumlah_saldo1 + $jumlah_saldo2 + $jumlah_saldo3 + $jumlah_saldo4 + $jumlah_saldo5 + $jumlah_saldo6 + 
                           $jumlah_saldo7;

            $total_hutang = $jumlah_saldo8 + $jumlah_saldo9 + $jumlah_saldo10 + $jumlah_saldo11 + $jumlah_saldo12;               
            ?> 

            

                    <div class="card card-body border-3 shadow table-wrapper table-responsive">
                     <table class="table table-condesed">
                      <thead>
                        <th>Asset</th>
                        <th style="text-align:right;">Jumlah</th>
                        <th></th>
                        <th>Hutang</th>
                        <th style="text-align:right;">Jumlah</th>
                      </thead>
                        <tbody>
                        <tr>
                          <td>Kas Di Bank</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo1),0,',','.'); ?></td>
                          <td></td>
                          <td>Hutang Wesel</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo8),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Kas Di Tangan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo2),0,',','.'); ?></td>
                          <td></td>
                          <td>Hutang</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo9),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Persediaan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo3),0,',','.'); ?></td>
                          <td></td>
                          <td>Pendapatan Diterima Dimuka</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo10),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Sewa Bayar Dimuka</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo4),0,',','.'); ?></td>
                          <td></td>
                          <td>Hutang Gaji</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo11),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Asuransi Bayar Dimuka</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo5),0,',','.'); ?></td>
                          <td></td>
                          <td>Hutang Bunga</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo12),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Perlengkapan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo6),0,',','.'); ?></td>
                          <td></td>
                          <td><b>Total Hutang</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_hutang),0,',','.'); ?></b></td>
                        </tr>
                        <tr>
                          <td>Penyusutan Peralatan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo7),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"><b></td>
                        </tr>
                         <tr>
                          <td><b>Total Asset</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_asset),0,',','.'); ?></b></td>
                          <td></td>
                          <td></td>
                          <td align="right"></b></td>
                        </tr>                        
                        </tbody>  
                    </table>
                  </div><br><br>

            <?php
            $total_beban = $jumlah_saldo13  + $jumlah_saldo14 + $jumlah_saldo15 + $jumlah_saldo16 + 
                           $jumlah_saldo17 + $jumlah_saldo18 + $jumlah_saldo19 + $jumlah_saldo20 + $jumlah_saldo21;

            $total_modal = $jumlah_saldo22 + $jumlah_saldo23; 

            $total_pendapatan = $jumlah_saldo24 + $jumlah_saldo25;        
            ?> 
                    <div class="card card-body border-3 shadow table-wrapper table-responsive">
                     <table class="table table-condesed">
                      <thead>
                        <th>Beban Biaya</th>
                        <th style="text-align:right;">Jumlah</th>
                        <th></th>
                        <th>Modal & Pendapatan</th>
                        <th style="text-align:right;">Jumlah</th>
                      </thead>
                        <tbody>
                        <tr>
                          <td>Beban Iklan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo13),0,',','.'); ?></td>
                          <td></td>
                          <td>Modal</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo22),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Beban Biaya Peralatan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo14),0,',','.'); ?></td>
                          <td></td>
                          <td>Dividen</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo23),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Beban Persediaan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo15),0,',','.'); ?></td>
                          <td></td>
                          <td><b>Total Modal</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_modal),0,',','.'); ?></b></td>
                        </tr>
                        <tr>
                          <td>Beban Gaji</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo16),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Beban Sewa</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo17),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Beban Asuransi</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo17),0,',','.'); ?></td>
                          <td></td>
                          <td>Pendapatan Jasa</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo24),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Biaya Utilitas</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo18),0,',','.'); ?></td>
                          <td></td>
                          <td>Penjualan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo25),0,',','.'); ?></td>
                        </tr>
                         <tr>
                          <td>Beban Biaya Perawatan Dan Perbaikan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo19),0,',','.'); ?></td>
                          <td></td>
                          <td><b>Total Pendapatan</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_pendapatan),0,',','.'); ?></b></td>
                        </tr>                        
                        <tr>
                          <td>Beban Bensin</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo20),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Beban Bunga</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo13),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td><b>Total Beban Biaya</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_beban),0,',','.'); ?></b></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>                                                
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