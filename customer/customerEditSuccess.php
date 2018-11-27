<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.inc';
    include '../modules/customer_modules.inc';
    //deklarasi variabel
    $user = $_SESSION['customer'];
    //memanggil fungsi profile_customer()
    profile_customer($user);
?>
<?php include 'headerCustomer.php'; //menambahkan fiel headerCustomer.php?>
<!-- Bagian isi konten halaman berupa pemberitahuan password berhasil diperbarui berhasil dilakukan -->
<div class="content">
    <h3>Halaman Informasi Ubah Password</h3>
    <div class="view-transaction">
        <p>Password berhasil diubah !</p>
        <a href="customerProfile.php" class="tombol-kembali">Kembali</a>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
