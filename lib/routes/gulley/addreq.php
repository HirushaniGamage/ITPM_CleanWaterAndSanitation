<?php

//include function page 
include_once('../../function/gulleyFunction.php');

$prdObj = new Gulley();

$result = $prdObj -> makerequest($_POST['name'],$_POST['phone'],$_POST['cby'],
$_POST['address'],$_POST['date'],$_POST['remark']);


echo($result);


?>