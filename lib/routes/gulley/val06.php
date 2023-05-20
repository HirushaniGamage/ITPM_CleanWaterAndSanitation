<?php

//include function page 
include_once('../../function/gulleyFunction.php');

//call the class and create an object 
$invObj = new Gulley();

$result = $invObj -> val06($_GET['start'],$_GET['end']);

echo($result);


?>