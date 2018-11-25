<?php
    //memanggil file yang dibutuhkan
    require '../modules/admin_permission.inc';
    include '../modules/admin_modules.inc';
?>
<?php include 'headerAdmin.php'; //include file headerAdmin.php ?>
<!-- Bagian konten halaman -->
<div class="content">
    <h3>Daftar Nasabah</h3>
    <!-- Menampilkan data dalam tabel -->
    <div class="view-customer">
        <table>
            <tr>
                <th>Nama</th>
                <th colspan="3">Tindakan</th>
            </tr>
            <?php daftar_customer(); //memanggil fungsi daftar_customer() ?>
            <tr>
                <td colspan="6" style="border:none;"><a class="tombol-tambah" href="customerDataForm.php">Tambah</a></td>
            </tr>
        </table>
    </div>
</div>
<?php include '../footer.php'; //include file footer.php?>
