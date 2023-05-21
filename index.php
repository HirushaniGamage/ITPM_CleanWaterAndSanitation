
<!DOCTYPE html>
<html>
<head>
	<title>Aqua Guard-Sign In & Sign Up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style1.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/registerPage.js"></script>
 </head>
<body>
<?php

include_once('lib/function/userFunction.php');
//start the session
// session_start();

if(isset($_POST['btnLogin'])){

$userObj = new User();

$result = $userObj -> Authentication($_POST['userName'],$_POST['userPwd']);
 
echo($result);

}

?>
  <div class="cont">
    <div class="form sign-in">
      <h2>Sign In</h2>
      <form action="" method ="POST">
      <label>
        <span>Email</span>
        <input type="text" name="userName" id="userName">
      </label>
      <label>
        <span>Password</span>
        <input type="password" name="userPwd" id="userPwd">
      </label>
      <button class="submit" type="submit" value="login" name="btnLogin">Sign In</button>
    </form>

  
    <div class="social-media">
        <ul>
          <li><img src="lib/upload/ui/facebook.png"></li>
          <li><img src="lib/upload/ui/instagram.png"></li>
          <li><img src="lib/upload/ui/whatsapp.png"></li>
          <li><img src="lib/upload/ui/twitter.png"></li>
        </ul>
      </div>
    </div>

    <div class="sub-cont">
      <div class="img">
        <div class="img-text m-up">
          <img src="lib/upload/ui/pngwing.com (1).png" style="width:80%;" alt="">
          <h2 class="my-5">New here?</h2>
          <p>Defend your water, defend your health.</p>
        </div>
        <div class="img-text m-in">
        <img src="lib/upload/ui/Screenshot 2023-02-23 at 10.05.09 PM.png" style="width:80%;" alt="">
          <h2>One of us?</h2>
          <p>Are you one of us? Sign in and
join the community. We've missed you!</p>
        </div>
        <div class="img-btn">
          <span class="m-up">Sign Up</span>
          <span class="m-in">Sign In</span>
        </div>
      </div>
      <div class="form sign-up">
        <h2>Sign Up</h2>
        <form id="registrationForm">
        <label>
          <span>Name</span>
          <input type="text" name="userName" id="userName1">
        </label>
        <label>
          <span>Email</span>
          <input type="email" name="userEmail" id="userEmail">
        </label>
        <label>
          <span>Password</span>
          <input type="password" name="userPwd" id="userPwd1">
        </label>
        <label>
          <span>Re-Type Password</span>
          <input type="password" name="reuserPwd" id="reuserPwd">
        </label>
        <label>
          <span>Contact Number</span>
          <input type="number" name="userPhone" id="userPhone">
        </label>
        <button class="submit" name="btn_save" id="btnSave" onclick="return false" >Sign Up Now</button>
      </form>
      </div>
    </div>
  </div>
  </body>

  <script>
     document.querySelector('.img-btn').addEventListener('click', function()
	{
		document.querySelector('.cont').classList.toggle('s-signup')
	}
);


  </script>
  </html>
