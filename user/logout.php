<?php
require_once '../connection.php';
$obj = new model();


$wh['registration_id'] = $_SESSION['user'];
$set['last_login'] = $_SESSION['lastlogin'];

$obj->my_update("tbl_registration", $set, $wh);
$obj->my_delete("tbl_cart", $wh);     

unset($_SESSION['user']);
unset($_SESSION['lastlogin']);

header('location:../index.php');

?>