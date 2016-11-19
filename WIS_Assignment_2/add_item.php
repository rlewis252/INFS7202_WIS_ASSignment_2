<?php
    require 'MySQL_Connect.php';
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    session_start();
    $conn = connect_to_database();
    $stmt;
    $query;
    if($_FILES["fileToUpload"]["name"] != NULL){
        //File
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["tmp_name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check === false) {
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            die("Sorry, there was an error uploading your file.");
        // if everything is ok, try to upload file
        } else {
            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                die("Sorry, there was an error saving your file.");
            }
        }
        $stmt = "INSERT INTO Items (NAME, PRICE, DESCRIPTION, IMAGEURL, SellerID) VALUES (?, ?, ?, ?, ?)";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $name);
        $query->bindParam(2, $price);
        $query->bindParam(3, $description);
        $query->bindParam(4, $target_file);
        $query->bindParam(5, $_SESSION['user_id']);
    }else{
        //No File
        $stmt = "INSERT INTO Items (NAME, PRICE, DESCRIPTION, SellerID) VALUES (?, ?, ?, ?)";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $name);
        $query->bindParam(2, $price);
        $query->bindParam(3, $description);
        $query->bindParam(4, $_SESSION['user_id']);
    }
    $query->execute();
    header('Location: AccountSummary.php');