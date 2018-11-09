<?php
    function validateNoRekening(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^[0-9]+$/"; // format mobile number
        $dbc = new PDO('mysql:host=localhost;dbname=banking','root','');

        $sql = "SELECT NO_REK FROM customer_data";

        $statement = $dbc->prepare($sql);
        $statement->execute();
        
        foreach($statement as $row){
            if ($field_list[$field_name] == $row['NO_REK']){
                $errors = 'No Rekening sudah digunakan';
                $error_con = true;
            }
        }
        
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'No Rekening dibutuhkan';
            $error_con = true;
        }
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus berisi angka';
            $error_con = true;
        }
        else if (strlen($field_list[$field_name]) < 16) {
            $errors = 'Harus terdiri dari 16 digit angka';
            $error_con = true;
        }
    }

    function validateNama(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^[a-z A-Z'-]+$/";// format surname (alfabet)
        
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Nama diperlukan';
            $error_con = true;
        }
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus berisi huruf';
            $error_con = true;
        }
    }
    
    function validateJenisKelamin(&$errors, $field_list, $field_name, &$error_con) {
    
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Jenis Kelamin diperlukan';
            $error_con = true;
        }
    }
    
    function validateAlamat(&$errors, $field_list, $field_name, &$error_con) {
    
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Alamat diperlukan';
            $error_con = true;
        }
    }
    function validateSaldo(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^[0-9]+$/"; // format mobile number
        
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Saldo dibutuhkan';
            $error_con = true;
        }
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus berisi angka';
            $error_con = true;
        }
        else if ($field_list[$field_name] < 100000) {
            $errors = 'Minimal saldo sebesar Rp. 100000,-';
            $error_con = true;
        }
    }
    
    function validateNamaPengguna(&$errors, $field_list, $field_name, &$error_con) {
    
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Nama Pengguna diperlukan';
            $error_con = true;
        }
    }
    
    function validatePassword(&$errors, $field_list, $field_name, &$error_con) {
        $pattern = "/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/";// format password
        
        if (!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors = 'Kata Sandi diperlukan';
            $error_con = true;
        }
        else if (!preg_match($pattern, $field_list[$field_name])){
            $errors = 'Harus terdiri dari 8 karakter mengandung huruf(besar & kecil) & angka';
            $error_con = true;
        }
    }
?>