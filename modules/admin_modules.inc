<?php
    include 'connection.inc';
    //fungsi untuk menampilkan daftar nasabah dari tabel customer
    function daftar_customer(){
        try {
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            $sql = "SELECT ID_CUST, NAMA FROM customer"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->execute();
            
            //menampilkan hasil query ke HTML dengan foreach
            foreach ($statement as $row) {
                echo "<tr>
                        <td>{$row['NAMA']}</td>
                        <td><a class='tombol-rekening' href='customerRekeningList.php?id={$row['ID_CUST']}'>Detil</a></td>
                        <td><a class='tombol-ubah' href='customerEditForm.php?id={$row['ID_CUST']}'>Ubah</a></td>
                        <td><a class='tombol-hapus' href='adminIndex.php?id={$row['ID_CUST']}'>Hapus</a></td>
                    </tr>";
                if (isset($_GET['id'])){
                    echo $_GET['id'];
                    hapus_customer($_GET['id']);
                    header('Location: adminIndex.php');
                }
            }
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    
    //fungsi untuk menambah nasabah baru ke dalam tabel customer
    function tambah_customer($nama, $jenis_kelamin, $alamat, $email, $tanggal_lahir, $no_tlp, $username, $password){
        try {
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            
            //query
            $sql = "INSERT INTO customer(NAMA, JENIS_KELAMIN, ALAMAT, EMAIL, TANGGAL_LAHIR, NO_TELP, USERNAME_CUST, PASSWORD_CUST) VALUES(:nama, :jenis_kelamin, :alamat, :email, :tanggal_lahir, :no_tlp, :username, SHA2(:password,0))";

            $statement = $connection->prepare($sql); //prepare statement
            //bindValue statement
            $statement->bindValue(':nama',$nama);
            $statement->bindValue(':jenis_kelamin',$jenis_kelamin);
            $statement->bindValue(':alamat',$alamat);
            $statement->bindValue(':email',$email);
            $statement->bindValue(':tanggal_lahir',$tanggal_lahir);
            $statement->bindValue(':no_tlp',$no_tlp);
            $statement->bindValue(':username',$username);
            $statement->bindValue(':password',$password);
            
            $statement->execute();
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    
    //fungsi untuk mengubah data nasabah di tabel customer
    function edit_customer($id, $nama, $jenis_kelamin, $alamat, $email, $tanggal_lahir, $no_tlp, $username, $password){
        try{
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
            
            //query
            $sql = "UPDATE customer SET NAMA = :nama, JENIS_KELAMIN = :jenis_kelamin, ALAMAT = :alamat, EMAIL = :email, TANGGAL_LAHIR = :tanggal_lahir, NO_TELP = :no_tlp, USERNAME_CUST = :username, PASSWORD_CUST = SHA2(:password,0) WHERE ID_CUST = :id";
            
            $statement = $connection->prepare($sql); //prepare statement
            //bindValue statement
            $statement->bindValue(':id',$id);
            $statement->bindValue(':nama',$nama);
            $statement->bindValue(':jenis_kelamin',$jenis_kelamin);
            $statement->bindValue(':alamat',$alamat);
            $statement->bindValue(':email',$email);
            $statement->bindValue(':tanggal_lahir',$tanggal_lahir);
            $statement->bindValue(':no_tlp',$no_tlp);
            $statement->bindValue(':username',$username);
            $statement->bindValue(':password',$password);
            
            $statement->execute();
            
        }catch(PDOException $err){
            echo $err->getMessage();
        }
    }
    
    //fungsi untuk menghapus data nasabah dari tabel customer
    function hapus_customer($id){
        try {
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            $sql = "DELETE FROM customer WHERE ID_CUST = :id"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':id', $id); //bindValue statement
            $statement->execute();
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
  
    //fungsi untuk menampilkan rekening nasabah dari tabel rekening
    function detil_customer($id){
         try {
            //deklarasi variabel
            $GLOBALS['nama'] = $GLOBALS['jenis_kelamin'] = $GLOBALS['tanggal_lahir'] = $GLOBALS['alamat'] = $GLOBALS['email'] = $GLOBALS['no_tlp'] = $GLOBALS['username'] = "";
            $s_id = $id;
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            $sql = "SELECT NAMA, JENIS_KELAMIN, TANGGAL_LAHIR, ALAMAT, EMAIL, NO_TELP, USERNAME_CUST FROM customer WHERE ID_CUST = :id"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':id',$id); //bindValue statement
            $statement->execute();
            
            //menampilkan hasil query je HTML dengan foreach
            foreach ($statement as $row) {
                $GLOBALS['nama'] = $row['NAMA']; 
                $GLOBALS['jenis_kelamin'] = $row['JENIS_KELAMIN'];
                $GLOBALS['tanggal_lahir'] = $row['TANGGAL_LAHIR'];
                $GLOBALS['alamat'] = $row['ALAMAT'];
                $GLOBALS['email'] = $row['EMAIL'];
                $GLOBALS['no_tlp'] = $row['NO_TELP'];
                $GLOBALS['username'] = $row['USERNAME_CUST'];
            }
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
  
    //fungsi untuk menampilkan rekening nasabah dari tabel rekening
    function daftar_rekening_customer($id){
         try {
            //deklarasi variabel
            $GLOBALS['nama'] = $GLOBALS['jenis_kelamin'] = $GLOBALS['tanggal'] = $GLOBALS['alamat'] = $GLOBALS['email'] = $GLOBALS['no_telp'] = $GLOBALS['username'] = "";
            $s_id = $id;
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            $sql = "SELECT NO_REK FROM rekening WHERE ID_CUST = :id"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':id',$id); //bindValue statement
            $statement->execute();
            
            //menampilkan hasil query ke HTML dengan foreach
            foreach ($statement as $row) {
                echo "<tr>
                        <td>{$row['NO_REK']}</td>
                        <td><form method='post'>
                                <input type='hidden' name='id' value='{$row['NO_REK']}'>
                                <input type='submit' name='hapus' class='tombol-hapus' value='Hapus'>
                            </form>
                        </td>
                    </tr>";
            }
            if (isset($_POST['hapus'])){
                hapus_rekening($_POST['id']);
                header('Location: customerRekeningList.php?id='.$s_id);
            }
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    
    //fungsi untuk menambah rekening nasabah ke tabel rekening
    function tambah_rekening($no_rek, $id_cust, $saldo){
        try {
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            //query
            $sql = "INSERT INTO rekening(NO_REK, ID_CUST, SALDO) VALUES(:no_rek, :id_cust, :saldo)";

            $statement = $connection->prepare($sql); //prepare statement

            //bindValue statement
            $statement->bindValue(':no_rek',$no_rek);
            $statement->bindValue(':id_cust',$id_cust);
            $statement->bindValue(':saldo',$saldo);
            
            $statement->execute();
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    
    function hapus_rekening($rek){
        try {
            $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

            $sql = "DELETE FROM rekening WHERE NO_REK = :rek"; //query

            $statement = $connection->prepare($sql); //prepare statement
            $statement->bindValue(':rek', $rek); //bindValue statement
            $statement->execute();
            
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
?>