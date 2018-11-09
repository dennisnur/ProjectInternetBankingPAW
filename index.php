<?php
    include 'modules/validate.inc';
    $error = "";
    if (isset($_POST['login'])){
        //echo checkPassword($_POST['username'], $_POST['passwd']);
        if (checkPassword($_POST['username'], $_POST['password'])){
            session_start();
            $_SESSION['admin'] = true;
            header('Location: ./admin/adminIndex.php');
            exit();
        }
        else if (checkPasswordCostumer($_POST['username'], $_POST['password'])) {
            session_start();
            $_SESSION['costumer'] = true;
            header('Location: ./costumer/costumerIndex.php?user='.$_POST['username']);
            exit();
        }
        else{
            $error = "Nama Pengguna & Kata Sandi Salah !";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quick Internet Banking</title>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>QB</h1>
            </div>
            <div class="menu">
                <a href="index.php">Beranda</a>
                <a href="#">Tentang</a>
            </div>
        </div>
        <div class="content">
            <h2>Selamat Datang
                <br />di Quick Online</h2>
            <div class="description">
                <p>Nikmati layanan <strong>Quick Online,</strong><br />solusi Internet Banking terbaru.</p>
            </div>
            <div class="container-login">
                <div class="content-login">
                    <h3>Masuk</h3>
                    <form action="index.php" method="post">
                        <div class="content-input">
                            <input type="text" name="username" placeholder="Nama Pengguna">
                        </div>
                        <div class="content-input">
                            <input type="password" name="password" placeholder="Kata Sandi">
                        </div>
                        <div class="error">
                            <span><?php echo $error ?></span>
                        </div>
                        <div class="content-input">
                            <input class="btn-login" style="width: 80%;" type="submit" name="login" value="Masuk">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>Quick Bank</p>
            <p>&copy;2018</p>
        </div>
    </div>
</body>

</html>
