<?php
    //menambahkan file yang dibutuhkan
    require '../modules/customer_permission.php';
    include '../modules/customer_modules.php';
    //deklarasi variabel
    $user = $_SESSION['customer'];
    //memanggil fungsi profile_cutomer()
    profile_customer($user);
?>
<?php include 'headerCustomer.php'; //menambahkan file headerCustomer.php?>
<!-- Bagian isi konten halaman berupa data detil customer -->
<div class="content">
    <!-- Bagian tombol bantuan -->
    <div class="help">
        <button class="help-button" onclick="helpIndex()">?</button>
    </div>
    <!-- Bagian keterangan bantuan -->
    <div class="help-description" id="help-description">
        <span>Halaman ini berisi informasi<br>detil nasabah. Terdapat fitur<br>Ubah Password.
        </span>
    </div>
    <h3>Detil Nasabah</h3>
    <div class="view-profile">
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
        <a class="tombol-ubah-password" href="customerEditProfile.php">Ubah Password</a>
    </div>
</div>
<?php include '../footer.php'; //menambahkan file footer.php?>
