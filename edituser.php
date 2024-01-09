<?php
session_start();
$user=$_SESSION['user'];
?>

<?php

    @session_start();
    //Include "koneksi.php"
    include './auth/koneksi.php';

    if (@$_SESSION['user'])
    {

?>


<?php
include('./pages/header.php'); //Header
include('./pages/sidebar.php'); //Sidebar
?>

<?php
include('./pages/footer.php'); //Footer 
?>
</main>
<?php
include('./pages/script.php'); //Script Tambahan
?>

<?php
    }else{
        header("location:../index.html");
    }
?>