<?php 
session_start();
$user=$_SESSION['user'];
?>

<?php 

    @session_start();

    // include "koneksi.php";
    include './auth/koneksi.php'; 

    if (@$_SESSION['user']) {     
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
              <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
          </nav>
          <h2 class="h4">Edit Profile</h2>
          <p class="mb-0">User Dapat Mengganti User Profile</p>
          <!-- <h3>Halo, <?php //echo $user; ?></h3> -->
        </div>
      </div>

      <div class="row">
        <div class="col-8 col-xl-12">
          <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4"></h2>
            <form action="proses_update_profile">
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
                    <label for="first_name">Nama Pemilik Usaha</label>
                    <input class="form-control" name="user_id" type="hidden" value="<?php echo $data['user_id']; ?>"  required />
                    <input class="form-control" name="nama" type="text" value="<?php echo $data['nama']; ?>"/>
                  </div>
                </div>
              </div>
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input class="form-control" name="username" type="text" value="<?php echo $data['username']; ?>"/>
                  </div>
                </div>                 
              </div>

          <div class="col-md-6 mb-4">
                <a href="editprofile"><button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Edit Profile</button></a>
              </div>
          </div>
               </form>

          </div>
            <?php
               }
            ?>
      </div>

<?php
include('./pages/footer.php'); #File Footer
?>
</main>
<?php
include('./pages/script.php'); #File Script Tambahan
?>

<?php 
}else{
        header("location:../index.html");
        
}
?>