<?php
    //menghapus session yang sedang berjalan dengan unset()
    session_start();
    unset($_SESSION['admin']);
    unset($_SESSION['customer']);
    //direct ke index.php
    header('Location: index.php');
?>