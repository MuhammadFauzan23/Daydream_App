<?php

	session_start();
	include './auth/koneksi.php'; 
	
	if (isset($_POST['tambah_transaksi'])) {
		$tgl 		= $_POST['tanggal'];
		$ket		= $_POST['keterangan'];

		$nomor_akun  = $_POST['nomor'];
		$name 		= $_POST['akun_user'];
		$saldo 		= $_POST['saldo'];
		$jenis 		= $_POST['jenis_debt'];


            // die();
		

		if(!empty($name)){ 
			$N_barisakun = count($name);

			for($j=0; $j < $N_barisakun; $j++)
			{
				$var_nomor_akun = $nomor_akun[$j];
				$var_name      = $name[$j];
				$var_saldo         = $saldo[$j];
				$var_jenis     = $jenis[$j];
				$var_user_id = $_POST["user_id"];
				// $var_jumlah         = str_replace(".", "", $var_jumlah);
				$sql = mysqli_query($koneksi, "INSERT INTO transaksi (tgl_transaksi, no_akun, nama_akun, keterangan, saldo, jenis, user_id) 
					VALUES ('$tgl','$var_nomor_akun','$var_name', '$ket','$var_saldo','$var_jenis', '$var_user_id')");

			}
			header("location: jurnalumum");
		}
	}
	
 ?>