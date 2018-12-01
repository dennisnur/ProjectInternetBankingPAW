<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.php';
    include '../modules/customer_modules.php';
    //deklarasi variabel
    $user = $_SESSION['customer'];
    //memanggil fungsi profile_customer()
    profile_customer($user);
?>
<?php include 'headerCustomer.php'; //menambahkan fiel headerCustomer.php?>
<!-- Bagian isi konten halaman berupa pemberitahuan tansfer berhasil dilakukan -->
<div class="content">
    <h3>Halaman Informasi Transfer</h3>
    <div class="view-transaction">
        <p>Transfer sebesar Rp. <?php echo number_format($_GET['uang'],0,",","."); ?>,- ke no rekening <?php echo $_GET['rek']; ?> berhasil !</p>
        <a href="customerTransaction.php" class="tombol-kembali">Kembali</a>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
