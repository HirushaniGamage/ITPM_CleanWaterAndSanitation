<?php

//include function page 
include_once('../../function/waterFunction.php');

//call the class and create an object 
$userObj = new Water();

$result = $userObj -> plantList();

echo($result);


?>