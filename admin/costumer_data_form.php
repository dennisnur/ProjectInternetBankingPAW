<?php 
    require '../modules/admin_permission.inc';
    include '../modules/admin_modules.inc';
    
    $error = false;
    $error_no = $error_name = $error_gender = $error_address = $error_saldo = $error_username = $error_password = "";
    
    if (isset($_POST['add'])){
        require '../modules/validate_input.inc';
        
        validateNoRekening($error_no,$_POST,'no_rek',$error);
        validateNama($error_name,$_POST,'nama',$error);
        validateJenisKelamin($error_gender,$_POST,'jenis_kelamin',$error);
        validateAlamat($error_address,$_POST,'alamat',$error);
        validateSaldo($error_saldo,$_POST,'saldo',$error);
        validateNamaPengguna($error_username,$_POST,'username',$error);
        validatePassword($error_password, $_POST, 'password', $error);
        
        if ($error){
            if(!isset($_SESSION)){
                include 'costumer_data_form.php';
            }
        }
        else{
            tambah_costumer($_POST['no_rek'], $_POST['nama'], $_POST['jenis_kelamin'], $_POST['alamat'],$_POST['saldo'], $_POST['username'], $_POST['password']);
            header('Location: adminIndex.php');
        }   
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quick Internet Banking</title>
    <link rel="stylesheet" type="text/css" href="../public/css/costumer_data_form.css">
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
            <h3>Formulir Tambah Nasabah</h3>
            <div class="add-form">
                <form method="post" action="costumer_data_form.php">
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>No Rekening</label>
                        </div>
                        <div class="form-control-input">
                            <input type="text" name="no_rek" size="22" placeholder="16 Digit Angka">
                        </div>
                        <div class="form-control-error">
                            <span><?php echo $error_no;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Nama</label>
                        </div>
                        <div class="form-control-input">
                            <input type="text" name="nama" size="22" placeholder="Nama Nasabah">
                        </div>
                        <div class="form-control-error">
                            <span><?php echo $error_name;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Jenis Kelamin</label>
                        </div>
                        <div class="form-control-input">
                            <input type="radio" name="jenis_kelamin" value="Laki-Laki">Laki - Laki
                            <input type="radio" name="jenis_kelamin" value="Perempuan">Perempuan
                        </div>
                        <div class="form-control-error">
                            <span><?php echo $error_gender;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Alamat</label>
                        </div>
                        <div class="form-control-input">
                            <textarea name="alamat" placeholder="Alamat" cols="17"></textarea>
                        </div>
                        <div class="form-control-error">
                            <span><?php echo $error_address;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Saldo</label>
                        </div>
                        <div class="form-control-input">
                            <input type="text" name="saldo" size="22" placeholder="Min Rp. 100000">
                        </div>
                        <div class="form-control-error">
                            <span><?php echo $error_saldo;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Nama Pengguna</label>
                        </div>
                        <div class="form-control-input">
                            <input type="text" name="username" size="22" placeholder="Nama Pengguna">
                        </div>
                        <div class="form-control-error">
                            <span><?php echo $error_username;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Kata Sandi</label>
                        </div>
                        <div class="form-control-input">
                            <input type="password" name="password" size="22" placeholder="Kata Sandi">
                        </div>
                        <div class="form-control-error">
                            <span><?php echo $error_password;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="add" value="Tambah">
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
            <p>Quick Bank</p>
            <p>&copy;2018</p>
        </div>
    </div>
</body>

</html>
