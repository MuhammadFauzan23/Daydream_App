
<?php 
	session_start();
	session_unset();
	session_destroy();
	?>
			<script language="JavaScript">
            alert('Anda telah keluar dari website. Silakan masuk kembali.');
            document.location='transaksi.php';
        	</script>
			<?php
	header("location:./auth/logindaydream.php");
 ?>

