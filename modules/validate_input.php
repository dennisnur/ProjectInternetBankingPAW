<?php
    //fungsi untuk validasi input no rekening
    function validateNoRekening(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^[0-9]+$/"; //format Reg Exp untuk angka
        
        $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

        $sql = "SELECT NO_REK FROM rekening"; //query

        $statement = $connection->prepare($sql); //prepare statement
        $statement->execute();
        
        //kondisi bila no rekenening sudah digunakan
        foreach($statement as $row){
            if ($field_list[$field_name] == $row['NO_REK']){
                $errors = 'No Rekening sudah digunakan';
                $error_con = true;
            }
        }
        
        //kondisi jika input no rekening kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'No Rekening dibutuhkan';
            $error_con = true;
        }
        //kondisi jika input tidak sesuai dengan pola regular expresion
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus berisi angka';
            $error_con = true;
        }
        //kondisi jika panjang karakter input kurang dari 16 
        else if (strlen($field_list[$field_name]) < 16 || strlen($field_list[$field_name]) > 16) {
            $errors = 'Harus terdiri dari 16 digit angka';
            $error_con = true;
        }
    }
    
    //Fungsi untuk validasi input nama
    function validateNama(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^[a-z A-Z'-]+$/";// format Reg Exp untuk huruf
        
        //kondisi jika input nama kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Nama diperlukan';
            $error_con = true;
        }
        //kondisi jika input tidak sesuai dengan pola regular expresion
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus berisi huruf';
            $error_con = true;
        }
    }
    
    //fungsi validasi input jenis kelamin
    function validateJenisKelamin(&$errors, $field_list, $field_name, &$error_con) {
        
        //kondisi jika input jenis kelamin kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Jenis Kelamin diperlukan';
            $error_con = true;
        }
    }
    
    //fungsi validasi input tanggal lahir
    function validateTanggalLahir(&$errors, $field_list, $field_name, &$error_con) {
        
        //kondisi jika input tanggal lahir kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Tanggal lahir diperlukan';
            $error_con = true;
        }
    }
    
    //fungsi validasi input alamat
    function validateAlamat(&$errors, $field_list, $field_name, &$error_con) {
        
        //kondisi jika input alamat kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Alamat diperlukan';
            $error_con = true;
        }
    }
    
    //fungsi validasi input email
    function validateEmail(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";// format email
        
        //kondisi jika input email kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Alamat email diperlukan';
            $error_con = true;
        }
        
        //kondisi jika input tidak sesuai dengan pola regular expresion 
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Alamat email salah';
            $error_con = true;
        }
    }
    
    //fungsi validasi input nomor telepon
    function validateMobileNumber(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^[0-9]+$/"; // format mobile number
        
        //kondisi jika input nomor telepon kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'No Telpon diperlukan';
            $error_con = true;
        }
        
        //kondisi jika input tidak sesuai dengan pola regular expresion 
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus angka';
            $error_con = true;
        }
        
        //kondisi jika input nomor telepon kurang dari 12 digits
        else if (strlen($field_list[$field_name]) < 12) {
            $errors = 'No Telpon kurang dari 12 digit';
            $error_con = true;
        }
    }
    
    //fungsi validasi input Saldo
    function validateSaldo(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^[0-9]+$/"; // format reg exp untuk angka
        
        //kondisi jika input saldo kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Saldo dibutuhkan';
            $error_con = true;
        }
        
        //kondisi jika input tidak sesuai dengan pola regular expresion
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus berisi angka';
            $error_con = true;
        }
        
        //kondisi jika input saldo kurang dari Rp. 100000
        else if ($field_list[$field_name] < 100000) {
            $errors = 'Minimal saldo sebesar Rp. 100.000,-';
            $error_con = true;
        }
    }
    
    //fungsi validasi input Nama Pengguna
    function validateNamaPengguna(&$errors, $field_list, $field_name, &$error_con) {
        $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

        $sql = "SELECT USERNAME_CUST FROM customer"; //query

        $statement = $connection->prepare($sql); //prepare statement
        $statement->execute();
        
        //kondisi bila no rekenening sudah digunakan
        foreach($statement as $row){
            if ($field_list[$field_name] == $row['USERNAME_CUST']){
                $errors = 'Nama Pengguna sudah digunakan';
                $error_con = true;
            }
        }
        
        
        //kondisi jika input nama pengguna kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Nama Pengguna diperlukan';
            $error_con = true;
        }
    }
    
    //fungsi validasi input password
    function validatePassword(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/";// format reg exp password
        
        //kondisi jika input passsword kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Kata Sandi diperlukan';
            $error_con = true;
        }
        
        //kondisi jika input tidak sesuai dengan pola regular expresion
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus terdiri dari 8 karakter mengandung huruf(besar & kecil) & angka';
            $error_con = true;
        }
    }
    
    function validateConfirmPassword(&$errors, $field_list, $field_name, &$error_con, &$passwd) {
        
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Konfirmasi kata sandi diperlukan';
            $error_con = true;
        }
        else if ($field_list[$field_name] != $passwd){
            $errors = "Kata sandi tidak sama";
            $error_con = true;
        }
    }
    
    //fungsi validasi input no rek pengirim
    function validateNoRekTransfer(&$errors, $field_list, $field_name, &$error_con){
        
        //kondisi jika input no rekening pengirim kosong
        if (!isset($field_list[$field_name]) || $field_list[$field_name] == 'Pilih No Rekening'){
            $errors = 'No Rekening Pengirim diperlukan';
            $error_con = true;
        }
    }
    
    //fungsi validasi input no rek penerima
    function validateNoRekTransfer2(&$errors, $field_list, $field_name, &$error_con){
        
        //kondisi jika input no rek penerima kosong
        if (!isset($field_list[$field_name]) || $field_list[$field_name] == 'Pilih No Rekening'){
            $errors = 'No Rekening Penerima diperlukan';
            $error_con = true;
        }
    }
    
    //fungsi validasi jumlah uang
    function validateJumlahUang(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^[0-9]+$/"; //Reg Exp number
        
        //kondisi jika input Jumlah uang kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name]) || $field_list[$field_name] <= 0){
            $errors = 'Jumlah Uang dibutuhkan';
            $error_con = true;
        }
        
        //kondisi jika input tidak sesuai dengan pola regular expresion
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus berisi angka';
            $error_con = true;
        }
        
        //kondisi jika input lebih dari Rp. 2000000
        else if ($field_list[$field_name] > 2000000) {
            $errors = 'Maksimal Rp. 2.000.000,-';
            $error_con = true;
        }
        
        //kondisi jika input lebih dari Rp. 2000000
        else if ($field_list[$field_name] < 50000) {
            $errors = 'Minimal Rp. 50.000,-';
            $error_con = true;
        }
    }
    
    //fungsi validasi input Saldo Rekening
    function validateSaldoRekening(&$errors, $field_list, $field_name, &$error_con, $jumlah_uang){
        $connection = connect(); //memanggil fungsi connect untuk koneksi ke database

        $sql = "SELECT SALDO FROM rekening WHERE NO_REK = :no_rek"; //query

        $statement = $connection->prepare($sql); //prepare statement
        $statement->bindValue(':no_rek',$field_list[$field_name]);
        $statement->execute();
        
        //kondisi jika saldo rekening tidak mencukupi
        foreach($statement as $row){
            if ($row['SALDO'] <= 50000 || $row['SALDO'] < $jumlah_uang){
                $errors = 'Saldo rekening anda tidak mencukupi';
                $error_con = true;
            }
        }
    }
    
    function validateOldPassword(&$errors, $field_list, $field_name, &$error_con){
        $connection = connect(); //memanggil fungsi connect untuk koneksi ke database
        
        $sql = "SELECT PASSWORD_CUST FROM customer WHERE PASSWORD_CUST = SHA2(:password,0)"; //query

        $statement = $connection->prepare($sql); //prepare statement
        $statement->bindValue(':password',$field_list[$field_name]); //bindValue statement
        $statement->execute();
        
        //kondisi jika password salah
        if (!$statement->rowCount() > 0){
            $errors = 'Kata sandi salah';
            $error_con = true;
        }
        
        //kondisi jika input PIN kosong
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Kata sandi diperlukan';
            $error_con = true;
        }
    }

?>