<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.php';
    include '../modules/customer_modules.php';
    //deklarasi variabel
    $user = $_SESSION['customer'];
    //memanggil fungsi profile_customer
    profile_customer($user);
?>
<?php include 'headerCustomer.php'; //menambahkan file headerCustomer.php?>
<!-- Bagian isi konten halaman berupa tombol transfer dan tombol riwayat transaksi-->
<div class="content">
    <h3>Halaman Transaksi</h3>
    <div class="view-transaction">
        <a class="tombol-transfer" href="customerTransferForm.php">Transfer</a>
        <a class="tombol-riwayat" href="customerTransactionHistory.php">Riwayat Transaksi</a>
    </div>
</div>
<?php include '../footer.php'; ?>
