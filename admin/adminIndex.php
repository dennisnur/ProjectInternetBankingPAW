<?php 
    require '../modules/admin_permission.inc';
    include '../modules/admin_modules.inc';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quick Internet Banking</title>
    <link rel="stylesheet" type="text/css" href="../public/css/adminIndex.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>QB</h1>
            </div>
            <div class="menu">
                <a href="adminIndex.php">Nasabah</a>
                <a href="#">Tentang</a>
                <div class="menuRight">
                    <div class="admin">
                        <p>Admin</p>
                    </div>
                    <a href="../logout.php">Keluar</a>
                </div>
            </div>
        </div>
        <div class="content">
            <h3>Daftar Nasabah</h3>
            <div class="view-costumer">
                <table>
                    <tr>
                        <th>No Rekening</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                     <?php daftar_costumer();?>
                    <tr>
                        <td colspan="6"><a class="tombol-tambah" href="costumer_data_form.php" >Tambah</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer">
            <p>Quick Bank</p>
            <p>&copy;2018</p>
        </div>
    </div>
</body>

</html>
