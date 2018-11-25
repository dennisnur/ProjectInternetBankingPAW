<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.inc';
    include '../modules/customer_modules.inc';
    //deklarasi variabel
    $user = $_SESSION['customer'];
    $id = "";
    //memanggil fungsi profile_customer();
    profile_customer($user);
?>
<?php include 'headerCustomer.php'; //menambahkan file headerCustomer.php?>
<!-- Bagian isi konten halaman berupa tabel data daftar rekening nasabah -->
<div class="content">
    <h3>Daftar Rekening</h3>
    <div class="view-rekening">
        <button class="tombol-bantuan" onclick="pop()">?</button>
        <div class="info" id="info">
            <p>Halaman ini berisi informasi rekening yang anda miliki.</p>
        </div>
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
