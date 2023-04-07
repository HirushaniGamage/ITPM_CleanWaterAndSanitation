<?php
//we need to start the sessions 
session_start();

//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');


class Gulley extends Main{

      //lets create the Add request function

public function makerequest($name, $phone, $user, $address, $date, $remark){

   //generate new id for a product
   $autoNumber = new AutoNumber;
   $productId = $autoNumber -> NumberGeneration("id","gulley_tbl","GLY");

   //insert product to databace
 
  $sqlInsert2 = "INSERT INTO gulley_tbl VALUES('$productId','$name','$phone','$user','$address',
  '$date','$remark',0,0,0,0,0);";

  //lets check the errors 
  if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
  }

  //we need to execute our sql by query 
  $sqlResult1 = $this->dbResult->query($sqlInsert2);
  if($sqlResult1>0){
    return("01");
  }else{
  return("Please Try again later!");
  }
   
}


}



?>