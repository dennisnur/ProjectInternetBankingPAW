<?php
    //mulai session untuk admin
    session_start();  
    if (!isset($_SESSION['customer']))
    {
        header("Location: ../index.php");
        exit();
    }
?>