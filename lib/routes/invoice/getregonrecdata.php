<?php

//include function page 
include_once('../../function/InvoiceFunction.php');

//call the class and create an object 
$prdObj = new Invoice();

$result = $prdObj -> getregionrecodedata($_GET['region'],$_GET['month']);


echo($result);


?>