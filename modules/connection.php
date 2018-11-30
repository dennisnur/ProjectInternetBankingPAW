<?php

    function connect(){
        //inisialisasi koneksi
        $servername = "localhost";
        $database = "banking";
        $username = "root";
        $password = "";
        
        //return PDO
        return new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    }

?>