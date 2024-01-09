<?php  
include 'auth/koneksi.php'; 
 $akun = $_POST['nama_akun']; 
 $reff = $_POST['no_reff']; 
 $ketakun= $_POST['ket_akun']; 
 $input = mysqli_query($koneksi,"INSERT INTO akun VALUES('$akun','$reff','$ketakun')") or die(mysqli_error($koneksi));  
 if($input){ 
		echo "<script>alert('Data berhasil Ditambah.');window.location=' akun.php';</script>"; 
 }else{ 
  	echo "Gagal Disimpan"; 
 } 
 ?> 