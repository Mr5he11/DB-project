<?php

//start session
session_start();

//require connection configuration php file
require('../connect.php');

//create connection object
$conn = Connection::getConnection();

//user selection query
$user_query = 'SELECT Mail,Salt FROM Utenti where Mail=?';

//fetch user and build password
$result = $conn->prepare($user_query);
$result->execute([$_POST['Mail']]);
$user = $result->fetch();

//check email presence in db
if($user){

    //fetch salt
    $salt = $user['Salt'];

    //build password
    $psw = hash('sha256', hash('sha256', $_POST['Password']).$salt);

    //login query
    $login_query = 'SELECT * FROM Utenti WHERE Mail=? AND Password=?';
    $login = $conn->prepare($login_query);
    $login->execute([$_POST['Mail'], $psw]);

    //check login credentials
    if($login->fetch()){
        $_SESSION['user'] = $user['Mail'];
        header('Location: index.php');   
    }
}

//redirect to login in case of wrong mail or password
$_SESSION['wrong_login'] = TRUE;
header('Location: login.php');

?>