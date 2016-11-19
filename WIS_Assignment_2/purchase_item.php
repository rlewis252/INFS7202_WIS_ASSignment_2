<?php
    require 'MySQL_Connect.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Content-type: application/json');
        $response_array['status'] = 'error';
        echo json_encode($response_array);
        die();
    }
    $conn = connect_to_database();
    $stmt = "CALL purchaseItem(?, ?)";
    $query = $conn->prepare($stmt);
    $query->bindParam(1, $_SESSION['user_id']);
    $query->bindParam(2, $_POST['itemID']);
    $query->execute();