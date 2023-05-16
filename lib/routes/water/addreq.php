<?php

//include function page 
include_once('../../function/waterFunction.php');

$prdObj = new Water();

$result = $prdObj -> makerequest($_POST['name'],$_POST['phone'],$_POST['cby'],
$_POST['address'],$_POST['date'],$_POST['remark'],$_POST['capacity'],$_POST['plants']);


echo($result);


?>