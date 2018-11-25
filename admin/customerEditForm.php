<?php
    //menambahkan file yang dibutuhkan
    require '../modules/admin_permission.inc';
    include '../modules/admin_modules.inc';
    //deklarasi variabel
    $id = $nama = $jenis_kelamin = $alamat = $tanggal_lahir = $email = $no_tlp = $username = "";
    //kondisi jika submit formulir
    if (isset($_POST['ubah'])){
        //memanggil fungsi edit_customer();
        edit_customer($_POST['id'], $_POST['nama'], $_POST['jenis_kelamin'], $_POST['email'], $_POST['alamat'], $_POST['tanggal_lahir'], $_POST['no_tlp'], $_POST['username'], $_POST['password']);
        header('Location: adminIndex.php');
    }
    //kondisi ketika mengambil nilai variabel id
    if (isset($_GET['id'])){
        //try statement
        try{
            $dbc = connect(); //melakukan koneksi ke database dengan memanggil fungsi connect()
            $id = $_GET['id']; //deklarasi variabel

            $sql = "SELECT * FROM customer WHERE ID_CUST = :id"; //query
            
            $statement = $dbc->prepare($sql); //prepare statement
            $statement->bindValue(':id',$id); //bindValue statement
            $statement->execute(); //execute statement
            
            //memasukkan hasil query dengan foreach ke dalam setiap variabel yang dibutuhkan
            foreach($statement as $row){
                $id = $row['ID_CUST'];
                $nama = $row['NAMA'];
                $jenis_kelamin = $row['JENIS_KELAMIN'];
                $alamat = $row['ALAMAT'];
                $tanggal_lahir = $row['TANGGAL_LAHIR'];
                $email = $row['EMAIL'];
                $no_tlp = $row['NO_TELP'];
                $username = $row['USERNAME_CUST'];
            }
          //catch statement  
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
?>
<?php include 'headerAdmin.php'; //menambahkan file headerAdmin.php;?>
<!-- Bagian isi konten halaman berupa formulir  -->
<div class="content">
    <h3>Formulir Ubah Nasabah</h3>
    <div class="add-form">
        <form method="post" action="customerEditForm.php">
            <div class="form-group">
                <div class="form-control-label">
                    <label>Nama</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="nama" size="22" value="<?php echo $nama; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Jenis Kelamin</label>
                </div>
                <div class="form-control-input">
                    <?php
                        if ($jenis_kelamin == "Laki-Laki"){
                             echo "<input type='radio' name='jenis_kelamin' value='Laki-Laki' checked>Laki - Laki
                             <input type='radio' name='jenis_kelamin' value='Perempuan'>Perempuan";
                        }
                        else{
                            echo "<input type='radio' name='jenis_kelamin' value='Laki-Laki'>Laki - Laki
                            <input type='radio' name='jenis_kelamin' value='Perempuan' checked>Perempuan";
                        }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Tanggal Lahir</label>
                </div>
                <div class="form-control-input">
                    <input type="date" name="tanggal_lahir" size="22" value="<?php echo $tanggal_lahir; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Alamat</label>
                </div>
                <div class="form-control-input">
                    <textarea name="alamat" cols="17"><?php echo $alamat; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Email</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="email" size="22" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>No Telepon</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="no_tlp" size="22" value="<?php echo $no_tlp; ?>">
                </div>

            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Nama Pengguna</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="username" size="22" placeholder="Nama Pengguna" value="<?php echo $username; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Kata Sandi</label>
                </div>
                <div class="form-control-input">
                    <input type="password" name="password" size="22" placeholder="Kata Sandi">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Konfirmasi Kata Sandi</label>
                </div>
                <div class="form-control-input">
                    <input type="password" name="confirm_password" size="22" placeholder="Konfirmasi Kata Sandi">
                </div>
            </div>

            <div class="form-group">
                <div class="form-control-input">
                    <input type="hidden" name="id" size="22" value="<?php echo $id; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-input">
                    <a href="adminIndex.php" class="tombol-batal-tambah">Kembali</a>
                </div>
                <div class="form-control-error">
                    <input class="tombol-tambah-data" type="submit" name="ubah" value="Ubah">
                </div>
            </div>
        </form>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
