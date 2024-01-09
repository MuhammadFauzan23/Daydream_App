<?php

$host = "localhost";
$user = "root";
$pass = "";
// $db = "db_akademik";
$db = "db_akuntansi";

//melakukan koneksi ke db
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
	echo "Gagal connect: " . die(mysql_error($koneksi));
}
