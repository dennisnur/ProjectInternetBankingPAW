<?php
    function checkPassword($username, $pass){
        $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');
    
        $statement = $dbc->prepare("SELECT * FROM admin WHERE USERNAME_ADM = :username and PASSWORD_ADM = SHA2(:password, 0)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $pass);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
    
    function checkPasswordCostumer($username, $pass){
        $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');
    
        $statement = $dbc->prepare("SELECT USERNAME_CUST, PASSWORD_CUST FROM customer_data WHERE USERNAME_CUST = :username and PASSWORD_CUST = SHA2(:password, 0)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $pass);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
?>