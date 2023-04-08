<?php

//include function page 
include_once('../../function/waterFunction.php');

//call the class and create an object 
$serObj = new Water();

$result = $serObj -> editdata($_GET['id'],$_GET['un'],$_GET['ph'],$_GET['add'],$_GET['da'],$_GET['rk'],$_GET['ui'],$_GET['cp']);


echo($result);


?>