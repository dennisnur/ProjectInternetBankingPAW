<?php
    //menambahkan file yang dibutuhkan
    require '../modules/admin_permission.php';
    include '../modules/admin_modules.php';
    
    //deklarasi variabel
    $error = false;
    $error_name = $error_gender = $error_birthday = $error_address = $error_email = $error_number = $error_username = $error_password = $error_confirm_password = "";
    //kondisi ketika submit formulir
    if (isset($_POST['add'])){
        require '../modules/validate_input.php';
        //memanggil fungsi validasi untuk input formulir
        validateNama($error_name,$_POST,'nama',$error);
        validateJenisKelamin($error_gender,$_POST,'jenis_kelamin',$error);
        validateTanggalLahir($error_birthday,$_POST,'tanggal_lahir',$error);
        validateAlamat($error_address,$_POST,'alamat',$error);
        validateEmail($error_email,$_POST,'email',$error);
        validateMobileNumber($error_number,$_POST,'no_tlp',$error);
        validateNamaPengguna($error_username,$_POST,'username',$error);
        validatePassword($error_password, $_POST, 'password', $error); validateConfirmPassword($error_confirm_password,$_POST,'confirm_password',$error,$_POST['password']);
        //kondisi jika terjadi error
        if ($error){
            if(!isset($_SESSION)){
                include 'customerDataForm.php';
            }
        }
        else{
            //memanggil fungsi tambah_customer();
            tambah_customer($_POST['nama'], $_POST['jenis_kelamin'], $_POST['alamat'], $_POST['email'], $_POST['tanggal_lahir'], $_POST['no_tlp'], $_POST['username'], $_POST['password']);
            header('Location: adminIndex.php');
        }   
    }
?>
<?php include 'headerAdmin.php'; //menambahkan file headerAdmin.php?>
<!-- Bagian isi konten halaman berupa formulir -->
<div class="content">
    <!-- Bagian tombol bantuan -->
    <div class="help">
        <button class="help-button" onclick="helpIndex()">?</button>
    </div>
    <!-- Bagian keterangan bantuan -->
    <div class="help-description" id="help-description">
        <span>Untuk menambahkan data nasabah<br>baru, isi seluruh isian pada formulir<br>dengan benar dan tepat.
        </span>
    </div>
    <h3>Formulir Tambah Nasabah</h3>
    <div class="add-form">
        <form method="post" action="customerDataForm.php">
            <div class="form-group">
                <div class="form-control-label">
                    <label>Nama</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="nama" size="22" placeholder="Nama Nasabah" value="<?php ?>">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_name;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Jenis Kelamin</label>
                </div>
                <div class="form-control-input">
                    <input type="radio" name="jenis_kelamin" value="Laki-Laki">Laki - Laki
                    <input type="radio" name="jenis_kelamin" value="Perempuan">Perempuan
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_gender;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Tanggal Lahir</label>
                </div>
                <div class="form-control-input">
                    <input type="date" name="tanggal_lahir" size="22">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_birthday;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Alamat</label>
                </div>
                <div class="form-control-input">
                    <textarea name="alamat" placeholder="Alamat" cols="17"></textarea>
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_address;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Email</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="email" size="22" placeholder="example@email.com">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_email;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>No Telepon</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="no_tlp" size="22" placeholder="12 Digit Angka">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_number;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Nama Pengguna</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="username" size="22" placeholder="Nama Pengguna">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_username;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Kata Sandi</label>
                </div>
                <div class="form-control-input">
                    <input type="password" name="password" size="22" placeholder="Kata Sandi">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_password;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Konfirmasi Kata Sandi</label>
                </div>
                <div class="form-control-input">
                    <input type="password" name="confirm_password" size="22" placeholder="Konfirmasi Kata Sandi">
                </div>
                <div class="form-control-error">
                    <span><?php echo $error_confirm_password;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-input">
                    <a href="adminIndex.php" class="tombol-batal-tambah">Kembali</a>
                </div>
                <div class="form-control-error">
                    <input class="tombol-tambah-data" type="submit" name="add" value="Tambah">
                </div>
            </div>

        </form>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
