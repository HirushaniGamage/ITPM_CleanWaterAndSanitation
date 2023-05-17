<?php

//include function
include_once('../../function/waterFunction.php');

$empObj = new Water();

$result = $empObj -> reqtodoA($_GET['plant']);

echo($result);

?>