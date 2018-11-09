<?php 
    require '../modules/admin_permission.inc';
    include '../modules/admin_modules.inc';
    
    $nama = $jenis_kelamin = $alamat = "";

    if (isset($_POST['ubah'])){
        
        edit_costumer($_POST['no_rek'], $_POST['nama'], $_POST['jenis_kelamin'], $_POST['alamat']);
        header('Location: adminIndex.php');
    }

    if (isset($_GET['id'])){
        try{
            $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');
            $id = $_GET['id'];

            $sql = "SELECT * FROM customer_data WHERE NO_REK = :id";
            
            $statement = $dbc->prepare($sql);
            $statement->bindValue(':id',$id);
            $statement->execute();
            
            foreach($statement as $row){
                $nama = $row['NAMA'];
                $jenis_kelamin = $row['JENIS_KELAMIN'];
                $alamat = $row['ALAMAT'];
            }
            
        } catch(PDOException $err){
            echo $err->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quick Internet Banking</title>
    <link rel="stylesheet" type="text/css" href="../public/css/costumer_edit_form.css">
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
            <h3>Formulir Ubah Nasabah</h3>
            <div class="add-form">
                <form method="post" action="costumer_edit_form.php?">
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Nama</label>
                        </div>
                        <div class="form-control-input">
                            <input type="text" name="nama" size="22" placeholder="Nama Nasabah" value="<?php echo $nama; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Jenis Kelamin</label>
                        </div>
                        <div class="form-control-input">
                            <?php
                                if ($jenis_kelamin == "Laki-Laki"){
                                     echo "<input type='radio' name='jenis_kelamin' value='Laki-Laki' checked>Laki - Laki
                                     <input type='radio' name='jenis_kelamin' value='Perempuan'>Perempuan";
                                }
                                else{
                                    echo "<input type='radio' name='jenis_kelamin' value='Laki-Laki'>Laki - Laki
                                    <input type='radio' name='jenis_kelamin' value='Perempuan' checked>Perempuan";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-label">
                            <label>Alamat</label>
                        </div>
                        <div class="form-control-input">
                            <textarea name="alamat" placeholder="Alamat" cols="17"><?php echo $alamat; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="ubah" value="Ubah">
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
