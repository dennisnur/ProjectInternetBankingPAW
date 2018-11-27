<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.php';
    include '../modules/customer_modules.php';
    //deklarasi variabel
    $user = $_SESSION['customer'];
    $debit = 1;
    $kredit = 11;
    $error = false;
    $error_no_rek_pengirim = $error_no_rek_penerima = $error_jumlah_uang = $error_pin = $id = $saldo = "";
    //memanggil fungsi profile_customer();
    profile_customer($user);
    //kondisi ketika user submit formulir 
    if(isset($_POST['transfer'])){
        require '../modules/validate_input.php';
        //memanggil fungsi validasi untuk memvalidasi input dari user
        validateNoRekTransfer($error_no_rek_pengirim, $_POST, 'no_rek_pengirim', $error);
        validateNoRekTransfer2($error_no_rek_penerima, $_POST, 'no_rek_penerima', $error);
        validateJumlahUang($error_jumlah_uang, $_POST, 'jumlah_uang', $error);
        validateSaldoRekening($error_no_rek_pengirim, $_POST, 'no_rek_pengirim', $error, $_POST['jumlah_uang']);
        //kondisi jika ada kesalahan input dari user
        if ($error){
            if(!isset($_SESSION)){
                include 'customerTransferForm.php';
            }
        }
        else {
            //kondisi ketika input dari user benar, akan langsung memanggil fungsi transfer_customer()
            transfer_customer($_POST['no_rek_pengirim'], $_POST['no_rek_penerima'], $_POST['jumlah_uang'],$debit, $kredit, $saldo);
            header('Location: customerTransferSuccess.php?uang='.$_POST['jumlah_uang'].'&rek='.$_POST['no_rek_penerima']);
        }
    }
?>
<?php include 'headerCustomer.php'; //menambahkan file headerCustomer.php?>
<!-- Bagian isi konten halaman berupa formulir berisi pilihan no rekening, no rekening tujuan, dan jumlah uang yang ingin ditransfer-->
<div class="content">
    <h3>Form Transfer</h3>
    <div class="add-form">
        <form method="post" action="customerTransferForm.php">
            <div class="form-group">
                <div class="form-control-label">
                    <label>No Rekening</label>
                </div>
                <div class="form-control-input">
                    <select name="no_rek_pengirim">
                        <option value="Pilih No Rekening">Pilih No Rekening</option>
                        <?php daftar_norek_pengirim($GLOBALS['id']); //memanggil fungsi daftar_norek_pengirim()?>
                    </select>
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_no_rek_pengirim;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>No Rekening Penerima</label>
                </div>
                <div class="form-control-input">
                    <select name="no_rek_penerima">
                        <option value="Pilih No Rekening">Pilih No Rekening</option>
                        <?php daftar_norek_penerima($GLOBALS['id']); //memanggil fungsi daftar_norek_penerima()?>
                    </select>
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_no_rek_penerima;?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-label">
                    <label>Jumlah Uang</label>
                </div>
                <div class="form-control-input">
                    <input type="text" name="jumlah_uang" size="22" placeholder="Maks Rp. 2.000.000,-">
                </div>
                <div class="form-control-error">
                    <span>
                        <?php echo $error_jumlah_uang;?></span>
                </div>
            </div>
            <div class="form-group">
                <a href="customerTransaction.php" class="tombol-batal-transfer">Kembali</a>
                <input type="submit" name="transfer" value="Kirim" class="tombol-kirim-transfer">
            </div>
        </form>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
