<?php

//include function
include_once('../../function/waterFunction.php');

$empObj = new Water();

$result = $empObj -> reqSearchA($_GET['searchData']);

echo($result);

?>