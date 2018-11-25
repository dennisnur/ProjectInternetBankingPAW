<?php
    //fungsi untuk cek login user sebagai admin
    function checkPassword($username, $pass){
        $dbc = new PDO('mysql:host=localhost;dbname=banking','root',''); //koneksi database
        
        //prepare statement
        $statement = $dbc->prepare("SELECT * FROM admin WHERE USERNAME_ADM = :username and PASSWORD_ADM = SHA2(:password, 0)");
        
        //bindValue statement
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $pass);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
    
    //fungsi untuk cek login user sebagai customer / nasabah
    function checkPasswordCustomer($username, $pass){
        $dbc = new PDO('mysql:host=localhost;dbname=banking','root',''); //koneksi database
        
        //prepare statement
        $statement = $dbc->prepare("SELECT USERNAME_CUST, PASSWORD_CUST FROM customer WHERE USERNAME_CUST = :username and PASSWORD_CUST = SHA2(:password, 0)");
        
        //bindValue statement
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $pass);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
?>