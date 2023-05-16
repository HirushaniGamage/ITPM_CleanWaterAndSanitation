<?php

//include function page 
include_once('../../function/waterFunction.php');

//call the class and create an object 
$prdObj = new Water();

$result = $prdObj -> getallplantdrop();


echo($result);


?>