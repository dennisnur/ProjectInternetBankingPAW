<?php
    //fungsi untuk cek login user sebagai admin
    include 'connection.php';
    function checkPassword($username, $pass){
        $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
        
        //prepare statement
        $statement = $connection->prepare("SELECT * FROM admin WHERE USERNAME_ADM = :username and PASSWORD_ADM = SHA2(:password, 0)");
        
        //bindValue statement
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $pass);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
    
    //fungsi untuk cek login user sebagai customer / nasabah
    function checkPasswordCustomer($username, $pass){
        $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
        
        //prepare statement
        $statement = $connection->prepare("SELECT USERNAME_CUST, PASSWORD_CUST FROM customer WHERE USERNAME_CUST = :username and PASSWORD_CUST = SHA2(:password, 0)");
        
        //bindValue statement
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $pass);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
?>