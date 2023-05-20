<?php

//include function page 
include_once('../../function/InvoiceFunction.php');

//call the class and create an object 
$prdObj = new Invoice();

$result = $prdObj -> getanualplantrecdata($_GET['id'],$_GET['year']);


echo($result);


?>