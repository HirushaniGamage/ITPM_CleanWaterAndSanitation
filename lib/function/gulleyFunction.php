<?php
//we need to start the sessions 
session_start();

//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');


class Gulley extends Main{

      //lets create the Add Product Methord

public function makerequest($name, $phone, $user, $address, $date, $remark){

  $sqlSelectch = "SELECT * FROM gulley_tbl WHERE phone = '$phone' AND user_id = '$user' AND 
  address = '$address' AND date = '$date' AND remark = '$remark';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResultch = $this->dbResult->query($sqlSelectch);

$norch = $sqlResultch->num_rows;

if($norch == 0){
   //generate new id for a product
   $autoNumber = new AutoNumber;
   $productId = $autoNumber -> NumberGeneration("id","gulley_tbl","GLY");

   //insert product to databace
 
  $sqlInsert2 = "INSERT INTO gulley_tbl VALUES('$productId','$name','$phone','$user','$address',
  '$date','$remark',0,0,0,0,0,0);";

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
  return("02");
  }
}
}//end of add product

// this function use to get product liat to admin page

public function gulleyList($id){

  $sqlSelect = "SELECT * FROM gulley_tbl WHERE d_status = 0 AND user_id ='$id' ORDER BY id ASC;";
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
      if($rec['admin'] == 0){
        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['price'].'</td>
          <td><span class="badge bg-warning">waiting for approval</span></td>
          <td><button type="button" onclick="editreq(\''.$rec['id'].'\');" class="btn btn-warning">Edit</button> <button type="button" onclick="delete_req(\''.$rec['id'].'\');" class="btn btn-danger">Delete</button></td>
       </tr>
              ');}
       else if($rec['admin'] == 3){
        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['price'].'</td>
          <td><span class="badge bg-warning">waiting for New Date</span></td>
          <td><button type="button" onclick="editreq(\''.$rec['id'].'\');" class="btn btn-warning">Edit</button> <button type="button" onclick="date(\''.$rec['id'].'\');" class="btn btn-info">New Date</button></td>
       </tr>
              ');
      }
      else if($rec['admin'] == 2){
        echo('
        <tr class="table-danger">
          <th >'.$rec['id'].'</th>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['price'].'</td>
          <td><span class="badge bg-danger">Decline</span></td>
          <td> <button type="button" onclick="delete_req(\''.$rec['id'].'\');" class="btn btn-danger">Delete</button></td></td>
       </tr>
              ');
      }
      else if($rec['done'] == 0){
        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['price'].'</td>
          <td><span class="badge bg-info">Waiting for Completion</span></td>
          <td></td>
       </tr>
              ');
      }
      else if($rec['done'] == 1){
        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['price'].'</td>
          <td><span class="badge bg-success">Completed</span></td>
          <td><button type="button" onclick="feedback(\''.$rec['id'].'\');" class="btn btn-info">Add Feedback</button>
          <button type="button" onclick="bill(\''.$rec['id'].'\');" class="btn btn-success">Print bill</button></td>
          </td>
       </tr>
              ');
      }
    }
  }
  else {echo('
    <div class="alert alert-warning" role="alert">
    No requests Are Found!
  </div>');
  }
}




//lets create search employer methord
public function reqSearch($searchData, $id){

//sqlSearchData
$sqlSelect = "SELECT * FROM gulley_tbl WHERE d_status = 0 AND user_id ='$id' AND (name LIKE '$searchData%' OR id  LIKE '$searchData%') ORDER BY id ASC;";

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
    if($rec['admin'] == 0){
      echo('
      <tr>
        <th >'.$rec['id'].'</th>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['price'].'</td>
        <td><span class="badge bg-warning">waiting for approval</span></td>
        <td><button type="button" onclick="editreq(\''.$rec['id'].'\');" class="btn btn-warning">Edit</button> <button type="button" onclick="delete_req(\''.$rec['id'].'\');" class="btn btn-danger">Delete</button></td>
     </tr>
            ');}
     else if($rec['admin'] == 3){
      echo('
      <tr>
        <th >'.$rec['id'].'</th>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['price'].'</td>
        <td><span class="badge bg-warning">waiting for New Date</span></td>
        <td><button type="button" onclick="editreq(\''.$rec['id'].'\');" class="btn btn-warning">Edit</button> <button type="button" onclick="date(\''.$rec['id'].'\');" class="btn btn-info">New Date</button></td>
     </tr>
            ');
    }
    else if($rec['admin'] == 2){
      echo('
      <tr class="table-danger">
        <th >'.$rec['id'].'</th>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['price'].'</td>
        <td><span class="badge bg-danger">Decline</span></td>
        <td> <button type="button" onclick="delete_req(\''.$rec['id'].'\');" class="btn btn-danger">Delete</button></td></td>
     </tr>
            ');
    }
    else if($rec['done'] == 0){
      echo('
      <tr>
        <th >'.$rec['id'].'</th>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['price'].'</td>
        <td><span class="badge bg-info">waiting for date</span></td>
        <td><button type="button" onclick="date(\''.$rec['id'].'\');" class="btn btn-info">New Date</button></td>
     </tr>
            ');
    }
    else if($rec['done'] == 1){
      echo('
      <tr>
        <th >'.$rec['id'].'</th>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['date'].'</td>
        <td>'.$rec['price'].'</td>
        <td><span class="badge bg-success">Compleated</span></td>
        <td><button type="button" onclick="feedback(\''.$rec['id'].'\');" class="btn btn-info">Add Feedback</button>
        <button type="button" onclick="bill(\''.$rec['id'].'\');" class="btn btn-info">Print bill</button></td>
          
     </tr>
            ');
    }
  }
}
else {echo('
  <div class="alert alert-warning" role="alert">
  No requests Are Found!
</div>');
}
}


public function gulleyListA(){

  $sqlSelect = "SELECT * FROM gulley_tbl WHERE d_status = 0 AND (admin =0) ORDER BY gulley_tbl.id ASC;";
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
          <td>'.$rec['remark'].'</td>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['phone'].'</td>
          <td>'.$rec['address'].'</td>
          <td><button type="button" onclick="Accept(\''.$rec['id'].'\');" class="btn btn-success">Accept and price</button>
           <button type="button" onclick="declare(\''.$rec['id'].'\');" class="btn btn-danger">Decline</button>
           <button type="button" onclick="date(\''.$rec['id'].'\');" class="btn btn-warning">Re-date</button></td>
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
$sqlSelect = "SELECT * FROM gulley_tbl WHERE d_status = 0 AND admin =0 AND (name LIKE '$searchData%' OR id  LIKE '$searchData%') ORDER BY id ASC;";

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
        <td>'.$rec['remark'].'</td>
        <td>'.$rec['name'].'</td>
        <td>'.$rec['phone'].'</td>
        <td>'.$rec['address'].'</td>
        <td><button type="button" onclick="Accept(\''.$rec['id'].'\');" class="btn btn-success">Accept and price</button>
         <button type="button" onclick="declare(\''.$rec['id'].'\');" class="btn btn-danger">Decline</button>
         <button type="button" onclick="date(\''.$rec['id'].'\');" class="btn btn-warning">Re-date</button></td>
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


public function todogulleyListA(){

  $sqlSelect = "SELECT * FROM gulley_tbl WHERE d_status = 0 AND (admin =1 AND done !=1) ORDER BY gulley_tbl.id ASC;";
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
      if($rec['done'] = 0){echo('
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
      else  if($rec['done'] = 2){echo('
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
    No Request Are Found!
  </div>');
  }
}

public function feedbacklist(){

  $sqlSelect = "SELECT * FROM gulley_tbl WHERE d_status = 0 AND done =1 AND feedback != '0' ORDER BY gulley_tbl.id ASC;";
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

public function declare($uid){
  $update1 = "UPDATE gulley_tbl SET admin = 2 WHERE  id = '$uid' AND d_status = 0;";
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
  $update1 = "UPDATE gulley_tbl SET feedback = '$rate' WHERE  id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($update1);

    return("ok"); 
 
 }

 public function start($uid){
  $update1 = "UPDATE gulley_tbl SET done = 2 WHERE  id = '$uid' AND d_status = 0;";
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
  $update1 = "UPDATE gulley_tbl SET done = 1 WHERE  id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($update1);

    return("ok"); 
 
 }

 public function date($uid){
  $update1 = "UPDATE gulley_tbl SET admin = 3, date ='' WHERE  id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($update1);

    return("ok"); 
 
 }

 public function date2($uid, $date){
  $update1 = "UPDATE gulley_tbl SET admin = 0, date ='$date' WHERE  id = '$uid' AND d_status = 0;";
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
  $update1 = "UPDATE gulley_tbl SET admin = 1, price = '$price'  WHERE  id = '$uid' AND d_status = 0;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($update1);

    return("ok"); 
 
 }


public function delete_gulley($uid){
  $update1 = "UPDATE gulley_tbl SET d_status = 1 WHERE  id = '$uid' AND d_status = 0;";
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
  $sqlSelect = "SELECT * FROM gulley_tbl WHERE id = '$uid';";
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



function editdata($id,$un,$ph,$add,$da,$rk,$le){

  $update1 = "UPDATE gulley_tbl SET name='$un', phone='$ph', address ='$add',
  gulley_tbl.date ='$da', remark='$rk'  WHERE  id='$id' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($update1);
       return("ok"); 
}

public function val06($start, $end){

  //sqlSearchData
  $sqlSelect = "SELECT * FROM gulley_tbl WHERE d_status = 0 AND done = 1 AND (date BETWEEN '$start' AND '$end') ORDER BY id ASC;";
  
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
        <td>'.$rec['price'].'</td>
     </tr>
            ');
            $total = $total + $rec['price'];
    }
    echo('
    <tr>
      <th colspan="4"></td>
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