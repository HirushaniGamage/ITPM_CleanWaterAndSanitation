<?php
// include function page(userFunction.php)

include_once('../../function/waterFunction.php');

$userObj = new Water();

$result = $userObj->delete_gulley($_GET['uid']);

echo($result);

?>