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
              <li class="breadcrumb-item active" aria-current="page">Input Akun</li>
            </ol>
          </nav>
          <h2 class="h4">Input Akun</h2>
          <p class="mb-0">User dapat menginputkan Akun UMKMnya pada halaman ini.</p>
          
        </div>
      </div>
      <!-- <a href="#" data-toggle="modal" data-target="#tambahakun"></a> -->
      <a type="submit" href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahakun">Tambah Data Akun</a>
        
        <div class="card card-body border-0 shadow table-wrapper table-responsive border-0 mb-4 ">
        <table class="mt-1 table table-hover table-striped table-bordered ">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">Nama Akun</th>
                <th scope="col">No reff</th>
                <th scope="col">Jenis Akun</th>
                <th colspan="3" scope="col">AKSI</th>
              </tr>            
            </thead>
            <?php
                include "./auth/koneksi.php";
                $no = 1;
                $query    = mysqli_query($koneksi, "SELECT * FROM akun ORDER BY no_reff ASC");
                while($data   = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data['nama_akun'];?></td>
                    <td><?php echo $data['no_reff'];?></td>
                    <td><?php echo $data['ket_akun'];?></td>
                    <td>
                          <a class="btn btn-primary"   href="#" data-bs-toggle="modal" data-bs-target="#modal-edit<?php echo $data['no_reff']; ?>" >Edit</a>
                          <a class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#modal-delete<?php echo $data['no_reff']; ?>">Delete</a>
                    </td>
                
<!-- Edit Akun Modal -->
<div class="modal fade" id="modal-edit<?php echo $data['no_reff']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-edit-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-edit-label">Edit Akun</h5>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="proses_update_akun" method="post">
                <div class="form-group row">
                        <label class="col-sm-3 control-label text-right">Nama Akun</label> 
                          <div class="col-sm-8 mb-3">
                            <input type="text" class="form-control" name="nama_akun" placeholder="Nama Akun" VALUE="<?php echo $data['nama_akun'];?>" >
                          </div>
                       </div>

                    <div class="form-group row">  
                     <label class="col-sm-3 control-label text-right">No Reff</label> 
                       <div class="col-sm-8 mb-3">
                         <input type="text" class="form-control" name="no_reff" placeholder="No Reff" VALUE="<?php echo $data['no_reff']; ?>" >
                      </div>
                    </div>

                  <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Jenis Akun</label>
                      <div class="col-sm-8 mb-3">
                        <select class="btn btn-outline-primary" name="ket_akun">
                          <option value="DEBIT">DEBIT</option>
                          <option value="KREDIT">KREDIT</option>
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

<!-- Modal Delete Akun -->
<div class="modal fade" id="modal-delete<?php echo $data['no_reff']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-delete-label">Hapus Akun</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin akan menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <form method="post" action="auth/delete_akun">
          <input type="hidden" name="no_reff" value="<?php echo $data['no_reff']; ?>">
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
  <div id="tambahakun" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog"> 
      <div class="modal-content">
        <div class="modal-header"><h3 class="modal-title">Data Akun</h3></div>
      <div class="modal-body">
            <form action="simpan_akun.php" method="post" role="form">
            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Akun</label> 
                <div class="col-sm-8 mb-3">
                    <input type="text" class="form-control" name="nama_akun" placeholder="Masukkan Akun"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">No Reff</label>
                <div class="col-sm-8 mb-3">
                    <input type="text" class="form-control" name="no_reff" placeholder="Masukkan No Reff"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Keterangan </label>
                <div class="col-sm-8 mb-3">
                    <select class="btn btn-outline-primary" name="ket_akun">
                      <option value="DEBIT">DEBIT</option>
                      <option value="KREDIT">KREDIT</option>
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