<?php

//start session
session_start();

//require admin information
require 'components/prelude.php';

//user selection query
$user_query = 'SELECT Mail FROM Utenti where Mail=?';

//fetch user
$result = $conn->prepare($user_query);
$result->execute([$_POST['Mail']]);
$user = $result->fetch();

//check email presence in db
if ($user) {
    //redirect to signup in case of mail already in use
    $_SESSION['wrong_mail'] = true;
    header('Location: add-admin.php');
} else if ($_POST['Password'] != $_POST['ConfirmPassword']) {
    //if, bypassed javascript, passwords don't match, redirect to add-admin with error
    $_SESSION['wrong_password'] = true;
    header('Location: add-admin.php');
} else {
    //build password
    $salt = generateRandomString(5);
    $psw = hash('sha256', hash('sha256', $_POST['Password']) . $salt);

    //insert query
    $insert_query = 'INSERT INTO Utenti (Nome, Cognome, Mail, Password, Salt, Amministratore) VALUES (?,?,?,?,?,1)';
    $result = $conn->prepare($insert_query);
    $result->execute([$_POST['Nome'], $_POST['Cognome'], $_POST['Mail'], $psw, $salt]);
    $_SESSION['add-admin-success'] = true;
    header('Location: index.php');
}

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>