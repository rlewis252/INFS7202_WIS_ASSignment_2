<?php include 'header.php'; ?>
    <body>
<?php include 'navbar.php';
include 'MySQL_Connect.php';
$topItems = getTopItems();
?>
    <div class="jumbotron">
        <div class="container text-center">
          <h1>Online Store</h1>      
          <form action="SearchResults.php" method="GET">
                <input type="text" name="query" placeholder="Search..." class="search-text-box">
          </form>
        </div>
    </div><br><br>

    <div class="container">
        <div class="row">
            <?php
            $i = 1;
            foreach ($topItems as $key => $value) {
                echo "<div class=\"col-sm-4\">";
                echo  "<div class=\"panel panel-success\">";
                echo  "<div class=\"panel-heading\"><a href=\"ItemView.php?itemID=" . $value['ItemID'] . "\">" . $value['NAME'] . "</a></div>";
                echo  "<div class=\"panel-body\"><a href=\"" . $value['IMAGEURL'] ."\" data-lightbox=\"image\"><img src=\"" . $value['IMAGEURL'] . "\" class=\"img-responsive\" style=\"width:100%\" alt=\"Image\"></a></div>";
                echo  "<div class=\"panel-footer\">\$" . $value['PRICE'] . "</div>";
                echo  "</div>";
                echo  "</div>";
                if($i % 3 == 0){echo "</div><br><div class=\"row\">";}
                $i++;
            }
            ?>
        </div>
    </div><br><br>

<?php include 'footer.php'; ?>
    </body>
</html>