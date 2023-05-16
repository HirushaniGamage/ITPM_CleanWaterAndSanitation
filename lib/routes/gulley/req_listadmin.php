<?php

//include function page 
include_once('../../function/gulleyFunction.php');

//call the class and create an object 
$userObj = new Gulley();

$result = $userObj -> gulleyListA();

echo($result);


?>