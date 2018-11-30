<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Internet Banking</title>
        <!-- Menambahkan file css yang dibutuhkan -->
    <link rel="stylesheet" type="text/css" href="../public/css/headerCustomer.css">
    <link rel="stylesheet" type="text/css" href="../public/css/customerIndex.css">
    <link rel="stylesheet" type="text/css" href="../public/css/customerTransaction.css">
    <link rel="stylesheet" type="text/css" href="../public/css/customerTransactionForm.css">
    <link rel="stylesheet" type="text/css" href="../public/css/customerTransactionHistory.css">
    <link rel="stylesheet" type="text/css" href="../public/css/customerProfile.css">
    <link rel="stylesheet" type="text/css" href="../public/css/footer.css">
    <script src="../public/js/script.js"></script>
</head>

<body>
    <div class="container">
        <!-- Bagian Header -->
        <div class="header">
            <div class="logo">
                <h1>QB</h1>
            </div>
            <!-- Bagian Menu -->
            <div class="menu">
                <a href="customerIndex.php">Rekening</a>
                <a href="customerTransaction.php">Transaksi</a>
                <a href="customerProfile.php">Detil Akun</a>
                <div class="menuRight">
                    <div class="admin">
                        <p>
                            <?php echo $GLOBALS['nama'];?>
                        </p>
                    </div>
                    <a href="../logout.php">Keluar</a>
                </div>
            </div>
        </div>