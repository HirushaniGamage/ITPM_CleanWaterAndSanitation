<?php
// include function page(userFunction.php)

include_once('../../function/gulleyFunction.php');

$userObj = new Gulley();

$result = $userObj->date($_GET['uid']);

echo($result);

?>