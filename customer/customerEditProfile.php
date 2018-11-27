<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.php';
    include '../modules/customer_modules.php';
    //deklarasi variabel
    $error = false;
    $error_old_password = $error_password = $error_confirm_password = "";
    $user = $_SESSION['customer'];
    //memanggil fungsi profile_customer();
    profile_customer($user);
    //kondisi ketika user submit formulir
    if (isset($_POST['ubah'])){
        require '../modules/validate_input.php';
        //memanggil fungsi validasi untuk memvakidasi input user
        validateOldPassword($error_old_password,$_POST,'old_password',$error);
        validatePassword($error_password,$_POST,'password',$error);
        validateConfirmPassword($error_confirm_password,$_POST,'confirm_password',$error,$_POST['password']);
        //kondisi ketika ada kesalahan input dari user
        if ($error){
            if(!isset($_SESSION)){
                include 'customerEditProfile.php';
            }
        }
        else{
            //kondisi ketika input dari user benar, akan langsung memaanggil fungsi edit_customer_profile();
            edit_customer_profile($_POST['id'], $_POST['password']);
            header('Location: customerEditSuccess.php');    
        }
    }

?>
<?php include 'headerCustomer.php'; //menambahkan file headerCustomer.php?>
<!-- Bagian isi konten halaman berupa formulir -->
<div class="content">
    <h3>Formulir Ubah Password</h3>
    <div class="add-form">
        <form method="post" action="customerEditProfile.php">
            <div class="form-group">
                <div class="form-control-label">
                    <label>Kata Sandi Sekarang</label>
                </div>
                <div class="form-control-input">
                    <input type="password" name="old_password" size="22" placeholder="Kata Sandi Sekarang">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_old_password;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Kata Sandi Baru</label>
                </div>
                <div class="form-control-input">
                    <input type="password" name="password" size="22" placeholder="Kata Sandi baru">
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
                    <span>
                        <?php echo $error_confirm_password;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-input">
                    <input type="hidden" name="id" size="22" value="<?php echo $id; ?>">
                </div>
            </div>
            <div class="form-group">
                <a href="customerProfile.php" class="tombol-batal-transfer">Kembali</a>
                <input type="submit" name="ubah" value="Ubah" class="tombol-kirim-transfer">
            </div>
        </form>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
