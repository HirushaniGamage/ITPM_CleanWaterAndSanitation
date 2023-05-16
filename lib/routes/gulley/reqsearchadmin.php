<?php

//include function
include_once('../../function/gulleyFunction.php');

$empObj = new Gulley();

$result = $empObj -> reqSearchA($_GET['searchData']);

echo($result);

?>