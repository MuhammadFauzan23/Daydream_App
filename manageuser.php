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
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                   </path>
                  </svg>
                </a>
              </li>
              <li class="breadcrumb-item"><a href="#">Day Dream App</a></li>
              <li class="breadcrumb-item active" aria-current="page">Manage Karyawan</li>
            </ol>
          </nav>
          <h2 class="h4">Manage Karyawan</h2>
          <p class="mb-0">Halaman Untuk Pemilik Usaha</p>

        </div>
      </div>
      <!-- <a href="#" data-toggle="modal" data-target="#tambahakun"></a> -->
      <a type="submit" href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahuser">Tambah Akun Karyawan</a>
        <div class="card card-body border-0 shadow table-wrapper table-responsive border-0 mb-4 ">
        <table class="mt-1 table table-hover table-striped table-bordered ">

            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Gaji</th>
                <th scope="col">Role</th>
                <th colspan="3" scope="col">AKSI</th>
              </tr>            
            </thead>

            <?php
                include './auth/koneksi.php';
                $no = 1;
                $query    = mysqli_query($koneksi, "SELECT * FROM user2 WHERE role = 'Pemilik' OR role = 'Karyawan'");
                while($data   = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data['nama'];?></td>
                    <td><?php echo $data['username'];?></td>
                    <td><?php echo "Rp. " . number_format($data['gaji'], 0, ".", ".");?></td>
                    <td><?php echo $data['role'];?></td>
                  <td>
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-edit<?php echo $data['user_id']; ?>">Edit</a>
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-delete<?php echo $data['user_id']; ?>">Delete</a>
                  </td>
                </tr>


            <!-- Edit Button -->

<div class="modal fade" id="modal-edit<?php echo $data['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-edit-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-edit-label">Edit Data</h5>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="auth/updateuser.php" method="post">

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

                    <div class="form-group row">
                      <label class="col-sm-3 control-label text-right">Gaji</label> 
                        <div class="col-sm-8 mb-3">
                          <input type="text" class="form-control" name="gaji" placeholder="gaji" VALUE="<?php echo $data['gaji']; ?>">
                      </div>
                    </div>

                  <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Role</label>
                      <div class="col-sm-8 mb-3">
                        <select class="btn btn-outline-primary" name="role">
                          <option value="Karyawan">Karyawan</option>
                          <option value="Pemilik">Pemilik</option>
                        </select>
                      </div>
                    </div>
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

             <!-- Delete Button -->

<div class="modal fade" id="modal-delete<?php echo $data['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-delete-label">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin akan menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <form method="post" action="auth/deleteuser.php">
          <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <button type="submit" name="ya" class="btn btn-primary">Ya</button>
        </form>
      </div>
    </div>
  </div>
</div>



                

                <?php

                }

                ?>

                





<!-- Modal Untuk tambah data  -->
<div class="example-modal">
  <div id="tambahuser" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog"> 
      <div class="modal-content">
        <div class="modal-header"><h3 class="modal-title">Tambah Akun Karyawan</h3></div>
      <div class="modal-body">

            <form action="./auth/proses" method="post" role="form">
            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Nama</label> 
                <div class="col-sm-8 mb-3">
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Username</label>
                <div class="col-sm-8 mb-3">
                    <input type="text" class="form-control" name="user" placeholder="Username"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Password</label>
                <div class="col-sm-8 mb-3">
                    <input type="password" class="form-control" name="pass" placeholder="Masukkan Password"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Role</label>
                <div class="col-sm-8 mb-3">
                    <select class="btn btn-outline-primary" name="role">
                      <option value="Pemilik">Pemilik</option>
                      <option value="Karyawan">Karyawan</option>
                    </select>
                </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Nama Usaha</label>
                <div class="col-sm-8 mb-3">
                    <select class="btn btn-outline-primary" name="umkm">
                      <option value="Sumber Agung Parahyangan">Sumber Agung Parahyangan</option>
                    </select>
                  </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Buat">
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
    </div>
        </table>
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