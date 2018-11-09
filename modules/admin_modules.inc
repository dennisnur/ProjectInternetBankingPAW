<?php

    function daftar_costumer(){
        try {
            $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "SELECT NO_REK, NAMA, JENIS_KELAMIN, ALAMAT FROM customer_data";

            $statement = $dbc->prepare($sql);
            $statement->execute();

            foreach ($statement as $row) {
                echo "<tr>
                        <td>{$row['NO_REK']}</td>
                        <td>{$row['NAMA']}</td>
                        <td>{$row['JENIS_KELAMIN']}</td>
                        <td>{$row['ALAMAT']}</td>
                        <td><a class='tombol-ubah' href='costumer_edit_form.php?id={$row['NO_REK']}'>Ubah</a></td>
                        <td><a class='tombol-hapus' href='adminIndex.php?id={$row['NO_REK']}'>Hapus</a></td>
                    </tr>";
                if (isset($_GET['id'])){
                    echo $_GET['id'];
                    hapus_costumer($_GET['id']);
                    header('Location: adminIndex.php');
                }
            }
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    
    function tambah_costumer($no_rek, $nama, $jenis_kelamin, $alamat, $saldo, $username, $password){
        try {
            $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "INSERT INTO customer_data(NO_REK, NAMA, JENIS_KELAMIN, ALAMAT, SALDO, USERNAME_CUST, PASSWORD_CUST) VALUES(:no_rek,:nama,:jenis_kelamin,:alamat,:saldo,:username, SHA2(:password,0))";

            $statement = $dbc->prepare($sql);

            $statement->bindValue(':no_rek',$no_rek);
            $statement->bindValue(':nama',$nama);
            $statement->bindValue(':jenis_kelamin',$jenis_kelamin);
            $statement->bindValue(':alamat',$alamat);
            $statement->bindValue(':saldo',$saldo);
            $statement->bindValue(':username',$username);
            $statement->bindValue(':password',$password);
            $statement->execute();
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    
    function edit_costumer($no_rek, $nama, $jenis_kelamin, $alamat){
        try{
            $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');
            
            $sql = "UPDATE customer_data SET NO_REK = :no_rek, NAMA = :nama, JENIS_KELAMIN = :jenis_kelamin, ALAMAT = :alamat WHERE NO_REK = :no_rek";
            
            $statement = $dbc->prepare($sql);
            $statement->bindValue(':no_rek',$no_rek);
            $statement->bindValue(':nama',$nama);
            $statement->bindValue(':jenis_kelamin',$jenis_kelamin);
            $statement->bindValue(':alamat',$alamat);
            $statement->execute();
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    function hapus_costumer($id){
        try {
            $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "DELETE FROM customer_data WHERE NO_REK = :id";

            $statement = $dbc->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
?>