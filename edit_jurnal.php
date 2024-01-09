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
include('./pages/header.php');
?>

<?php
include('./pages/sidebar.php');
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
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                  </svg>
                </a>
              </li>
              <li class="breadcrumb-item"><a href="#">Day Dream App</a></li>
              <li class="breadcrumb-item active" aria-current="page">Jurnal Umum</li>
            </ol>
          </nav>
          <h2 class="h4">Edit Jurnal Umum</h2>
          <p class="mb-0">User dapat mengupdate jurnal umum UMKMnya pada halaman ini.</p>
          <!-- <h3>Halo, <?php echo $user; ?></h3> -->
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-1">Input Data</h2>

            <!-- Mulai Form -->
            
        <div class="panel-body">
          <div class="col-md-10 col-lg-12">
            <div class="form-group">
              <form action="proses_update_jurnal.php" autocomplete="off" method="POST" accept-charset="utf-8">
                <?php
                  include "auth/koneksi.php";
                  $no = 1;
                  $id          = $_GET['id'];
                  $query       = "SELECT * FROM transaksi where id='$id'";
                  $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                  while($data  = mysqli_fetch_array($jurnal_umum)){
                ?>                

                <div class="row align-items-center mt-3">
                  <div class="col-md-6">
                    <label for="tanggal">Tanggal</label>
                      <div class="input-group">
                        <span class="input-group-text" id="tanggal">
                          <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd">
                            </path>
                          </svg>
                        </span>
                        <input name="tanggal" class="form-control" id="datepicker" type="text" placeholder="yyyy-mm-dd" value="<?php echo $data['tgl_transaksi'] ?>" required />
                    </div>
                  </div>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>

            

            <td>
              <div class="form-group">
              <!-- <label for="number_saldo">Saldo </label> -->
                <input type="hidden" name="id" class="form-control" id="number_saldo" value="<?php echo $data['id'] ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
              </div>
            </td>



                    

          <div class=" border-0 shadow table-wrapper table-responsive mb-4 border-radius">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th class="border-gray-200 " style="text-align: center;">Nama Akun</th>
                  <th class="border-gray-200 " style="text-align: center;">No. Akun</th>
                  <th class="border-gray-200" style="text-align: center" >Jumlah</th>
                  <th class="border-gray-200" style="text-align: center">Debit/Kredit</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="form-group">
                      <select name="akun_user" class="form-control form-select w-100 " id="sel1">
                      <option>Masukkan Nama Akun</option>
                      <?php 
                            $sql=mysqli_query($koneksi, "SELECT * FROM akun");
                            while ($data1=mysqli_fetch_array($sql)) {
                          ?>
                        
                            <option value="<?=$data1['nama_akun']?>"><?=$data1['nama_akun']?></option> 
                          <?php
                            }
                          ?>
                      </select>
                    </div>
                  </td>

                  <td>
                    <div class="form-group">
                    <!-- <label for="nbr">No akun </label> -->
                      <input type="text" name="nomor" class="form-control" id="nbr" value="<?php echo $data['no_akun'] ?>"/>
                    </div>
                  </td>

                  <td>
                    <div class="form-group">
                      <div class="input-group">  
                        <span class="input-group-text">Rp.</span>
                        <input type="text" name="saldo" class="form-control" id="number_saldo" value="<?php echo $data['saldo'] ?>">
                      </div>
                    </div>              
                  </td>

                  <td>
                    <div class="form-group">
                      <select name="jenis_debt" class="form-control form-select w-200 " id="sel1">
                        <option value="Debit" <?php echo $data['jenis'] == "Debit" ? "selected": "" ?>>Debit</option>
                        <option value="Kredit"  <?php echo $data['jenis'] == "Kredit" ? "selected": "" ?>>Kredit</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </tbody>
          <?php
            }
          ?>  
            </table>
          </div>
            <input type="submit" name="edit_jurnal" value="Edit Data" class="btn btn-success">
          </form>
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