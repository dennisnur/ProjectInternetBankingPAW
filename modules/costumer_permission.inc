<?php
    session_start();
    if (!isset($_SESSION['costumer']))
    {
        header("Location: ../index.php");
        exit();
    }
?>