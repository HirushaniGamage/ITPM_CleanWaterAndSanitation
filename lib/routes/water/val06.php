<?php

//include function page 
include_once('../../function/waterFunction.php');

//call the class and create an object 
$invObj = new Water();

$result = $invObj -> val06($_GET['start'],$_GET['end']);

echo($result);


?>