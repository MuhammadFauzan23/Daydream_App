<?php
	session_start();
	include 'koneksi.php';
	
	$umkm = $_POST['umkm'];
	$nama = $_POST['nama'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$role = $_POST['role'];

	$pass_acak = password_hash($pass, PASSWORD_DEFAULT);
	$input = mysqli_query($koneksi, "INSERT INTO user2 (nama, username, pass, user_id, umkm, role) VALUES('$nama', '$user', '$pass_acak', '', '$umkm', '$role')") or die(mysqli_error($koneksi));

	if ($input) 
	{ ?>
			<script language="JavaScript">
            alert('Selamat Data Berhasil Di tambahkan. ');
            document.location='../manageuser';
        	</script>
		<?php
		// echo "Data berhasil disimpan";
		// header("location: ../transaksi.html");
		// header("location: logindaydream.php");
		
	} else
		{
		?>
			<script language="JavaScript">
            alert('Terjadi Kesalahan Ketika Memasukkan Data. ');
            document.location='../manageuser';
        	</script>
	<?php
		}
?>