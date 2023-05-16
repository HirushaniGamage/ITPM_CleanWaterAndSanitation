<?php

//include function page 
include_once('../../function/waterFunction.php');

//call the class and create an object 
$serObj = new Water();

$result = $serObj -> editplantdata($_GET['id'],$_GET['un'],$_GET['em']);


echo($result);


?>