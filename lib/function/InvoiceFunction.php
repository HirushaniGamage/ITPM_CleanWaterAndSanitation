<?php
//we need to start the sessions 
session_start();

//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');


class Invoice extends Main{


 function getlantrecodedata($id, $month){

  $separater = explode('-', $month);
 
  $year  = $separater[0];
  $month = $separater[1];

  $sqlSelect = "SELECT * FROM sec_tbl JOIN user_tbl ON sec_tbl.plant_id = user_tbl.user_id WHERE plant_id = '$id' AND sec_tbl.year = '$year' AND sec_tbl.month = '$month';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;
 if($nor > 0){
 $rec = $sqlResult->fetch_assoc();

 return json_encode($rec);
 }
}


function getregionrecodedata($region, $month){

  $separater = explode('-', $month);
 
  $year  = $separater[0];
  $month1 = $separater[1];

  $sqlSelect = "SELECT * FROM sec_tbl JOIN user_tbl ON sec_tbl.plant_id = user_tbl.user_id WHERE user_tbl.region = '$region' AND sec_tbl.year = '$year' AND sec_tbl.month = '$month1';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;
 if($nor > 0){
  $count=0;
  $names="";
  $rec1 = [];
  $tec = 0;
  $tecc = 0;
  $md = 0;
  $mdc = 0;
  $tc= 0;
  $mp=0;
  $sec=0;
  while($rec = $sqlResult -> fetch_assoc()){
    $count++;
    $names= $names.", " . $rec['user_name'];
    $tec= $tec +$rec['energyconsumption'];
    $tecc= $tecc +$rec['energyconsumptioncost'];
    $md= $md +$rec['maximumdemand'];
    $mdc= $mdc +$rec['maximumdemandcost'];
    $tc= $tc +$rec['totalcost'];
    $mp= $mp +$rec['monthlyproduction'];
    $sec= $tecc / $mp;
  }
  $rec1["user_id"] = $count;
  $rec1["user_name"] = $names;
  $rec1["month"] = $month;
  $rec1["energyconsumption"] = $tec;
  $rec1["energyconsumptioncost"] = $tecc;
  $rec1["maximumdemand"] = $md;
  $rec1["maximumdemandcost"] = $mdc;
  $rec1["totalcost"] = $tc;
  $rec1["monthlyproduction"] = $mp;
  $rec1["specificenergyconsumption"] = $sec;
 return json_encode($rec1);
 }
}


function gettimesecreport($start, $end){

  $separater = explode('-', $start);
 
  $year1  = $separater[0];
  $month1 = $separater[1];

  $separater1 = explode('-', $end);
 
  $year2  = $separater1[0];
  $month2 = $separater1[1];

  $sqlSelect = "SELECT * FROM sec_tbl JOIN user_tbl ON sec_tbl.plant_id = user_tbl.user_id WHERE(sec_tbl.year BETWEEN '$year1' AND '$year2') AND (sec_tbl.month BETWEEN '$month1' AND '$month2') ;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;
 if($nor > 0){
  $count=0;
  $names="";
  $rec1 = [];
  $tec = 0;
  $tecc = 0;
  $md = 0;
  $mdc = 0;
  $tc= 0;
  $mp=0;
  $sec=0;
  while($rec = $sqlResult -> fetch_assoc()){
    $count++;
    $names= $names.", " . $rec['user_name'];
    $tec= $tec +$rec['energyconsumption'];
    $tecc= $tecc +$rec['energyconsumptioncost'];
    $md= $md +$rec['maximumdemand'];
    $mdc= $mdc +$rec['maximumdemandcost'];
    $tc= $tc +$rec['totalcost'];
    $mp= $mp +$rec['monthlyproduction'];
    $sec= $sec + $rec['specificenergyconsumption'];
  }
  $rec1["date"] = $end;
  $rec1["user_id"] = $count;
  $rec1["user_name"] = $start;
  $rec1["energyconsumption"] = $tec;
  $rec1["energyconsumptioncost"] = $tecc;
  $rec1["maximumdemand"] = $md;
  $rec1["maximumdemandcost"] = $mdc;
  $rec1["totalcost"] = $tc;
  $rec1["monthlyproduction"] = $mp;
  $rec1["specificenergyconsumption"] = round($tecc / $mp);
  $rec1["a1"] = round($tec/$count);
  $rec1["a2"] = round($tecc/$count);
  $rec1["a3"] = round($md/$count);
  $rec1["a4"] = round($mdc/$count);
  $rec1["a5"] = round($tc/$count);
  $rec1["a6"] = round($mp/$count);
  $rec1["a7"] = round($sec/$count);
 return json_encode($rec1);
 }
}


function getanualplantrecdata($id, $year){

  $sqlSelect = "SELECT * FROM sec_tbl JOIN user_tbl ON sec_tbl.plant_id = user_tbl.user_id WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$id' ORDER BY sec_tbl.month;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;
 if($nor > 0){
  $count=0;
  $names="";
  $rec1 = [];
  $tec = 0;
  $tecc = 0;
  $md = 0;
  $mdc = 0;
  $tc= 0;
  $mp=0;
  $sec=0;
  while($rec = $sqlResult -> fetch_assoc()){
    $count++;
    $names= $names.", " . $rec['user_name'];
    $tec= $tec +$rec['energyconsumption'];
    $tecc= $tecc +$rec['energyconsumptioncost'];
    $md= $md +$rec['maximumdemand'];
    $mdc= $mdc +$rec['maximumdemandcost'];
    $tc= $tc +$rec['totalcost'];
    $mp= $mp +$rec['monthlyproduction'];
    $sec= $tecc / $mp;
    $monthNum  = $rec['month'];
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');
    echo('<tr>
    <th>'.$monthName.'</th>
    <th>'.$rec['energyconsumption'].'</th>
    <th>'.$rec['energyconsumptioncost'].'</th>
    <th>'.$rec['maximumdemand'].'</th>
    <th>'.$rec['maximumdemandcost'].'</th>
    <th>'.$rec['totalcost'].'</th>
    <th>'.$rec['monthlyproduction'].'</th>
    <th>'.$rec['specificenergyconsumption'].'</th>
</tr>');
  }
  echo('<tr>
    <th>Total</th>
    <th>'.$tec.'</th>
    <th>'.$tecc.'</th>
    <th>'.$md.'</th>
    <th>'.$mdc.'</th>
    <th>'.$tc.'</th>
    <th>'.$mp.'</th>
    <th>'.round($sec,2).'</th>
</tr>');
  
 }
}

function getanualregionrecdata($region, $year){

  $sqlSelect = "SELECT * FROM sec_tbl JOIN user_tbl ON sec_tbl.plant_id = user_tbl.user_id WHERE  sec_tbl.year = '$year' AND user_tbl.region = '$region' ORDER BY sec_tbl.month;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;
 if($nor > 0){
  $count=0;
  $rec1 = [];
  $tec = 0;
  $tecc = 0;
  $md = 0;
  $mdc = 0;
  $tc= 0;
  $mp=0;
  $sec=0;
  while($rec = $sqlResult -> fetch_assoc()){
    $count++;
    $tec= $tec +$rec['energyconsumption'];
    $tecc= $tecc +$rec['energyconsumptioncost'];
    $md= $md +$rec['maximumdemand'];
    $mdc= $mdc +$rec['maximumdemandcost'];
    $tc= $tc +$rec['totalcost'];
    $mp= $mp +$rec['monthlyproduction'];
    $sec= $tecc / $mp;
  }
  $rec1["user_id"] = $count;
  $rec1["user_name"] = $region;
  $rec1["month"] = $year;
  $rec1["energyconsumption"] = $tec;
  $rec1["energyconsumptioncost"] = $tecc;
  $rec1["maximumdemand"] = $md;
  $rec1["maximumdemandcost"] = $mdc;
  $rec1["totalcost"] = $tc;
  $rec1["monthlyproduction"] = $mp;
  $rec1["specificenergyconsumption"] = round($sec,2);
 return json_encode($rec1);
 }
}


// this function genarate bar chart for reort
function getdata($year,$plant){
      
     
  $sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 1;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $A=$tot;
}
else{
 $A=0;
}
$sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 2;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $B=$tot;
}
else{
 $B=0;
}
$sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 3;"; //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $C=$tot;
}
else{
 $C=0;
}
$sqlSelect = "SELECT * FROM sec_tbl  WHERE sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 4;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $D=$tot;
}
else{
 $D=0;
}
$sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 5;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $E=$tot;
}
else{
 $E=0;
}
$sqlSelect = "SELECT * FROM sec_tbl  WHERE sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 6;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $F=$tot;
}
else{
 $F=0;
}
$sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 7;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $G=$tot;
}
else{
 $G=0;
}
$sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 8;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $H=$tot;
}
else{
 $H=0;
}
$sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 9;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $I=$tot;
}
else{
 $I=0;
}
$sqlSelect = "SELECT * FROM sec_tbl  WHERE sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 10;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $J=$tot;
}
else{
 $J=0;
}
$sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 11;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $K=$tot;
}
else{
 $K=0;
}
$sqlSelect = "SELECT * FROM sec_tbl WHERE  sec_tbl.year = '$year' AND sec_tbl.plant_id = '$plant' AND sec_tbl.month = 12;";
   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;}
     
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
   $tot=0;
    //check the number of rows
    $nor = $sqlResult->num_rows;  
     if($nor > 0){
    while($rec =  $sqlResult -> fetch_assoc()){
        $tot=$tot+$rec['specificenergyconsumption'];
    } 
  $L=$tot;
}
else{
 $L=0;
}
// echo($A);

//generate new id for a employer 
$autoNumber = new AutoNumber;
$rid = $autoNumber -> NumberGeneration("rt_Id","mt_tbl","MTR");


$sqlInsert = "INSERT INTO mt_tbl VALUES('$rid','$A','$B','$C','$D','$E','$F','$G','$H','$I','$J','$K','$L');";

//lets check the errors 
if($this->dbResult->error){
  echo($this->dbResult->error);
  exit;
}

//we need to execute our sql by query 
$sqlResult = $this->dbResult->query($sqlInsert);
if($sqlResult > 0){
$sqlSelect = "SELECT * FROM mt_tbl WHERE  rt_Id = '$rid';";
//lets check the errors 
if($this->dbResult->error){
echo($this->dbResult->error);
exit;
}
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

//check the number of rows
$nor = $sqlResult->num_rows;
if($nor > 0){
$rec = $sqlResult->fetch_assoc();

return json_encode($rec);
//  }

}

}
}
}
?>