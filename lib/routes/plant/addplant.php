<?php

//include function page 
include_once('../../function/waterFunction.php');

$prdObj = new Water();

$result = $prdObj -> addplant($_POST['name'],$_POST['Capacity']);


echo($result);


?>