<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.php';
    include '../modules/customer_modules.php';
    //deklarasi variabel
    $user = $_SESSION['customer'];
    $id = "";
    //memanggil fungsi profile_customer();
    profile_customer($user);
?>
<?php include 'headerCustomer.php'; //menambahkan file headerCustomer.php?>
<!-- Bagian isi konten halaman berupa tabel data daftar rekening nasabah -->
<div class="content">
    <!-- Bagian tombol bantuan -->
    <div class="help">
        <button class="help-button" onclick="helpIndex()">?</button>
    </div>
    <!-- Bagian keterangan bantuan -->
    <div class="help-description" id="help-description">
        <span>Halaman ini berisi informasi.<br>Nomor Rekening dan Saldo Nasabah.<br>
        </span>
    </div>
    <h3>Daftar Rekening</h3>
    <div class="view-rekening">
        <table>
            <tr>
                <th>No Rekening</th>
                <th>Saldo</th>
            </tr>
            <?php daftar_rekening($GLOBALS['id']); //memanggil fungsi daftar_rekening()?>
        </table>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
