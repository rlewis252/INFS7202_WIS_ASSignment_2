<?php

include 'MySQL_Connect.php';

if(checkUserExists($_POST['username'])){
    echo "true";
}else{
    echo "false";
}