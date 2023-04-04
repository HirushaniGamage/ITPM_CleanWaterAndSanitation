<?php
//we need to start the sessions 
session_start();


//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');

//include send mail function
include_once('phpmailer/mail.php');

class User extends Main{


// Now lets develop the Authentication Module

public function Authentication($userName,$pwd){
    //first check input data avalability
    if($userName!="" || $pwd!=""){
        //lets connect db and serch record
        $sqlQuery = "SELECT * FROM login_tbl WHERE login_email = '$userName' AND d_status = 0;";

        //database error checking part
        if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
        }

        //now we are going to execute the SQL query
        $sqlResult = $this->dbResult->query($sqlQuery);

        //lets count the number of rows
        $nor =  $sqlResult->num_rows;

        if($nor>0){

            //lets convert user entered password into a hash
            $newPwd = md5($pwd);

            //we need fetch the loginDetails 
            $rec = $sqlResult->fetch_assoc();

            //now lets validate the user pwd
            if($rec['login_pwd'] == $newPwd){
                //we need to check the status 
                if($rec['login_status'] == 1){
                    //lets check the user role
                        $logRole = $rec['login_role'];


                        switch($logRole){
                            case "user":

                            //lets create a cookie
                            setcookie('ucsc13',$rec['login_id'],time()+60*60);

                            //lets create sessions 
                            $_SESSION['user_id'] = $rec['user_id'];
                            $_SESSION['login_email'] = $rec['login_email'];
                              
                            if(!isset($_COOKIE[$location]))
                            {
                              header('location:lib/view/station.php');
                            }
                            else
                            {
                              header($_COOKIE[$location]);
                            }
                      
                            break;

                            case "Admin":
                                //lets create a cookie
                                setcookie('ucsc13',$rec['login_id'],time()+60*60);

                                //lets create sessions 
                                $_SESSION['user_id'] = $rec['user_id'];
                                $_SESSION['login_email'] = $rec['login_email'];

          
                                //lets redirect user
                                header('location:lib/view/admin.php');
                    
                                break;
                                
                                case "OIC(Office in charge)":
                                  //lets create a cookie
                                  setcookie('ucsc13',$rec['login_id'],time()+60*60);
  
                                  //lets create sessions 
                                  $_SESSION['user_id'] = $rec['user_id'];
                                  $_SESSION['login_email'] = $rec['login_email'];
  
            
                                  //lets redirect user
                                  header('location:lib/view/ChiefEngineer.php');
                      
                                  break;
                          
                            }
                }
                else{
                    echo("
                    <script>
                    Swal.fire({
                        icon: 'info',
                        text: 'Your Account has been Deactivated!',
                    })
                  </script>"
                );
                }
            }
            else{
                echo("
                <script>
                Swal.fire({
                    icon: 'error',
                    text: 'Please check your password!',
                })
              </script>"
            );
            }

        }
        else{
            echo("
                <script>
                Swal.fire({
                    icon: 'error',
                    text: 'Please check your User Name!',
                })
              </script>"
            );
        }
        }
        else{
            echo("<script>
            Swal.fire({
              icon: 'warning',
              text: 'Required fields!',
          })
          </script>"
            );
        }  
    }


      //view User Count
      function user_count(){

        
        $sqlSelect = "SELECT * FROM user_tbl WHERE d_status = 0 ORDER BY user_email DESC;";
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

    public function userList(){

        $sqlSelect = "SELECT * FROM user_tbl WHERE d_status = 0 ORDER BY user_id DESC;";
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
                <th >'.$rec['user_id'].'</th>
                <td>'.$rec['user_name'].'</td>
                <td>'.$rec['user_nic'].'</td>
                <td>'.$rec['user_phone'].'</td>
                <td>
                <button type="button" class="btn btn-warning" onclick="editacc(\''.$rec['user_id'].'\')">Edit</button> OR 
                <button type="button" class="btn btn-danger" onclick="deleteuser(\''.$rec['user_id'].'\')">Delete</button>
                </td>
             </tr>
                    ');
          }
        }
        else {echo('
          <div class="alert alert-danger" role="alert">
          No Users Are Found!
        </div>');
        }
    }



 //lets create search product methord
 public function userSearch($searchData){

    //sqlSearchData
    $sqlSelect = "SELECT * FROM user_tbl WHERE (user_id LIKE '$searchData%' OR user_name LIKE '$searchData%' OR user_nic LIKE '$searchData%') AND d_status = 0";
    
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
            <th >'.$rec['user_id'].'</th>
            <td>'.$rec['user_name'].'</td>
            <td>'.$rec['user_nic'].'</td>
            <td>'.$rec['user_phone'].'</td>
            <td>
            <button type="button" class="btn btn-warning" onclick="editacc(\''.$rec['user_id'].'\')">Edit</button> OR 
            <button type="button" class="btn btn-danger" onclick="deleteuser(\''.$rec['user_id'].'\')">Delete</button>
            </td>
         </tr>
                ');
      }
      }
      else {echo('
        <div class="alert alert-danger" role="alert">
        No Users Are Found!
      </div>');
      }
  }

  public function delete_user($uid){
    $update1 = "UPDATE user_tbl SET d_status = 1 WHERE  user_id = '$uid' AND d_status = 0;";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($update1);

  $update2 = "UPDATE address_tbl SET d_status = 1 WHERE  user_id = '$uid' AND d_status = 0;";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($update2);

  $update2 = "UPDATE login_tbl SET d_status = 1 WHERE  user_id = '$uid' AND d_status = 0;";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($update2);
      return("ok"); 
   
   }

  
    // this function use to get user liat to admin page

    public function activate_userList(){

      $sqlSelect = "SELECT * FROM user_tbl WHERE d_status = 0 ORDER BY user_id DESC;";
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

          if($rec['user_status']==1){
            echo('
            <tr>
              <th >'.$rec['user_id'].'</th>
              <td>'.$rec['user_name'].'</td>
              <td>'.$rec['user_nic'].'</td>
              <td>'.$rec['user_phone'].'</td>
              <td><span class="badge bg-success py-2">Account Activated</span></td>
           </tr>
                  ');
          }
          else{
            echo('
            <tr>
              <th >'.$rec['user_id'].'</th>
              <td>'.$rec['user_name'].'</td>
              <td>'.$rec['user_nic'].'</td>
              <td>'.$rec['user_phone'].'</td>
              <td><button type="button" class="btn btn-warning py-1" onclick="activateacc(\''.$rec['user_id'].'\')">Activate </button></td>
           </tr>
                  ');
          }
           
        }
      }
      else {echo('
        <div class="alert alert-danger" role="alert">
        No Users Are Found!
      </div>');
      }
  }



  public function activate_userList_serch($searchData){

    $sqlSelect = "SELECT * FROM user_tbl WHERE (user_id LIKE '$searchData%' OR user_name LIKE '$searchData%' OR user_nic LIKE '$searchData%') AND d_status = 0";
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

        if($rec['user_status']==1){
          echo('
          <tr>
            <th >'.$rec['user_id'].'</th>
            <td>'.$rec['user_name'].'</td>
            <td>'.$rec['user_nic'].'</td>
            <td>'.$rec['user_phone'].'</td>
            <td><span class="badge bg-success py-2">Account Activated</span></td>
         </tr>
                ');
        }
        else{
          echo('
          <tr>
            <th >'.$rec['user_id'].'</th>
            <td>'.$rec['user_name'].'</td>
            <td>'.$rec['user_nic'].'</td>
            <td>'.$rec['user_phone'].'</td>
            <td><button type="button" class="btn btn-warning py-1" onclick="activateacc(\''.$rec['user_id'].'\')">Activate </button></td>
         </tr>
                ');
        }
         
      }
    }
    else {echo('
      <div class="alert alert-danger" role="alert">
      No Users Are Found!
    </div>');
    }
}



}

?>