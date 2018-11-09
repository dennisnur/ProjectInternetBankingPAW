<?php

    function nama_costumer($username){
        try{
            $GLOBALS['nama'] = "";
            $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "SELECT NAMA FROM customer_data WHERE USERNAME_CUST = :username";

            $statement = $dbc->prepare($sql);
            $statement->bindValue(':username',$username);
            $statement->execute();

            foreach ($statement as $row) {
                $GLOBALS['nama'] = $row['NAMA'];
            }
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    function daftar_rekening($username){
        try{
            $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "SELECT NO_REK, SALDO FROM customer_data WHERE USERNAME_CUST = :username";

            $statement = $dbc->prepare($sql);
            $statement->bindValue(':username',$username);
            $statement->execute();

            foreach ($statement as $row) {
                echo "<tr>
                        <td>{$row['NO_REK']}</td>
                        <td>{$row['SALDO']}</td>
                    </tr>";
            }
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
?>