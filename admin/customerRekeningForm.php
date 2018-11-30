<?php
    //menambahkan file yang dibutuhkan
    require '../modules/admin_permission.php';
    include '../modules/admin_modules.php';
    //deklarasi variabel
    $error = false;
    $error_no = $error_saldo = "";
    $id = $_GET['id'];
    //kondisi jika user submit formulir
    if (isset($_POST['add'])){
        require '../modules/validate_input.php';
        //memanggil fungsi validasi untuk memvalidasi input dari user
        validateNoRekening($error_no,$_POST,'no_rek',$error);
        validateSaldo($error_saldo,$_POST,'saldo',$error);
        //kondisi jika ada kesalahan input
        if ($error){
            if(!isset($_SESSION)){
                include 'customerRekeningForm.php?id=<?php echo $id; ?>';
            }
        }
        else{
            //kondisi ketika tidak ada kesalahan input, akan langsung memanggil fungsi tambah_rekening();
            tambah_rekening($_POST['no_rek'], $_POST['id'], $_POST['saldo'], $_POST['pin']);
            header('Location: customerRekeningList.php?id='.$id);
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
        <span>Untuk menambahkan Nomor Rekening<br>baru, isi seluruh isian pada formulir<br>dengan benar dan tepat.
        </span>
    </div>
    <h3>Formulir Tambah Rekening</h3>
    <div class="add-form">
        <form method="post" action="customerRekeningForm.php?id=<?php echo $id?>">
            <div class="form-group">
                <div class="form-control-label">
                    <label>No Rekening</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="no_rek" size="22" placeholder="16 Digit Angka">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_no;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Saldo</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="saldo" size="22" placeholder="Min Rp. 100.000,-">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_saldo;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-input">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-input">
                    <a href="customerRekeningList.php?id=<?php echo $id ?>" class="tombol-batal-tambah">Kembali</a>
                </div>
                <div class="form-control-error">
                    <input class="tombol-tambah-data" type="submit" name="add" value="Tambah">
                </div>
            </div>
        </form>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
