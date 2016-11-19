<?php
    require 'MySQL_Connect.php';
    session_start();
    $conn = connect_to_database();
    $stmt = "UPDATE Items SET isAvailable = FALSE WHERE ItemID = ? AND SellerID = ?";
    $query = $conn->prepare($stmt);
    $query->bindParam(1, $_POST['itemID']);
    $query->bindParam(2, $_SESSION['user_id']);
    $query->execute();