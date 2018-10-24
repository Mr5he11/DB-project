<?php

//start session
session_start();

//require admin information
//call prelude file (db connection, etc)
require("prelude.php");


//check for old password
if(hash('sha256', hash('sha256', $_POST['OldPassword']).$user_salt) == $user_psw){
    if(!empty($_POST['Nome'])){
        $name_query = 'UPDATE Utenti SET Nome=? WHERE Mail=?';
        $result_name = $conn->prepare($name_query);
        $result_name->execute([$_POST['Nome'],$user_mail]);
    }
    if(!empty($_POST['Cognome'])){
        $surname_query = 'UPDATE Utenti SET Cognome=? WHERE mail=?';
        $result_surname = $conn->prepare($surname_query);
        $result_surname->execute([$_POST['Cognome'],$user_mail]);
    }
    if(!empty($_POST['Mail'])){
        $mail_query = 'UPDATE Utenti SET Mail=? WHERE Mail=?';
        $result_mail = $conn->prepare($mail_query);
        $result_mail->execute([$_POST['Mail'],$user_mail]);
    }
    if(!empty($_POST['Password'])){
        if($_POST['Password'] == $_POST['ConfirmPassword']){
            $salt = generateRandomString(5);
            $password = hash('sha256',hash('sha256',$_POST['Password']).$salt);
            $password_query = 'UPDATE Utenti SET Password=?, Salt=? WHERE Mail=?';
            $result_password = $conn->prepare($password_query);
            $result_password->execute([$password,$salt,$user_mail]);
        }else{
            $_SESSION['wrong_password_2'] = TRUE;
            header('Location: update-profile.php');
        }
    }
    $_SESSION['update-profile-success'] = TRUE;
    header('Location: index.php');
}else{
    $_SESSION['wrong_password'] = TRUE;
    header('Location: update-profile.php');
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>