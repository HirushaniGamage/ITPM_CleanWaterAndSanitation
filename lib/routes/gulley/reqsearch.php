<?php

//include function
include_once('../../function/gulleyFunction.php');

$empObj = new Gulley();

$result = $empObj -> reqSearch($_GET['searchData'], $_GET['id']);

echo($result);

?>