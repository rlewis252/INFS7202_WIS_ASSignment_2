
<?php include 'header.php'; ?>
    <body>
<?php
include 'navbar.php';
require 'MySQL_Connect.php';
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    die('Not logged In');
}
$itemsSold = getItemsSelling($_SESSION['user_id']);
$itemsBought = getItemsBought($_SESSION['user_id']);
$userDetails = getUserDetails($_SESSION['user_id']);
?>
        <div class="container">
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addItemModal">Sell New Product</button>
            <h1>Products Being Sold</h1>
            <table class="table table-striped" id="itemsForSale">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Selling Price</th>
                <th>No. of Sales</th>
                <th>Remove Item from Sale</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($itemsSold as $key=>$row) {
                    echo "<tr>";
                    echo "<td>" . $row['NAME'] . "</td>";
                    echo "<td>$" . $row['PRICE'] . "</td>";
                    echo "<td>" . $row['SalesNumber'] . "</td>";
                    echo "<td><button type='button' class='btn btn-danger' value=". $row['ItemID'] . ">Remove From Sale</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
          </table>

            <h1>Products Purchased</h1>
            <table class="table table-striped">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Purchase Price</th>
              </tr>
            </thead>
            <tbody>
               <?php
                foreach($itemsBought as $key=>$row) {
                    echo "<tr>";
                    echo "<td>" . $row['NAME'] . "</td>";
                    echo "<td>$" . $row['PRICE'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
          </table>

            <h1>Account Details</h1>
            <form id="update_form" class="form-horizontal" action="update_details.php" method="POST">
                <div class="form-group">
                  <label class="control-label col-sm-1">FullName:</label>
                  <div class="col-sm-5">
                      <input type="text" name="name" id="name" class="form-control" value='<?php echo $userDetails['NAME']; ?>'>
                  </div>
                </div>
                    <div class="form-group">
                  <label class="control-label col-sm-1">Username:</label>
                  <div class="col-sm-5">
                      <input type="text" name="username" id="email" class="form-control" value='<?php echo $userDetails['USERNAME']; ?>'>
                  </div>
                </div>
                    <div class="form-group">
                  <label class="control-label col-sm-1">Password:</label>
                  <div class="col-sm-5">
                      <input type="password" name="password" id="pwd" class="form-control" placeholder="Enter Password...">
                  </div>
                </div>
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success" style="float: right">Update</button>
                  </div>
                </div>
              </form>
            <p id="error" style="color: red">
                <?php
                    if(isset($_GET['error'])){
                        echo $_GET['error'];
                    }
                ?>
        </p>
        </div> 
        
        <!-- Add Item Modal -->
	<div class="container">
            <div class="modal fade" id="addItemModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Item Details For Sale</h3>
                        </div>
                        <!-- body (form) -->
                        <div class="modal-body">
                            <form role="form" id="addItemForm" action="add_item.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input name="name" id="itemName" type="text" class="form-control" placeholder="Item Name">
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <input name="price" id="itemPrice" type="text" class="form-control" placeholder="Price $10.00">
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <textarea  name="description" id="comment" rows="5" class="form-control" placeholder="Item Description"></textarea>
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <input name="fileToUpload" id="fileToUpload" type="file" class="file" placeholder="Item Image">
                                </div>
                        </div>
                        <!-- Log In Button -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
	</div>
        
        <?php include 'footer.php'; ?>
    </body>
</html>
