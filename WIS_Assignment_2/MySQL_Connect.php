<?php
    /*Connect to the Database*/
    function connect_to_database(){
        $servername = "us-cdbr-azure-northcentral-b.cloudapp.net";
        $username = "be128b74b6f278";
        $password = "4b7b0887";
        $dbname = "s4425609Tut9";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            die("Connection failed: " . $e->getMessage());
        }
        return $conn;
    }
    
    function getItemsSelling($userID){
        $conn = connect_to_database();
        $stmt = "SELECT ItemID, NAME, PRICE, SalesNumber FROM Items WHERE SellerID = ? AND isAvailable = TRUE";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $userID);
        $query->execute();
        $items = array();
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            $items[] = $result;
        }
        return $items;
    }
    
    function getItemsBought($userID){
        $conn = connect_to_database();
        $stmt = "SELECT I.NAME, I.PRICE FROM Items I, Sales S WHERE S.BuyerID = ? AND S.ItemID = I.ItemID;";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $userID);
        $query->execute();
        $items = array();
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            $items[] = $result;
        }
        return $items;
    }
    
    function getUserDetails($userID){
        $conn = connect_to_database();
        $stmt = "SELECT USERNAME, PASSWORD, NAME FROM USERS WHERE UserID = ?";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $userID);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $details = array("USERNAME"=>$result['USERNAME'], "PASSWORD"=>$result['PASSWORD'], "NAME"=>$result['NAME']);
        return $details;
    }
    
    function getSearchResults($input){
        $input = '%' . $input . '%';
        $conn = connect_to_database();
        $stmt = "SELECT ItemID, NAME, PRICE, IMAGEURL FROM Items WHERE NAME LIKE ? AND isAvailable = TRUE";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $input);
        $query->execute();
        $items = array();
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            $items[] = $result;
        }
        return $items;
    }
    
    function getTopItems(){
        $conn = connect_to_database();
        $stmt = "SELECT ItemID, NAME, IMAGEURL, PRICE FROM Items ORDER BY SalesNumber DESC LIMIT 6";
        $query = $conn->prepare($stmt);
        $query->execute();
        $items = array();
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            $items[] = $result;
        }
        return $items;
    }
    
    function getItemDetails($itemID){
        $conn = connect_to_database();
        $stmt = "SELECT item.ItemID, item.NAME AS ItemName, item.PRICE, " .
                "item.DESCRIPTION, item.IMAGEURL, users.NAME AS UserName " .
                "FROM Items item, Users users WHERE item.ItemID = ? AND item.SellerID = users.UserID";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $itemID);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    function checkUserExists($str){
        $conn = connect_to_database();
        $stmt = "SELECT USERNAME FROM USERS WHERE USERNAME = ?";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $str);
        $query->execute();
        if($query->rowCount() == 0){
            return false;
        } else{
            return true;
        }
    }
    
    function checkUserExistsBesidesCurrent($userID, $str){
        $conn = connect_to_database();
        $stmt = "SELECT USERNAME FROM USERS WHERE USERNAME = ? AND UserID != ?";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $str);
        $query->bindParam(2, $userID);
        $query->execute();
        if($query->rowCount() == 0){
            return false;
        } else{
            return true;
        }
    }