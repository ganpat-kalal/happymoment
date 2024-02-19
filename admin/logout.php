<?php
require_once '../connection.php';
$obj = new model();


$wh['admin_login_id'] = $_SESSION['admin'];
$set['last_login'] = $_SESSION['logintime'];

$obj->my_update("tbl_admin_login", $set, $wh);
        
unset($_SESSION['admin']);
unset($_SESSION['logintime']);

header('location:index.php');

?>