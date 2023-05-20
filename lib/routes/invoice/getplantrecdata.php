<?php

//include function page 
include_once('../../function/InvoiceFunction.php');

//call the class and create an object 
$prdObj = new Invoice();

$result = $prdObj -> getlantrecodedata($_GET['id'],$_GET['month']);


echo($result);


?>