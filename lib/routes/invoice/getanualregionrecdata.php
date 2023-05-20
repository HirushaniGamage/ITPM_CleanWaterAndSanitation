<?php

//include function page 
include_once('../../function/InvoiceFunction.php');

//call the class and create an object 
$prdObj = new Invoice();

$result = $prdObj -> getanualregionrecdata($_GET['region'],$_GET['year']);


echo($result);


?>