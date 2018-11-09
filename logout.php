<?php
    session_start();
    unset($_SESSION['admin']);
    unset($_SESSION['costumer']);
    header('Location: index.php');
?>