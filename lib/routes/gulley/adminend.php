<?php
// include function page(userFunction.php)

include_once('../../function/gulleyFunction.php');

$userObj = new Gulley();

$result = $userObj->end($_GET['uid']);

echo($result);

?>