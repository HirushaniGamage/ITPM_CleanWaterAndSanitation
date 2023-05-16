<?php

//include function page 
include_once('../../function/gulleyFunction.php');

//call the class and create an object 
$serObj = new Gulley();

$result = $serObj -> reqsdata($_GET['uid']);


echo($result);


?>