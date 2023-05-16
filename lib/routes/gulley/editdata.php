<?php

//include function page 
include_once('../../function/gulleyFunction.php');

//call the class and create an object 
$serObj = new Gulley();

$result = $serObj -> editdata($_GET['id'],$_GET['un'],$_GET['ph'],$_GET['add'],$_GET['da'],$_GET['rk'],$_GET['ui']);


echo($result);


?>