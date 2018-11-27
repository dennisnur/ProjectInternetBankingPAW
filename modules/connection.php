<?php

    function connect(){
        //inisialisasi koneksi
        $servername = "us-cdbr-iron-east-01.cleardb.net";
        $database = "heroku_5a22d471c4aec3b";
        $username = "b4744e3d37fb01";
        $password = "3570b4bc";
        
        //return PDO
        return new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    }

?>