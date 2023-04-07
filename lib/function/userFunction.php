<?php
//we need to start the sessions 
session_start();


//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');

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
                            $_SESSION['type'] = "User";

                            if(!isset($_COOKIE[$location]))
                            {
                              header('location:lib/view/user.php');
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
                                $_SESSION['type'] = "Admin";

          
                                //lets redirect user
                                header('location:lib/view/admin.php');
                    
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


    
public function userRegistration($name,$email,$pwd,$phone){

  $sqlQuery = "SELECT * FROM login_tbl WHERE login_email = '$email' AND d_status = 0;";

  //database error checking part
  if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
  }

  //now we are going to execute the SQL query
  $sqlResult0 = $this->dbResult->query($sqlQuery);

  //lets count the number of rows
  $nor =  $sqlResult0->num_rows;

  if($nor>0){
    return("04");
  }
else{
    //generate new id for a User 
    $autoNumber = new AutoNumber;
    $userId = $autoNumber -> NumberGeneration("user_id","user_tbl","USR");

    //create token to activate account
    $token=bin2hex(random_bytes(15));

    //insert data to user table
    $sqlInsert = "INSERT INTO user_tbl VALUES('$userId','$name','$email','$phone',1,0);";

    //lets check the errors 
    if($this->dbResult->error){
        echo($this->dbResult->error);
        exit;
    }

    //we need to execute our sql by query 
    $sqlResult = $this->dbResult->query($sqlInsert);

    //lest check the result is 0 or not 
    if($sqlResult > 0){
        
        //lets create a hash by using MD5
        $newPwd = md5($pwd);

        //insert dataset into the login table 
        $insertLogin = "INSERT INTO login_tbl VALUES('$userId','$email','$newPwd','user',1,0);";

        //lets check the errors 
        if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
        }
        $loginResult = $this->dbResult->query($insertLogin);

         //send account activation email to user
        // $email_send = new Mail();
        // $email_send->Send_mail($email,"Welcome to National Water Supply and Drainage Board energy consumption system","<h3>Hellow $name,</h3><br> <h4>Click this link to Activate your Account, <h4> <br> http://127.0.0.1/system_12/lib/routes/users/activate.php?id=$userId&token=$token <br> Your Plant Login Details are Below <br> User Name - $email <br> Password - $pwd");
        

        if($loginResult > 0){
          return("01");
        }
        else{
            return("02");
        }
    }
    else{
        return("03");
    }
  }
}//end of userRegistration


  }
?>