<?php
    require 'MySQL_Connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(empty($username) || empty($password)){
        show_error();
    }
    session_start();
    $salt = substr($username, 0, 2);
    $encryptedPassword = crypt($password, $salt);
    $conn = connect_to_database();
    $stmt = "SELECT UserID FROM Users WHERE USERNAME = ? AND PASSWORD = ?";
    $query = $conn->prepare($stmt);
    $query->bindParam(1, $username);
    $query->bindParam(2, $encryptedPassword);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($query->rowCount() == 1) {
      $_SESSION['user_id'] = $result['UserID'];
      header("Location: index.php");
    } else {
        show_error();
    }
    
    function show_error(){
        $error = "Invalid username/password.";
        header("Location: login_signup.php?error=$error");
        die();
    }