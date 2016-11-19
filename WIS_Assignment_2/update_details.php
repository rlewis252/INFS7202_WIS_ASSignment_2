<?php
    require 'MySQL_Connect.php';
    session_start();
    $username = htmlspecialchars($_POST['username']);
    $name = htmlspecialchars($_POST['name']);
    $password = htmlspecialchars($_POST['password']);
    if(checkUserExistsBesidesCurrent($_SESSION['user_id'], $_POST['username'])){
        $error = "Username is already taken";
        header("Location: AccountSummary.php?error=$error");
        die();
    }
    $salt = substr($username, 0, 2);
    $encryptedPassword = crypt($password, $salt);
    $conn = connect_to_database();
    $stmt = "UPDATE Users SET USERNAME = ?, PASSWORD = ?, NAME = ? WHERE UserID = ?";
    $query = $conn->prepare($stmt);
    $query->bindParam(1, $username);
    $query->bindParam(2, $encryptedPassword);
    $query->bindParam(3, $name);
    $query->bindParam(4, $_SESSION['user_id']);
    $query->execute();
    header('Location: AccountSummary.php');