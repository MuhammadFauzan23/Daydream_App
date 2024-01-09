<?php 
session_start();
$username=$_SESSION['username'];
$umkm=$_SESSION['umkm'];
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
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                  </svg>
                </a>
              </li>
              <li class="breadcrumb-item"><a href="#">Day Dream App</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profil User <?php echo $umkm; ?></li>
            </ol>
          </nav>
          <h2 class="h4">Update Jenis Akun</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-xl-8">
          <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">Silahkan diisi data akun untuk pembaharuan</h2>
            <form action="proses_update_akun.php" method="post">
                  <?php 
                  include "./auth/koneksi.php";
                  $no_reff      = $_GET['no_reff'];
                  $data_akun    = "SELECT * FROM akun where no_reff='$no_reff'";
                  $query        = mysqli_query($koneksi,$data_akun);
                  while($data   = mysqli_fetch_array($query)){                  
                  ?>             

              <div class="row">
                <div class="col-md-6 mb-3">
                  <div>
                    <label for="first_name">Nama Akun</label>
                    <input class="form-control" id="nama_akun" name="nama_akun" type="text" placeholder="Masukkan nama akun" value="<?php echo $data['nama_akun']; ?>"  required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <div>
                    <label for="last_name">No Reff</label>
                    <input class="form-control" id="no_reff" type="text" name="no_reff" placeholder="Masukkan no reff" value="<?php echo $data['no_reff']; ?>" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="email">Jenis Akun</label>
                    <input class="form-control" id="ket_akun" type="text" name="ket_akun" placeholder="Masukkan ket akun" value="<?php echo $data['ket_akun']; ?>" required/>
                  </div>
                </div>
              </div>  

              <div class="">
                <input class="btn btn-gray-800 mt-2 animate-up-2" type="submit" value="Simpan">
              </div>
              <?php
                }
              ?>
            </form>
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