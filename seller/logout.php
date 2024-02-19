<?php
require_once '../connection.php';
$obj = new model();


$wh['seller_id'] = $_SESSION['seller'];
$set['last_login'] = $_SESSION['lastlogin'];

$obj->my_update("tbl_seller", $set, $wh);
        
unset($_SESSION['seller']);
unset($_SESSION['lastlogin']);

header('location:../index.php');

?>