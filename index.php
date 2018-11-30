<?php
    include 'modules/validate.php'; //include file
    $error = "";
    session_start(); //start session
    //kondisi jika session telah berjalan maka akan dialihkan ke halaman selain index
    if (@$_SESSION['admin']){
        header('Location: ./admin/adminIndex.php');
    }
    else if(@$_SESSION['customer']){
        header('Location: ./customer/customerIndex.php');
    }
    
    //kondisi ketika login admin maupun customer dan kesalahan saat login
    if (isset($_POST['login'])){
        if (checkPassword($_POST['username'], $_POST['password'])){
            session_start();
            $_SESSION['admin'] = true;
            header('Location: ./admin/adminIndex.php');
            exit();
        }
        else if (checkPasswordCustomer($_POST['username'], $_POST['password'])) {
            session_start();
            $_SESSION['customer'] = $_POST['username'];
            header('Location: ./customer/customerIndex.php');
            exit();
        }
        else{
            $error = "Nama Pengguna & Kata Sandi Salah !";
        }
    }
?>
<!-- Bagian header, dengan include file header.php -->
<?php include 'header.php'; ?>
<!-- Bagian konten index yang berisi deskripsi dan form login admin maupun customer -->
<div class="content">
    <!-- Bagian tombol bantuan -->
    <div class="help">
        <button class="help-button" onclick="helpIndex()">?</button>
    </div>
    <!-- Bagian keterangan bantuan -->
    <div class="help-description" id="help-description">
        <span>Silahkan Masuk dengan Nama Pengguna & Kata Sandi anda.</span>
    </div>
    <h2>Selamat Datang
        <br />di Quick Online</h2>
    <!-- Bagian deskripsi -->
    <div class="description">
        <p>Nikmati layanan <strong>Quick Online,</strong><br />solusi Internet Banking terbaru.</p>
    </div>
    <div class="content-login">
        <h3>Masuk</h3>
        <!-- Bagian form login-->
        <form action="index.php" method="post">
            <div class="content-input">
                <input type="text" name="username" placeholder="Nama Pengguna">
            </div>
            <div class="content-input">
                <input type="password" name="password" placeholder="Kata Sandi">
            </div>
            <div class="error">
                <span>
                    <?php echo $error ?></span>
            </div>
            <div class="content-input">
                <input class="btn-login" style="width: 58%;" type="submit" name="login" value="Masuk">
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>
