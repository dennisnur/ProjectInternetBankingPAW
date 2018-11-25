<?php
    //menambahkan file yang dibutuhkan
    require '../modules/admin_permission.inc';
    include '../modules/admin_modules.inc';
    //deklarasi variabel
    $id = $_GET['id'];
    //memanggil fungsi detil_customer();
    detil_customer($id);
?>
<?php include 'headerAdmin.php'; //menambahkan file headerAdmin.php?>
<!-- Bagian isi konten halaman berupa tampilan data detil customer -->
<div class="content">
    <h3>Detil Nasabah</h3>
    <div class="view-customer">
        <div class="detil">
            <div class="row">
            <div class="column-label">
                <strong>Nama</strong>
            </div>
            <div class="column-value">
                <?php echo $GLOBALS['nama'];?>
            </div>
        </div>
        <div class="row">
            <div class="column-label">
                <strong>Jenis Kelamin</strong>
            </div>
            <div class="column-value">
                <?php echo $GLOBALS['jenis_kelamin'];?>
            </div>
        </div>
        <div class="row">
            <div class="column-label">
                <strong>Tanggal Lahir</strong>
            </div>
            <div class="column-value">
                <?php echo $GLOBALS['tanggal_lahir'];?>
            </div>
        </div>
        <div class="row">
            <div class="column-label">
                <strong>Alamat</strong>
            </div>
            <div class="column-value">
                <?php echo $GLOBALS['alamat'];?>
            </div>
        </div>
        <div class="row">
            <div class="column-label">
                <strong>Email</strong>
            </div>
            <div class="column-value">
                <?php echo $GLOBALS['email'];?>
            </div>
        </div>
        <div class="row">
            <div class="column-label">
                <strong>No Telpon</strong>
            </div>
            <div class="column-value">
                <?php echo $GLOBALS['no_tlp'];?>
            </div>
        </div>
            <div class="row">
            <div class="column-label">
                <strong>Username</strong>
            </div>
            <div class="column-value">
                <?php echo $GLOBALS['username'];?>
            </div>
        </div>
        </div>
        <table>
            <tr>
                <th>No Rekening</th>
                <th>Tindakan</th>
            </tr>
            <?php daftar_rekening_customer($id);?>
            <tr>
                <td colspan="2" style="border:none;">
                    <a href="adminIndex.php" class="tombol-batal">Kembali</a>
                    <a class="tombol-tambah" href="customerRekeningForm.php?id=<?php echo $id; ?>">Tambah</a>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
