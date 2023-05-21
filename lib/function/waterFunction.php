<?php
//we need to start the sessions 
session_start();

//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');


class Water extends Main{


  public function addplant($name, $Capacity){

    //generate new id 
    $autoNumber = new AutoNumber;
    $Id = $autoNumber -> NumberGeneration("id","plant_tbl","PLN");
 
    //insert  to databace
  
   $sqlInsert2 = "INSERT INTO plant_tbl VALUES('$Id','$name','$Capacity',0);";
 
   //lets check the errors 
   if($this->dbResult->error){
       echo($this->dbResult->error);
       exit;
   }
 
   //we need to execute our sql by query 
   $sqlResult1 = $this->dbResult->query($sqlInsert2);
   if($sqlResult1>0){
     return("1");
   }else{
   return("Please Try again later!");
   }
    
 }
 

 public function plantList(){

  $sqlSelect = "SELECT * FROM plant_tbl WHERE d_status = 0 ORDER BY id DESC;";
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

        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['Capacity'].'</td>
          <td>
          <button type="button" class="btn btn-warning" onclick="editacc(\''.$rec['id'].'\')">Edit</button> OR 
          <button type="button" class="btn btn-danger" onclick="deleteuser(\''.$rec['id'].'\')">Delete</button>
          </td>
       </tr>
              ');
    }
  }
  else {echo('
    <div class="alert alert-danger" role="alert">
    No Plants Are Found!
  </div>');
  }
}


 //lets create search product methord
 public function plantSearch($searchData){

  //sqlSearchData
  $sqlSelect = "SELECT * FROM plant_tbl WHERE (id LIKE '$searchData%' OR name LIKE '$searchData%') AND d_status = 0";
  
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
          echo('
          <tr>
            <th >'.$rec['id'].'</th>
            <td>'.$rec['name'].'</td>
            <td>'.$rec['Capacity'].'</td>
            <td>
            <button type="button" class="btn btn-warning" onclick="editacc(\''.$rec['id'].'\')">Edit</button> OR 
            <button type="button" class="btn btn-danger" onclick="deleteuser(\''.$rec['id'].'\')">Delete</button>
            </td>
         </tr>
                ');
      }
    }
    else {echo('
      <div class="alert alert-danger" role="alert">
      No Plants Are Found!
    </div>');
    }
}



public function delete_plant($uid){
  $update1 = "UPDATE plant_tbl SET d_status = 1 WHERE  id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($update1);

    return("ok"); 
 
 }

 function plantdata($uid){
  $sqlSelect = "SELECT * FROM plant_tbl WHERE id = '$uid';";
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


function editplantdata($id,$name,$capacity){

  $update1 = "UPDATE plant_tbl SET name='$name', capacity='$capacity' WHERE  id='$id' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($update1);
       return("ok"); 
}


function getallplantdrop(){


  $sqlSelect = "SELECT * FROM plant_tbl WHERE d_status =0 ORDER BY name DESC;";
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
    echo('<option value="0">Select Plant Location</option>');
    while($rec = $sqlResult->fetch_assoc()){
        echo('<option value="'.$rec['id'].'">'.$rec['name'].'</option>');
    }
  }
  else {
    echo('<option value="0"> No Plants</option>');
  }
}




public function makerequest($name, $phone, $user, $address, $date, $remark, $capacity, $plantid){

  $sqlSelectch = "SELECT * FROM water_tbl WHERE phone = '$phone' AND user_id = '$user' AND 
  address = '$address' AND date = '$date' AND capacity = '$capacity';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResultch = $this->dbResult->query($sqlSelectch);

$norch = $sqlResultch->num_rows;

if($norch == 0){
  $sqlSelect = "SELECT * FROM plant_tbl WHERE id = '$plantid';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

$rec = $sqlResult->fetch_assoc();

$avalablevapacity = $rec['Capacity'];

if ($avalablevapacity < $capacity){
  return("02");
}else{
    
$currentusage = 0.00;

  $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND date ='$date' AND admin = 1 AND price != 0 ORDER BY id ASC;";
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
      $currentusage = $currentusage + $rec['capacity'];
    }
  }
  $balance = $avalablevapacity - $currentusage;
  if($balance < $capacity){
    return("03");
  }else{
    //generate new id for a product
   $autoNumber = new AutoNumber;
   $productId = $autoNumber -> NumberGeneration("id","water_tbl","WTR");

   //insert product to databace
 
  $sqlInsert2 = "INSERT INTO water_tbl VALUES('$productId','$name','$phone','$user','$address','$plantid',
  '$date','$remark','$capacity',0,0,0,0,0,0);";

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
  return("07");
  }
  }
}
}
}//end of add product

// this function use to get product liat to admin page

public function waterList($id){

  $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND user_id ='$id' ORDER BY id ASC;";
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
      $status = "";
      $buttons = "";
      if($rec['admin'] == 0){ 
        $status = '<span class="badge bg-warning">Waiting for approval</span>';
        $buttons = '<button type="button" onclick="editreq(\''.$rec['id'].'\');" class="btn btn-warning">Edit</button> <button type="button" onclick="delete_req(\''.$rec['id'].'\');" class="btn btn-danger">Delete</button>';}
      else if($rec['admin'] == 2){ 
        $status = '<span class="badge bg-warning">Rejected</span>';}
      else if($rec['done'] == 0){ 
        $status = '<span class="badge bg-success">Accepted</span>';}
      else if($rec['done'] == 1){ 
        $status = '<span class="badge bg-success">Completed</span>';
        $buttons = '<button type="button" onclick="feedback(\''.$rec['id'].'\');" class="btn btn-info">Add Feedback</button><button type="button" onclick="bill(\''.$rec['id'].'\');" class="btn btn-info mx-2">Print bill</button></td>';}
      
        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['capacity'].'</td>
          <td>'.$rec['price'].'</td>
          <td>'.$status.'</td>
          <td>'.$buttons.'</td>
       </tr>
              ');
    }
  }
  else {echo('
    <div class="alert alert-warning" role="alert">
    No Request Are Found!
  </div>');
  }
}




//lets create search employer methord
public function reqSearch($searchData, $id){

//sqlSearchData
$sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND user_id ='$id' AND (name LIKE '$searchData%' OR id  LIKE '$searchData%') ORDER BY id ASC;";

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
    $status = "";
    $buttons = "";
    if($rec['admin'] == 0){ 
      $status = '<span class="badge bg-warning">Waiting for approval</span>';
      $buttons = '<button type="button" onclick="editreq(\''.$rec['id'].'\');" class="btn btn-warning">Edit</button> <button type="button" onclick="delete_req(\''.$rec['id'].'\');" class="btn btn-danger">Delete</button>';}
    else if($rec['admin'] == 2){ 
      $status = '<span class="badge bg-warning">Rejected</span>';}
    else if($rec['done'] == 0){ 
      $status = '<span class="badge bg-danger">Accepted</span>';}
    else if($rec['done'] == 1){ 
      $status = '<span class="badge bg-success">Completed</span>';
      $buttons = '<button type="button" onclick="feedback(\''.$rec['id'].'\');" class="btn btn-info">Add Feedback</button><button type="button" onclick="bill(\''.$rec['id'].'\');" class="btn btn-info mx-2">Print bill</button></td>';}
    
      echo('
      <tr>
        <th >'.$rec['id'].'</th>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['capacity'].'</td>
        <td>'.$rec['price'].'</td>
        <td>'.$status.'</td>
        <td>'.$buttons.'</td>
     </tr>
            ');
  }
}
else {echo('
  <div class="alert alert-warning" role="alert">
  No materials Are Found!
</div>');
}
}


public function delete_gulley($uid){
  $update1 = "UPDATE water_tbl SET d_status = 1 WHERE  id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($update1);

    return("ok"); 
 
 }

 function reqsdata($uid){
  $sqlSelect = "SELECT * FROM water_tbl WHERE id = '$uid';";
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



function editdata($id,$un,$ph,$add,$da,$rk,$le,$cp){

  $currentusage = 0.00;

  $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND date ='$da' AND admin = 1 AND price != 0 ORDER BY id ASC;";
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
      $currentusage = $currentusage + $rec['capacity'];
    }
  }
  $balance = $avalablevapacity - $currentusage;
  if($balance < $cp){
    return("03");
  }else{
  $update1 = "UPDATE water_tbl SET name='$un', phone='$ph', address ='$add',
  water_tbl.date ='$da', remark='$rk', capacity='$cp'  WHERE  id='$id' AND d_status = 0;";
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


public function waterListA(){

  $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND (admin =0) ORDER BY water_tbl.id ASC;";
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
      $status = "";
      if($rec['admin'] == 0){ $status = '<span class="badge bg-warning">Waiting for approval</span>';}
      else if($rec['admin'] == 2){ $status = '<span class="badge bg-warning">Re-Date requesting</span>';}
      else if($rec['done'] == 0){ $status = '<span class="badge bg-danger">Waiting for date</span>';}
      else if($rec['done'] == 1){ $status = '<span class="badge bg-success">Completed</span>';}
        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['phone'].'</td>
          <td>'.$rec['address'].'</td>
          <td>'.$rec['capacity'].'</td>
          <td>'.$rec['remark'].'</td>
          <td><button type="button" onclick="Accept(\''.$rec['id'].'\');" class="btn btn-success">Accept and price</button>
           <button type="button" onclick="declare(\''.$rec['id'].'\');" class="btn btn-danger">Declare</button>
           
       </tr>
              ');
    }
  }
  else {echo('
    <div class="alert alert-warning" role="alert">
    No Request Are Found!
  </div>');
  }
}


public function reqSearchA($searchData){

  //sqlSearchData
  $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND admin =0 AND (name LIKE '$searchData%' OR id  LIKE '$searchData%') ORDER BY id ASC;";
  
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
      $status = "";
      if($rec['admin'] == 0){ $status = '<span class="badge bg-warning">Waiting for approval</span>';}
      else if($rec['admin'] == 2){ $status = '<span class="badge bg-warning">Re-Date requesting</span>';}
      else if($rec['done'] == 0){ $status = '<span class="badge bg-danger">Waiting for date</span>';}
      else if($rec['done'] == 1){ $status = '<span class="badge bg-success">Completed</span>';}
        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['phone'].'</td>
          <td>'.$rec['address'].'</td>
          <td>'.$rec['capacity'].'</td>
          <td>'.$rec['remark'].'</td>
          <td><button type="button" onclick="Accept(\''.$rec['id'].'\');" class="btn btn-success">Accept and price</button>
           <button type="button" onclick="declare(\''.$rec['id'].'\');" class="btn btn-danger">Declare</button>
           
       </tr>
              ');
    }
  }
  else {echo('
    <div class="alert alert-warning" role="alert">
    No Requests Are Found!
  </div>');
  }
  }

  public function declare($uid){
    $update1 = "UPDATE water_tbl SET admin = 2 WHERE  id = '$uid' AND d_status = 0;";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($update1);
  
      return("ok"); 
   
   }
  

   
 public function accept($uid, $price){
  $update1 = "UPDATE water_tbl SET admin = 1, price = '$price'  WHERE  id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($update1);

    return("ok"); 
 
 }


 public function reqtodoA($searchData){

  //sqlSearchData
  $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND admin = 1 AND plani_id = '$searchData' ORDER BY id ASC;";
  
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
      if($rec['done'] == 0){echo('
        <tr class="table-warning">
          <th >'.$rec['id'].'</th>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['remark'].'</td>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['phone'].'</td>
          <td>'.$rec['address'].'</td>
          <td><button type="button" onclick="start(\''.$rec['id'].'\');" class="btn btn-success">Start</button></td>
       </tr>
              ');}
      else  if($rec['done'] == 2){echo('
      <tr class="table-danger"> 
        <th >'.$rec['id'].'</th>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['remark'].'</td>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['phone'].'</td>
        <td>'.$rec['address'].'</td>
        <td><button type="button" onclick="end(\''.$rec['id'].'\');" class="btn btn-success">Complete</button></td>
     </tr>
            ');}
    }
  }
  else {echo('
    <div class="alert alert-warning" role="alert">
    No Requests Are Found!
  </div>');
  }
  }


  
 public function reqtodoAS($searchData){

  //sqlSearchData
  $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND admin = 1 AND (name LIKE '$searchData%' OR id  LIKE '$searchData%') ORDER BY id ASC;";
  
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
      if($rec['done'] == 0){echo('
        <tr class="table-warning">
          <th >'.$rec['id'].'</th>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['remark'].'</td>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['phone'].'</td>
          <td>'.$rec['address'].'</td>
          <td><button type="button" onclick="start(\''.$rec['id'].'\');" class="btn btn-success">Start</button></td>
       </tr>
              ');}
      else  if($rec['done'] == 2){echo('
      <tr class="table-danger"> 
        <th >'.$rec['id'].'</th>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['remark'].'</td>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['phone'].'</td>
        <td>'.$rec['address'].'</td>
        <td><button type="button" onclick="end(\''.$rec['id'].'\');" class="btn btn-success">Complete</button></td>
     </tr>
            ');}
    }
  }
  else {echo('
    <div class="alert alert-warning" role="alert">
    No Requests Are Found!
  </div>');
  }
  }

  public function start($uid){
    $update1 = "UPDATE water_tbl SET done = 2 WHERE  id = '$uid' AND d_status = 0;";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($update1);
  
      return("ok"); 
   
   }
  
   public function end($uid){
    $update1 = "UPDATE water_tbl SET done = 1 WHERE  id = '$uid' AND d_status = 0;";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($update1);
  
      return("ok"); 
   
   }

   public function feedback($uid, $rate){
    $update1 = "UPDATE water_tbl SET feedback = '$rate' WHERE  id = '$uid' AND d_status = 0;";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($update1);
  
      return("ok"); 
   
   }

   public function feedbacklist(){

    $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND done =1 AND feedback != '0' ORDER BY water_tbl.id ASC;";
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
      while($rec = $sqlResult->fetch_assoc()){echo('
          <tr>
            <th >'.$rec['id'].'</th>
            <td>'.$rec['date'].'</td>
            <td>'.$rec['name'].'</td>
            <td>'.$rec['phone'].'</td>
            <td>'.$rec['feedback'].'</td>
         </tr>
                ');
      }
    }
    else {echo('
      <div class="alert alert-warning" role="alert">
      No Feedbacks Are Found!
    </div>');
    }
  }
  
//lets create search employer methord
public function val06($start, $end){

  //sqlSearchData
  $sqlSelect = "SELECT * FROM water_tbl WHERE d_status = 0 AND done = 1 AND (date BETWEEN '$start' AND '$end') ORDER BY id ASC;";
  
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
    $total = 0.00;
    while($rec = $sqlResult->fetch_assoc()){
      echo('
      <tr>
        <th >'.$rec['id'].'</th>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['phone'].'</td>
        <td>'.$rec['capacity'].'</td>
        <td>'.$rec['price'].'</td>
     </tr>
            ');
            $total = $total + $rec['price'];
    }
    echo('
    <tr>
      <th colspan="5"></td>
      <td>'.$total.'</td>
   </tr>
          ');
  }
  else {
    echo('
    <div class="alert alert-warning" role="alert">
    No Orders Are Found!
  </div>');
  }
  }

}

?>