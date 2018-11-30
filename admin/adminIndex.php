<?php
    //memanggil file yang dibutuhkan
    require '../modules/admin_permission.php';
    include '../modules/admin_modules.php';
?>
<?php include 'headerAdmin.php'; //include file headerAdmin.php ?>
<!-- Bagian konten halaman -->
<div class="content">
    <!-- Bagian tombol bantuan -->
    <div class="help">
        <button class="help-button" onclick="helpIndex()">?</button>
    </div>
    <!-- Bagian keterangan bantuan -->
    <div class="help-description" id="help-description">
        <span>Halaman ini berisi Daftar Nasabah.<br>Terdapat 4 fitur pada halaman ini, yaitu:<br>
        </span>
        <ul>
            <li>Tambah Nasabah</li>
            <li>Detil Nasabah</li>
            <li>Ubah Nasabah</li>
            <li>Hapus Nasabah</li>
        </ul>
    </div>
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
                <td colspan="4" style="border:none;"><a class="tombol-tambah" href="customerDataForm.php">Tambah</a></td>
            </tr>
        </table>
    </div>
</div>
<?php include '../footer.php'; //include file footer.php?>
