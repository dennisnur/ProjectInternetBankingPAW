<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.php';
    include '../modules/customer_modules.php';
    //deklarasi variabel
    $user = $_SESSION['customer'];
    //memanggil fungsi profile_customer()
    profile_customer($user);
?>
<?php include 'headerCustomer.php'; //menambahkan file headerCustomer.php?>
<!-- Bagian isi konten halaman berupa tombol pilihan no rekening yang ingin ditampilkan data riwayat transaksinya -->
<div class="content">
    <h3>Riwayat Transaksi</h3>
    <div class="transaction-history">
        <div class="container-form">
            <form method="post" action="customerTransactionHistory.php">
                <select class="select-riwayat" name="riwayat_no_rek">
                    <option>Pilih No Rekening</option>
                    <?php daftar_norek_pengirim($GLOBALS['id']) //memanggil fungsi daftar_norek_pengirim;?>
                </select>
                <input type="submit" name="pilih" value="Pilih" class="tombol-pilih-riwayat">
            </form>
        </div>
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Jumlah Uang</th>
                <th>Jenis</th>
                <th>Saldo Akhir</th>
            </tr>
            <?php
                //kondisi ketika user submit pilihan no rekening, akan langsung memanggil fungsi riwayat_transaksi() untuk menampilkan data riwayat transaksi
                if(isset($_POST['pilih'])){
                    riwayat_transaksi($_POST['riwayat_no_rek']);
                }
            ?>
        </table>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
