<?php
// include function page(userFunction.php)

include_once('../../function/waterFunction.php');

$userObj = new Water();

$result = $userObj->feedback($_GET['id'], $_GET['rate']);

echo($result);

?>