<?php
// include function page(userFunction.php)

include_once('../../function/waterFunction.php');

$userObj = new Water();

$result = $userObj->accept($_GET['uid'],$_GET['price']);

echo($result);

?>