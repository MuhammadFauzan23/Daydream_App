<?php
$botToken = '6292345616:AAGXI8fJyFBAtvoARPaXhw9kzFI4e75Dprg';
$chatId = '1375154226';

// Mendapatkan alamat IP pengguna yang login
$userIP = $_SERVER['REMOTE_ADDR'];

// Membuat pesan yang berisi informasi login dan alamat IP
$message = 'Ada seseorang yang login di website.' . "\n";
$message .= 'Alamat IP: ' . $userIP;

// Mengirim pesan ke bot Telegram
$apiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$chatId}&text=" . urlencode($message);
$response = file_get_contents($apiUrl);
?>

<script language="JavaScript">
    document.location = '../transaksi';
</script>
<?php
?>