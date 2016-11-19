<?php include 'header.php'; ?>
    <body>
<?php
if(!isset($_GET['itemID']) || empty($_GET['itemID'])){
    header("Location: index.php");
    die();
}
include 'navbar.php';
include 'MySQL_Connect.php';
$itemDetails = getItemDetails($_GET['itemID']);
?>
    <div class="container">
            <div class="row row-centered">
                <div class="col-xs-6 col-centered">
                    <ul style="list-style-type: none">
                        <li><h1><?php echo $itemDetails['ItemName']; ?></h1></li>
                        <li>Cost: $<?php echo $itemDetails['PRICE']; ?></li>
                        <li>Item Description:</li>
                        <li><textarea readonly rows="6" cols="40"><?php echo $itemDetails['DESCRIPTION']; ?></textarea></li>
                        <li>Seller Username: <?php echo $itemDetails['UserName']; ?></li>
                        <li><button id="purchaseButton" class="btn btn-success" value=<?php echo $itemDetails['ItemID']; ?>>Purchase</button></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-centered">
                    <img <?php echo "src=" . $itemDetails['IMAGEURL']; ?> alt="image title" style="margin-top: 20%">
                </div>
            </div>    
     </div>
<?php include 'footer.php'; ?>
    </body>
</html>
