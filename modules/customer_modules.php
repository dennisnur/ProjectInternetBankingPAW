<?php
    
    include 'connection.php';
    
    //fungsi untuk mendapatkan data detil customer
    function profile_customer($username){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            //deklarasi variabel
            $GLOBALS['id'] = $GLOBALS['nama'] = $GLOBALS['jenis_kelamin'] = $GLOBALS['tanggal_lahir'] = $GLOBALS['alamat'] = $GLOBALS['email'] = $GLOBALS['no_tlp'] = "";
            //query
            $sql = "SELECT ID_CUST, NAMA, JENIS_KELAMIN, TANGGAL_LAHIR, ALAMAT, EMAIL, NO_TELP FROM customer WHERE USERNAME_CUST = :username";

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':username',$username); //bindValue statement
            $statement->execute(); //execute statement
            
            //memasukkan hasil query ke dalam variabel dengan menggunakan foreach
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
    
    //fungsi untuk menampilkan daftar rekening customer
    function daftar_rekening($id){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            $sql = "SELECT NO_REK, SALDO FROM rekening WHERE ID_CUST = :id"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':id',$id); //bindValue statement
            $statement->execute(); //execute statement
            
            //menampilkan hasil query ke HTML dengan menggunakan foreach
            foreach ($statement as $row) {
                echo "<tr>
                        <td>{$row['NO_REK']}</td>
                        <td>Rp. ".number_format($row['SALDO'],0,",",".").",-</td>
                    </tr>";
            }
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    //fungsi untuk menampilkan daftar no rekening milik customer yang sedang login
    function daftar_norek_pengirim($id){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            $sql = "SELECT NO_REK FROM rekening WHERE ID_CUST = :id"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':id',$id); //bindValue statement
            $statement->execute(); //execute statement
            
            //menampilkan hasil query ke HTML dengan menggunakan foreach
            foreach ($statement as $row) {
                echo "<option value='{$row['NO_REK']}'>{$row['NO_REK']}</option>";
            }
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    //fungsi untuk menampilkan daftar no rekening selain customer yang sedang login
    function daftar_norek_penerima($id){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            $sql = "SELECT NO_REK FROM rekening WHERE ID_CUST != :id"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':id',$id); //bindValue statement
            $statement->execute(); //execute statement
            
            //menampilkan hasil query ke HTML dengan menggunakan foreach
            foreach ($statement as $row) {
                echo "<option value='{$row['NO_REK']}'>{$row['NO_REK']}</option>";
            }
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    //fungsi untuk melakukan transaksi transfer antar customer
    function transfer_customer($no_rek_pengirim, $no_rek_penerima, $jumlah_uang, $debit, $kredit, $saldo){
        try{
            define('TIMEZONE', 'Asia/Jakarta');
            date_default_timezone_set(TIMEZONE);
            $date = date('Y-m-d H:i:s');
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            
            $sql = "SELECT SALDO FROM rekening WHERE NO_REK = :no_rek_pengirim"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':no_rek_pengirim',$no_rek_pengirim); //bindValue statement
            $statement->execute(); //execute statement
            
            //memasukkan hasil query ke dalam variabel dengan menggunakan foreach
            foreach($statement as $row){
                $saldo = $row['SALDO'];
            }
        
            $saldo = ((int)$saldo - (int)$jumlah_uang); //perhitungan debet 
                
            $sql = "UPDATE rekening SET SALDO = :saldo_baru WHERE NO_REK = :no_rek_pengirim"; //query
            
            $statement = $connection->prepare($sql); //prepare statement
            //bindValue statement
            $statement->bindValue(':no_rek_pengirim',$no_rek_pengirim);
            $statement->bindValue(':saldo_baru',$saldo);
            $statement->execute(); //execute statement
            
            //query
            $sql = "INSERT INTO daftar_transaksi (ID_STATUS, NO_REK_PENGIRIM, NO_REK_PENERIMA, JUMLAH_UANG, SALDO_AKHIR, TANGGAL, WAKTU) VALUES(:id_status, :no_rek_pengirim, :no_rek_penerima, :jumlah_uang, :saldo_akhir, CURDATE(), :date)";
            
            $statement = $connection->prepare($sql); //prepare statement
            //bindValue statement
            $statement->bindValue(':id_status',$debit);
            $statement->bindValue(':no_rek_pengirim',$no_rek_pengirim);
            $statement->bindValue(':no_rek_penerima',$no_rek_penerima);
            $statement->bindValue(':jumlah_uang',$jumlah_uang);
            $statement->bindValue(':saldo_akhir',$saldo);
            $statement->bindValue(':date',$date);
            $statement->execute(); //execute statement
            
            $sql = "SELECT SALDO FROM rekening WHERE NO_REK = :no_rek_penerima"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':no_rek_penerima',$no_rek_penerima); //bindValue statement
            $statement->execute(); //execute statement
            
            //memasukkan hasil query ke dalam variabel dengan menggunakan foreach
            foreach($statement as $row){
                $saldo = $row['SALDO'];
            }
            
            $saldo = ((int)$saldo + (int)$jumlah_uang); //perhitungan kredit
            
            $sql = "UPDATE rekening SET SALDO = :saldo_baru WHERE NO_REK = :no_rek_penerima"; //query
            
            $statement = $connection->prepare($sql); //prepare statement
            //bindValue statement
            $statement->bindValue(':no_rek_penerima',$no_rek_penerima);
            $statement->bindValue(':saldo_baru',$saldo);
            $statement->execute(); //execute statement
            
            //query
            $sql = "INSERT INTO daftar_transaksi (ID_STATUS, NO_REK_PENGIRIM, NO_REK_PENERIMA, JUMLAH_UANG, SALDO_AKHIR, TANGGAL, WAKTU) VALUES(:id_status, :no_rek_pengirim, :no_rek_penerima, :jumlah_uang, :saldo_akhir, CURDATE(), :date)";
            
            $statement = $connection->prepare($sql); //prepare statement
            //bindValue statement
            $statement->bindValue(':id_status',$kredit);
            $statement->bindValue(':no_rek_pengirim',$no_rek_penerima);
            $statement->bindValue(':no_rek_penerima',$no_rek_pengirim);
            $statement->bindValue(':jumlah_uang',$jumlah_uang);
            $statement->bindValue(':saldo_akhir',$saldo);
            $statement->bindValue(':date',$date);
            $statement->execute(); //execute statement
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    //fungsi untuk menampilkan daftar riwayat transaksi
    function riwayat_transaksi($no_rek){
        try{            
            $waktu = ""; //inisialisasi variabel
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            //query
            $sql = "SELECT ID_TRANSAKSI, KETERANGAN, JUMLAH_UANG, SALDO_AKHIR, TANGGAL, WAKTU FROM daftar_transaksi, jenis_transaksi WHERE NO_REK_PENGIRIM = :no_rek AND daftar_transaksi.ID_STATUS = jenis_transaksi.ID_STATUS ORDER BY WAKTU DESC;";

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
						<td>Rp. ".number_format($row['JUMLAH_UANG'],0,",",".").",-</td>
                        <td>{$row['KETERANGAN']}</td>
                        <td>Rp. ".number_format($row['SALDO_AKHIR'],0,",",".").",-</td>
                    </tr>";
            }
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    //fungsi untuk mengubah kata sandi customer
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
