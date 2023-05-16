<?php
// include function page(userFunction.php)

include_once('../../function/gulleyFunction.php');

$userObj = new Gulley();

$result = $userObj->accept($_GET['uid'],$_GET['price']);

echo($result);

?>