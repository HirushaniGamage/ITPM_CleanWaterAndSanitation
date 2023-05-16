<?php
// include function page(userFunction.php)

include_once('../../function/gulleyFunction.php');

$userObj = new Gulley();

$result = $userObj->feedback($_GET['id'], $_GET['rate']);

echo($result);

?>