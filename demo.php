<?php
require_once './connection.php';
$obj = new model();

$str ="hello";
echo $ecpt =$obj->encrypt($str);
echo "<br/><br/>";

echo $obj->decrypt($ecpt);
?>

<!--if($ans==1)
{
$user = $obj->my_select("tbl_registration",NULL,array("registration_id"=>$_post['email']))->fetch_object();
                                                                        
$_SESSION['user'] = $user->registration_id;
$_SESSION['logintime'] = date('y-m-d h:i:s');

header('location:index.php');                                                                        
}
}
else
{
    $error = "email already registered!";
}-->