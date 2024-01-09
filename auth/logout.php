<?php 
	session_start();
	session_unset();
	session_destroy();
	?>
			<script language="JavaScript">
            alert('Anda telah keluar dari website. Silakan masuk kembali.');
            document.location='logindaydream';
        	</script>
			<?php
	header("location:logindaydream");
 ?>

