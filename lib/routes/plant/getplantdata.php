<?php

//include function page 
include_once('../../function/waterFunction.php');

//call the class and create an object 
$serObj = new Water();

$result = $serObj -> plantdata($_GET['uid']);


echo($result);


?>