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
  return("Please Try again later!");
  }
   
}

// this function use to getlist 

public function gulleyList($id){

  $sqlSelect = "SELECT * FROM gulley_tbl WHERE d_status = 0 ORDER BY id ASC;";
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
      if($rec['admin'] == 0){ $status = '<span class="badge bg-warning">Warning for approval</span>';}
      else if($rec['admin'] == 2){ $status = '<span class="badge bg-warning">Re-Date requesting</span>';}
      else if($rec['done'] == 0){ $status = '<span class="badge bg-danger">Waiting for date</span>';}
      else if($rec['done'] == 1){ $status = '<span class="badge bg-success">Completed</span>';}
        echo('
        <tr>
          <th >'.$rec['id'].'</th>
          <td>'.$rec['name'].'</td>
          <td>'.$rec['date'].'</td>
          <td>'.$rec['price'].'</td>
          <td>'.$status.'</td>
          <td><button type="button" onclick="edit(\''.$rec['id'].'\');" class="btn btn-warning">Edit</button> <button type="button" onclick="delete_pro(\''.$rec['id'].'\');" class="btn btn-danger">Delete</button></td>
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


}

?>