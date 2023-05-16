<?php
// include function page(userFunction.php)

include_once('../../function/gulleyFunction.php');

$userObj = new Gulley();

$result = $userObj->date2($_GET['uid'], $_GET['date']);

echo($result);

?>