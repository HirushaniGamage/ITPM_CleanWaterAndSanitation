<?php

//include function
include_once('../../function/waterFunction.php');

$empObj = new Water();

$result = $empObj -> reqtodoAS($_GET['searchData'], $_GET['plant']);

echo($result);

?>