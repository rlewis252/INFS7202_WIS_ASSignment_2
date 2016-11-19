<?php include 'header.php'; ?>
    <body>
<?php 
include 'navbar.php';
include 'MySQL_Connect.php';
$items = getSearchResults($_GET['query']);
?>
        <div class="container">
        <div class="row">
            <?php
            $i = 1;
            foreach ($items as $key => $value) {
                echo "<div class=\"col-sm-4\">";
                echo  "<a href=\"ItemView.php?itemID=" . $value['ItemID'] . "\">" . "<div class=\"panel panel-success\">";
                echo  "<div class=\"panel-heading\">" . $value['NAME'] . "</div>";
                echo  "<div class=\"panel-body\"><img src=\"" . $value['IMAGEURL'] . "\" class=\"img-responsive\" style=\"width:100%\" alt=\"Image\"></div>";
                echo  "<div class=\"panel-footer\">\$" . $value['PRICE'] . "</div>";
                echo  "</div></a>";
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
