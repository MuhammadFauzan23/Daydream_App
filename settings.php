<?php 
session_start();
$user_id=$_SESSION['user_id'];
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
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                    ></path>
                  </svg>
                </a>
              </li>
              <li class="breadcrumb-item"><a href="#">Day Dream App</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profil User <?php echo $umkm; ?></li>
            </ol>
          </nav>
          <h2 class="h4">Profil User</h2>
          <p class="mb-0">Berisi profil dari user </p>
        </div>
      </div>

      <div class="row">
        <div class="col-8 col-xl-12">
          <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4"></h2>
            
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $user_id = $_SESSION['user_id'];
               $query       = "SELECT * FROM user2 where user_id = {$_SESSION['user_id']}";
               $data_profile = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
               while($data  = mysqli_fetch_array($data_profile)){
             ?>              
              <div class="row">
                <div class="col-md-6 mb-3">
                  <div>
                    <label for="first_name">Nama Lengkap</label>
                    <input class="form-control" name="user_id" type="hidden" value="<?php echo $data['user_id']; ?>"  required />
                    <p class="form-control"><?php echo $data['nama']; ?></p>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div>
                    <label for="last_name">Nama Usaha</label>
                    <p class="form-control"><?php echo $data['umkm']; ?></p>
                  </div>
                </div>
                
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="email">Username</label>
                    <p class="form-control"><?php echo $data['username']; ?></p>
                  </div>
                </div>                 
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                     <label for="Gaji">Gaji</label>
                     <p class="form-control"><?php echo "Rp. " . number_format($data['gaji'], 0, ".", "."); ?></p>
                  </div>   
                </div>   
              </div>           
           
          
          <div class="row">
              <div class="col-md-6 mb-2">
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit<?php echo $data['user_id']; ?>">Edit Profile</a>
              </div>
          </div>

          <!-- Edit Button -->
<div class="modal fade" id="modal-edit<?php echo $data['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-edit-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-edit-label">Edit Data</h5>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="auth/updateprofile" method="post">

                    <div class="form-group row">
                      <input type="hidden" class="form-control" name="user_id" VALUE="<?php echo $data['user_id'] ?>" >
                        <label class="col-sm-3 control-label text-right">Nama</label> 
                          <div class="col-sm-8 mb-3">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" VALUE="<?php echo $data['nama'] ?>" >
                          </div>
                       </div>

                    <div class="form-group row">  
                     <label class="col-sm-3 control-label text-right">Username</label> 
                       <div class="col-sm-8 mb-3">
                         <input type="text" class="form-control" name="username" placeholder="Username" VALUE="<?php echo $data['username'] ?>" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 control-label text-right">Password</label> 
                        <div class="col-sm-8 mb-3">
                          <input type="password" class="form-control" name="pass" placeholder="Password">
                      </div>
                    </div>

                    <!-- <div class="form-group row"> 
                      <label class="col-sm-3 control-label text-right">Gaji</label> 
                        <div class="col-sm-8 mb-3">
                          <input type="text" class="form-control" name="gaji" placeholder="gaji" VALUE="<?php echo $data['gaji']; ?>">
                      </div>
                    </div> -->

                  <!-- <div class="form-group"> 
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Role</label>
                      <div class="col-sm-8 mb-3">
                        <select class="btn btn-outline-primary" name="role">
                          <option value="Pemilik">Pemilik</option>
                          <option value="Karyawan">Karyawan</option>
                        </select>
                      </div>
                    </div> -->
                  </div>

                       <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                          <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                      </div>

                    </form>
                    </div>
                  </div>
                </div>
             </div>

        </div>
            <?php
               }
            ?>
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