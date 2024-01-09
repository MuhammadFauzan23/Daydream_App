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
              <li class="breadcrumb-item active" aria-current="page">Input Transaksi</li>
            </ol>
          </nav>
          <h2 class="h4">Input Transaksi</h2>
          <p class="mb-0">User dapat menginputkan transaksi pada halaman ini.</p>
          <!-- <h3>Halo, <?php echo $user; ?></h3> -->
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-1">Input Transaksi</h2>
            <?php 
            // var_dump($_SESSION['user_id']);
            // var_dump($var_user_id);
            ?>

            <!-- Mulai Form -->
            
        <div class="panel-body">
          <div class="col-md-12 col-lg-12">
            <div class="form-group">
            <form action="proses" autocomplete="off" method="POST" accept-charset="utf-8">
                
              <div class="row align-items-center mt-3">
                  <div class="col-md-6">
                    <label for="tanggal">Tanggal</label>
                    <div class="input-group">
                      <span class="input-group-text" id="tanggal">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                      </span>
                      
                      <input type="text" name="tanggal" class="form-control" id="datepicker" placeholder="yyyy-mm-dd" required />
                    </div>
                  </div>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>" /><br/>
                <!-- <input type="hidden" name="umkm" value="<?php echo $_SESSION['umkm']?>" /> -->
            </div>

              <div class="row align-items-center mb-3">
                  <div class="col-md-6">
                    <label for="keterangan">Keterangan Transaksi</label>
                    <div class="input-group">
                      <input name="keterangan" class="form-control" id="keterangan" type="text" required />
                    </div>
                  </div>
                </div>
                    
          <div class=" border-0 shadow table-wrapper table-responsive mb-4 border-radius">
                <table class="table table-hover" id="myTable">
                  <thead>
                    <tr>
                      <th class="border-gray-200 " style="text-align: center;">Nama Akun</th>
                      <th class="border-gray-200 " style="text-align: center;">No. Akun</th>
                      <th class="border-gray-200" style="text-align: center" >Jumlah</th>
                      <th class="border-gray-200" style="text-align: center">Debit/Kredit</th>
                      <th class="border-gray-200">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>
                        <div class="form-group">
                          <select name="akun_user[0]" class="form-control form-select w-100 " id="sel1">
                            <option>Pilih Nama Akun</option>
                                <?php 
                                  $sql=mysqli_query($koneksi, "SELECT * FROM akun");
                                  while ($data=mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?=$data['nama_akun']?>"><?=$data['nama_akun']?></option> 
                                <?php
                                  }
                                ?>
                          </select>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <input type="text" name="nomor[0]" class="form-control " id="nbr"/>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <div class="input-group">  
                            <span class="input-group-text">Rp.</span>
                            <input type="text" name="saldo[0]" class="form-control" id="saldo"/>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="form-group">
                              <!-- <label for="jenis_debt">Jenis </label> -->
                              <select name="jenis_debt[0]" class="form-control form-select w-200 " id="sel1">
                              <option value="Debit">Debit</option>
                              <option value="Kredit">Kredit</option>
                          </select>
                        </div>
                      </td>

                      <td></td>
                    </tr>

                    <!-- Input 2 -->
                    <tr>
                      <td>
                        <div class="form-group">
                          <select name="akun_user[1]" class="form-control form-select w-100 " id="sel1">
                            <option>Pilih Nama Akun</option>
                                <?php 
                                  $sql=mysqli_query($koneksi, "SELECT * FROM akun");
                                  while ($data=mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?=$data['nama_akun']?>"><?=$data['nama_akun']?></option> 
                                <?php
                                  }
                                ?>
                          </select>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <input type="text" name="nomor[1]" class="form-control " id="nbr"/>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <div class="input-group">  
                            <span class="input-group-text">Rp.</span>
                            <input type="text" name="saldo[1]" class="form-control" id="saldo"/>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="form-group">
                              <!-- <label for="jenis_debt">Jenis </label> -->
                              <select name="jenis_debt[1]" class="form-control form-select w-200 " id="sel1">
                              <option value="Debit">Debit</option>
                              <option value="Kredit">Kredit</option>
                          </select>
                        </div>
                      </td>
                      <td></td>
                    </tr>

                    <!-- Input 3 -->
                    <tr>
                      <td>
                        <div class="form-group">
                          <select name="akun_user[2]" class="form-control form-select w-100 " id="sel1">
                            <option>Pilih Nama Akun</option>
                                <?php 
                                  $sql=mysqli_query($koneksi, "SELECT * FROM akun");
                                  while ($data=mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?=$data['nama_akun']?>"><?=$data['nama_akun']?></option> 
                                <?php
                                  }
                                ?>
                          </select>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <input type="text" name="nomor[2]" class="form-control " id="nbr"/>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <div class="input-group">  
                            <span class="input-group-text">Rp.</span>
                            <input type="text" name="saldo[2]" class="form-control" id="saldo"/>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="form-group">
                              <!-- <label for="jenis_debt">Jenis </label> -->
                              <select name="jenis_debt[2]" class="form-control form-select w-200 " id="sel1">
                              <option value="Debit">Debit</option>
                              <option value="Kredit">Kredit</option>
                          </select>
                        </div>
                      </td>
                      <td><button class="btn btn-small btn-default pull-left" type="button" onclick="myFunction();" value="tambah" ><i class="fa fa-trash"></i></button></td>
                    </tr>

                     <!-- Input 4 -->
                    <tr>
                      <td>
                        <div class="form-group">
                          <select name="akun_user[3]" class="form-control form-select w-100 " id="sel1">
                            <option>Pilih Nama Akun</option>
                                <?php 
                                  $sql=mysqli_query($koneksi, "SELECT * FROM akun");
                                  while ($data=mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?=$data['nama_akun']?>"><?=$data['nama_akun']?></option> 
                                <?php
                                  }
                                ?>
                          </select>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <input type="text" name="nomor[3]" class="form-control " id="nbr"/>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <div class="input-group">  
                            <span class="input-group-text">Rp.</span>
                            <input type="text" name="saldo[3]" class="form-control" id="saldo"/>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="form-group">
                              <!-- <label for="jenis_debt">Jenis </label> -->
                              <select name="jenis_debt[3]" class="form-control form-select w-200 " id="sel1">
                              <option value="Debit">Debit</option>
                              <option value="Kredit">Kredit</option>
                          </select>
                        </div>
                      </td>
                      <td><button class="btn btn-small btn-default pull-left" type="button" onclick="myFunction();" value="tambah" ><i class="fa fa-trash"></i></button></td>
                    </tr>
                    <script type="text/javascript">
                      function myFunction() {
                        document.getElementById("myTable").deleteRow(-1);
                      }
                    </script>
                  </tbody>
                </table>
          </div>

            <input type="submit" name="tambah_transaksi" value="Tambah Data" class="btn btn-success">
            <input style="margin-left: 10px" type="reset" value="Reset" class="btn btn-warning">
            </form>
        </div>
      </div>

          </div>
        </div>
        </div>
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
  ?>
          <script language="JavaScript">
          alert('Silahkan Login Terlebih Dahulu');
          document.location='auth/logindaydream';
          </script>
  <?php
}
?>