
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aqua Guard</title>

    <!--Link Bootstrap css file-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--Link Font awesome css file-->
    <link rel="stylesheet" href="css/all.min.css">
    <!--Link Style sheet css file-->
    <link rel="stylesheet" href="css/style.css">

    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!--Link Font awesome bootstrap and Jquery scrip files-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
    <style>
        #body {
            background: url("lib/upload/ui/login.jpg")no-repeat center fixed;
            background-size: cover;
            height: 100%;
            overflow: hidden;
        }

        #loginback {
            background-color: aqua;
            background-color: rgba(0, 0, 0, .35);
            color: white;
        }
    </style>

</head>

<body id="body">

<idv class="py-0">
    <div class="row py-0">
        <div class="col-7">
        <div class="center" style="margin-top: 10%; text-align: center;">
            <img style="height: auto;  width: 15%; align: center;" src="lib/upload/ui/logo.png" alt="">
            </div>
            <div class="center" style="margin-top: 5%;">
            <h1 style="text-align: center; font-weight: 900; color:black; font-style:bold;" >AQUAGUARD</h1>
            <h4 style="text-align: center; font-weight: 600; color:black">Defend your water, defend your health.</h4>
            </div>
        </div>
        <div class="col-5 px-5" id="loginback" style="height:100vh; margin: auto;">
            <div style="margin-top: 20%;">

                <h1 class="font-weught-bold py-3">Sign in</h1>
                <form action="" method="post">
                    <div class="form-row">
                        <label style="border-radius: 25px;" for="">UserName</label>
                        <input style="border-radius: 25px;" type="email" name="userName" id="userName"
                            class="form-control my-3" placeholder="Email-Address">
                    </div>
                    <div class="form-row">
                        <label for="">Password</label>
                        <input style="border-radius: 25px;" type="password" name="userPwd" id="userPwd"
                            class="form-control my-3" placeholder="******">
                    </div>
                    <div class="form-row py-3">
                        <input type="submit" value="Login" style="border-radius: 25px;" class="btn btn-success"
                            name="btnLogin">
                        <input type="reset" value="Clear" style="border-radius: 25px;" class="btn btn-danger">

                    </div>
                </form>
            </div>
        </div>
    </div>
</idv>
</body>
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
</html>