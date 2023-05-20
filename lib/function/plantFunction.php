<?php
//we need to start the sessions 
session_start();

//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');

//add Image upload model
include_once('img_upload.php');

//include send mail function
include_once('phpmailer/mail.php');

class Plant extends Main{

  function getallplantdrop(){


    $sqlSelect = "SELECT * FROM user_tbl WHERE d_status =0 ORDER BY user_name DESC;";
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
      echo('<option value="0">Select Plant</option>');
      while($rec = $sqlResult->fetch_assoc()){
          echo('<option value="'.$rec['user_id'].'">'.$rec['user_name'].'</option>');
      }
    }
    else {
      echo('<option value="0"> No Products</option>');
    }
  }
  

  function getallplantdropemail(){


    $sqlSelect = "SELECT * FROM user_tbl WHERE d_status =0 ORDER BY user_name DESC;";
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
      echo('<option value="0">Select Plant</option>');
      while($rec = $sqlResult->fetch_assoc()){
          echo('<option value="'.$rec['user_email'].'">'.$rec['user_name'].'</option>');
      }
    }
    else {
      echo('<option value="0"> No Products</option>');
    }
  }
  
  

      //view all Products
      function ViewAlldata($pid){

          //how many items add to one page
          $results_perPage = 8;

          $sqlSelect = "SELECT * FROM sec_tbl WHERE d_status = 0 AND plant_id ='$pid' ORDER BY month AND year; ";
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
            while($rec = $sqlResult->fetch_assoc()){
              echo('<div class="alert alert-dismissible alert-warning" onclick="getdetails(\''.$rec['id'].'\')">
              <div class="row"><div class="col-3"><strong>
              <i class="fab fa-centercode"></i>'.$rec['year'].'-'.$rec['month'].'</strong>
              </div>
              <div class="col-4">
              TC - (LKR)'.$rec['totalcost'].'
              </div>
              <div class="col-5">
              SCE - (kWhm3)'.$rec['specificenergyconsumption'].'
              </div></div>
              </div>');
            }
          }
          else {echo('
            <div class="alert alert-danger" role="alert">
            No Products Are Found!
          </div>');
          }
      }

   
      //view product Count
      function product_count(){

        
        $sqlSelect = "SELECT * FROM product_tbl WHERE d_status = 0 ORDER BY product_Name DESC;";
         //lets check the errors 
          if($this->dbResult->error){
          echo($this->dbResult->error);
          exit;
         }
       //sql execute 
       $sqlResult = $this->dbResult->query($sqlSelect);

        //check the number of rows
        $nor = $sqlResult->num_rows;

        echo($nor);
          
    }


      
      //lets create the Add Product Methord

public function addmcrecode($plant_id,$date,$energyconsumption,$energyconsumptioncost,$maximumdemand,$maximumdemandcost,$totalcost,$monthlyproduction,$specificenergyconsumption){

  $separater = explode('-', $date);
 
  $year  = $separater[0];
  $month = $separater[1];

  $sqlSelect = "SELECT * FROM sec_tbl WHERE (plant_id = '$plant_id' AND year = $year AND month = $month) AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;

 if($nor == 0)
 {
  //generate new id for a product
  $autoNumber = new AutoNumber;
  $productId = $autoNumber -> NumberGeneration("id","sec_tbl","SEC");



  //insert product to databace
 $sqlInsert = "INSERT INTO sec_tbl VALUES('$productId','$plant_id','$year','$month','$energyconsumption','$energyconsumptioncost','$maximumdemand','$maximumdemandcost','$totalcost','$monthlyproduction','$specificenergyconsumption', 0);";

 //lets check the errors 
 if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
 }

 //we need to execute our sql by query 
 $sqlResult = $this->dbResult->query($sqlInsert);

 //lest check the result is 0 or not 
 if($sqlResult > 0){
         return("01");
 }
 else{
     return("02");
 }
 }else{
  return("03");
 }
   
}//end of add product


public function editmcrecode($id,$plant_id,$date,$energyconsumption,$energyconsumptioncost,$maximumdemand,$maximumdemandcost,$totalcost,$monthlyproduction,$specificenergyconsumption){

  $separater = explode('-', $date);
 
  $year  = $separater[0];
  $month = $separater[1];

  $sqlSelect = "SELECT * FROM sec_tbl WHERE (plant_id = '$plant_id' AND year = $year AND month = $month) AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;

 if($nor > 0)
 {

  //insert product to databace
 $sqlInsert = "UPDATE sec_tbl SET energyconsumption= '$energyconsumption' , energyconsumptioncost='$energyconsumptioncost',  maximumdemand='$maximumdemand',  maximumdemandcost='$maximumdemandcost',  totalcost='$totalcost', monthlyproduction='$monthlyproduction', specificenergyconsumption='$specificenergyconsumption' WHERE id = '$id';";

 //lets check the errors 
 if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
 }

 //we need to execute our sql by query 
 $sqlResult = $this->dbResult->query($sqlInsert);

 //lest check the result is 0 or not 
 if($sqlResult > 0){
         return("01");
 }
 else{
     return("02");
 }
 }else{
  return("03");
 }
   
}//end of add product


public function sendEmail($email, $content){
  
    //send password to Employer
    $email_send = new Mail();
    $email_send->Send_mail($email,"Special Massege from head office","$content");

 
 }



public function delete_pro($uid){
  $update1 = "UPDATE product_tbl SET d_status = 1 WHERE  product_Id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($update1);

$update2 = "UPDATE store_tbl SET d_status = 1 WHERE  product_Id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }

//sql execute 
$sqlResult = $this->dbResult->query($update2);
    return("ok"); 
 
 }

 function getlantrecodedata($id){
  $sqlSelect = "SELECT * FROM sec_tbl WHERE id = '$id';";
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



function editdata($id,$name,$details,$cat,$price){

  $update1 = "UPDATE product_tbl SET product_Name='$name', product_Details='$details', product_Category='$cat', product_Price='$price' WHERE  product_Id='$id' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($update1);
       return("ok"); 
}
}



?>