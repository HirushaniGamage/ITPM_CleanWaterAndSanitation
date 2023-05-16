<?php

//include function
include_once('../../function/waterFunction.php');

$empObj = new Water();

$result = $empObj -> reqSearch($_GET['searchData'], $_GET['id']);

echo($result);

?>