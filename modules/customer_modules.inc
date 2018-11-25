<?php
    
    include 'connection.inc';
    
    function profile_customer($username){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            //deklarasi variabel
            $GLOBALS['id'] = $GLOBALS['nama'] = $GLOBALS['jenis_kelamin'] = $GLOBALS['tanggal_lahir'] = $GLOBALS['alamat'] = $GLOBALS['email'] = $GLOBALS['no_tlp'] = "";

            $sql = "SELECT ID_CUST, NAMA, JENIS_KELAMIN, TANGGAL_LAHIR, ALAMAT, EMAIL, NO_TELP FROM customer WHERE USERNAME_CUST = :username";

            $statement = $connection->prepare($sql);
            $statement->bindValue(':username',$username);
            $statement->execute();

            foreach ($statement as $row) {
                $GLOBALS['id'] = $row['ID_CUST'];
                $GLOBALS['nama'] = $row['NAMA'];
                $GLOBALS['jenis_kelamin'] = $row['JENIS_KELAMIN'];
                $GLOBALS['tanggal_lahir'] = $row['TANGGAL_LAHIR'];
                $GLOBALS['alamat'] = $row['ALAMAT'];
                $GLOBALS['email'] = $row['EMAIL'];
                $GLOBALS['no_tlp'] = $row['NO_TELP'];
            }
            
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    function daftar_rekening($id){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            //$dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "SELECT NO_REK, SALDO FROM rekening WHERE ID_CUST = :id";

            $statement = $connection->prepare($sql);
            $statement->bindValue(':id',$id);
            $statement->execute();

            foreach ($statement as $row) {
                echo "<tr>
                        <td>{$row['NO_REK']}</td>
                        <td>Rp. {$row['SALDO']},-</td>
                    </tr>";
            }
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    function daftar_norek_pengirim($id){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            //$dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "SELECT NO_REK FROM rekening WHERE ID_CUST = :id";

            $statement = $connection->prepare($sql);
            $statement->bindValue(':id',$id);
            $statement->execute();

            foreach ($statement as $row) {
                echo "<option value='{$row['NO_REK']}'>{$row['NO_REK']}</option>";
            }
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    
    function daftar_norek_penerima($id){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            //$dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "SELECT NO_REK FROM rekening WHERE ID_CUST != :id";

            $statement = $connection->prepare($sql);
            $statement->bindValue(':id',$id);
            $statement->execute();
            
            foreach ($statement as $row) {
                echo "<option value='{$row['NO_REK']}'>{$row['NO_REK']}</option>";
            }
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    function transfer_customer($no_rek_pengirim, $no_rek_penerima, $jumlah_uang, $debit, $kredit, $saldo){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            //$dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

            $sql = "SELECT SALDO FROM rekening WHERE NO_REK = :no_rek_pengirim";

            $statement = $connection->prepare($sql);
            $statement->bindValue(':no_rek_pengirim',$no_rek_pengirim);
            $statement->execute();
            
            foreach($statement as $row){
                $saldo = $row['SALDO'];
            }
        
            $saldo = ((int)$saldo - (int)$jumlah_uang);
                
            $sql = "UPDATE rekening SET SALDO = :saldo_baru WHERE NO_REK = :no_rek_pengirim";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':no_rek_pengirim',$no_rek_pengirim);
            $statement->bindValue(':saldo_baru',$saldo);
            $statement->execute();
            
            $sql = "INSERT INTO daftar_transaksi (ID_STATUS, NO_REK_PENGIRIM, NO_REK_PENERIMA, JUMLAH_UANG, SALDO_AKHIR, TANGGAL, WAKTU) VALUES(:id_status, :no_rek_pengirim, :no_rek_penerima, :jumlah_uang, :saldo_akhir, CURDATE(), CURTIME())";
            
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id_status',$debit);
            $statement->bindValue(':no_rek_pengirim',$no_rek_pengirim);
            $statement->bindValue(':no_rek_penerima',$no_rek_penerima);
            $statement->bindValue(':jumlah_uang',$jumlah_uang);
            $statement->bindValue(':saldo_akhir',$saldo);
            $statement->execute();
            
            $sql = "SELECT SALDO FROM rekening WHERE NO_REK = :no_rek_penerima";

            $statement = $connection->prepare($sql);
            $statement->bindValue(':no_rek_penerima',$no_rek_penerima);
            $statement->execute();
            
            foreach($statement as $row){
                $saldo = $row['SALDO'];
            }
            
            $saldo = ((int)$saldo + (int)$jumlah_uang);
            
            $sql = "UPDATE rekening SET SALDO = :saldo_baru WHERE NO_REK = :no_rek_penerima";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':no_rek_penerima',$no_rek_penerima);
            $statement->bindValue(':saldo_baru',$saldo);
            $statement->execute();
            
            $sql = "INSERT INTO daftar_transaksi (ID_STATUS, NO_REK_PENGIRIM, NO_REK_PENERIMA, JUMLAH_UANG, SALDO_AKHIR, TANGGAL, WAKTU) VALUES(:id_status, :no_rek_pengirim, :no_rek_penerima, :jumlah_uang, :saldo_akhir, CURDATE(), CURTIME())";
            
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id_status',$kredit);
            $statement->bindValue(':no_rek_pengirim',$no_rek_penerima);
            $statement->bindValue(':no_rek_penerima',$no_rek_pengirim);
            $statement->bindValue(':jumlah_uang',$jumlah_uang);
            $statement->bindValue(':saldo_akhir',$saldo);
            $statement->execute();
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    function riwayat_transaksi($no_rek){
        try{            
            $waktu = ""; //inisialisasi variabel
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            //query
            $sql = "SELECT ID_TRANSAKSI, KETERANGAN, JUMLAH_UANG, SALDO_AKHIR, TANGGAL, WAKTU FROM daftar_transaksi, jenis_transaksi WHERE NO_REK_PENGIRIM = :no_rek AND daftar_transaksi.ID_STATUS = jenis_transaksi.ID_STATUS ";

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':no_rek',$no_rek); //bindValue statement
            $statement->execute(); //mengeksekusi statement
            
            //menampilkan hasil eksekusi query ke HTML menggunakan foreach
            foreach ($statement as $row) {
                $waktu = $row['WAKTU'];
                $waktu = substr($waktu,11,5);
                echo "<tr>
						<td>{$row['TANGGAL']}</td>
						<td>{$waktu}</td>
						<td>Rp {$row['JUMLAH_UANG']},-</td>
                        <td>{$row['KETERANGAN']}</td>
                        <td>Rp {$row['SALDO_AKHIR']},-</td>
                    </tr>";
            }
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    function edit_customer_profile($id, $password){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            
            $sql = "UPDATE customer SET PASSWORD_CUST = SHA2(:password,0) WHERE ID_CUST = :id"; //query
            
            $statement = $connection->prepare($sql); //prepare statement
            
            //statement bindValue
            $statement->bindValue(':id',$id);
            $statement->bindValue(':password',$password);
            
            $statement->execute(); //mengeksekusi statement
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
?>