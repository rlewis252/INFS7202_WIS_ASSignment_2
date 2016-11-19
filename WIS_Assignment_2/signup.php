<?php
    require 'MySQL_Connect.php';
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $name = htmlspecialchars($_POST['name']);
    if(empty($username) || empty($password) || empty($name)){
        $error = "All fields must be filled";
        header("Location: login_signup.php?error=$error");
        die();
    }
    if(checkUserExists($_POST['username'])){
        $error = "Username is already taken";
        header("Location: login_signup.php?error=$error");
        die();
    }
    session_start();
    $salt = substr($username, 0, 2);
    $encryptedPassword = crypt($password, $salt);
    $conn = connect_to_database();
    $stmt = "INSERT INTO Users (USERNAME, PASSWORD, NAME) VALUES (?, ?, ?)";
    $query = $conn->prepare($stmt);
    $query->bindParam(1, $username);
    $query->bindParam(2, $encryptedPassword);
    $query->bindParam(3, $name);
    $query->execute();
    $_SESSION['user_id'] = $conn->lastInsertId();
    header("Location: index.php");