<?php

//include function page 
include_once('../../function/InvoiceFunction.php');

//call the class and create an object 
$prdObj = new Invoice();

$result = $prdObj -> getdata($_GET['year'],$_GET['id']);

echo($result);


?>