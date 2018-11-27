<?php
    //mulai session untuk customer
    session_start();  
    if (!isset($_SESSION['customer']))
    {
        header("Location: ../index.php");
        exit();
    }
?>