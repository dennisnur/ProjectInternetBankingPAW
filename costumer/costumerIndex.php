<?php 
    require '../modules/costumer_permission.inc';
    include '../modules/costumer_modules.inc';
    
    $user = $_GET['user'];
    nama_costumer($user);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quick Internet Banking</title>
    <link rel="stylesheet" type="text/css" href="../public/css/costumerIndex.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>QB</h1>
            </div>
            <div class="menu">
                <a href="#">Rekening</a>
                <a href="#">Transaksi</a>
                <a href="#">Profile</a>
                <a href="#">About</a>
                <div class="menuRight">
                    <div class="admin">
                        <p><?php echo $GLOBALS['nama'];?></p>
                    </div>
                    <a href="../index.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="content">
            <h3>Daftar Rekening</h3>
            <table>
                <tr>
                    <th>No Rekening</th>
                    <th>Saldo</th>
                </tr>
                <?php daftar_rekening($user);?>
            </table>
        </div>
        <div class="footer">
            <p>Quick Bank</p>
            <p>&copy;2018</p>
        </div>
    </div>
</body>

</html>
