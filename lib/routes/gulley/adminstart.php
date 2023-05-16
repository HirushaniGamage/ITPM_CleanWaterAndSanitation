<?php
// include function page(userFunction.php)

include_once('../../function/gulleyFunction.php');

$userObj = new Gulley();

$result = $userObj->start($_GET['uid']);

echo($result);

?>