<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$pass = $_POST['pass'];
// $umkm=$_POST['umkm'];
// $email=$_POST['email'];
// $nama=$_POST['nama'];

$data = mysqli_query($koneksi, "SELECT * FROM user2 where username='$username'");
$row = mysqli_fetch_array($data);
if (password_verify($pass, $row['pass'])) {
	if (mysqli_num_rows($data) > 0) {
		// echo "Login Berhasil";
		$_SESSION['username'] = $row['username'];
		$_SESSION['pass'] = $row['pass'];
		$_SESSION['umkm'] = $row['umkm'];
		$_SESSION['nama'] = $row['nama'];
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['role'] = $row['role'];
		// header("location: ../transaksi.php");
		// header("location: ../dashboard/dashboard.php");
?>
		<script language="JavaScript">
			alert('Selamat Datang Di Aplikasi Akuntansi Sederhana');
			document.location = '../transaksi';
		</script>
	<?php

		session_start();
		$name = $_SESSION['nama'];
		$query = mysqli_query($koneksi, "SELECT * FROM user2 WHERE nama = '$name'");
		while ($login = mysqli_fetch_array($query)) {

			//Telegram
			$botToken = '6292345616:AAGXI8fJyFBAtvoARPaXhw9kzFI4e75Dprg';
			$chatId = '1375154226';

			// Mendapatkan alamat IP pengguna yang login
			$userIP = $_SERVER['REMOTE_ADDR'];

			//membuat jeda 1 menit
			#sleep(60);

			// Membuat pesan yang berisi informasi login dan alamat IP
			$message = $login['nama'] . ' Telah Login Ke Daydream Akuntansi.' . "\n";
			#$message .= 'Alamat IP: ' . $userIP;

			// Mengirim pesan ke bot Telegram
			$apiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$chatId}&text=" . urlencode($message);
			$response = file_get_contents($apiUrl);
		}
	}
} else {
	?>
	<script language="JavaScript">
		alert('Maaf, Akun Anda tidak terdeteksi di dalam data kami, silahkan coba lagi');
		document.location = 'logindaydream';
	</script>
<?php
}
?>