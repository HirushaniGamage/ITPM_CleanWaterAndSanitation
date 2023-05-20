<?php

//include function page 
include_once('../../function/plantFunction.php');

//call the class and create an object 
$prdObj = new Plant();

$result = $prdObj -> editmcrecode($_POST['id'],$_POST['plant_id'],$_POST['date'],$_POST['energyconsumption'],$_POST['energyconsumptioncost'],$_POST['maximumdemand'],$_POST['maximumdemandcost'],$_POST['totalcost'],$_POST['monthlyproduction'],$_POST['specificenergyconsumption']);


echo($result);


?>