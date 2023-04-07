<?php
session_start();

if(empty($_SESSION['login_email'])){
//redirect user backto login
header('location:../../index.php');

}
if(($_SESSION['type'])!= "User"){
    //redirect user backto login
    header('location:../../index.php');
    
    }
//link app/php file
include_once('../layout/app.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
    Aqua Guard-Gulley Service
    </title>
</head>

<body>
    <!-- start side bar -->
    <div class="page-wrapper chiller-theme toggled">
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href=""> <span style="color:white; font-size:19px;">Aqua Guard</span></a>
                    <div id="close-sidebar">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                </div>
                <div class="sidebar-header" id="show_current_user">
                </div>
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                        </li>
                        <li>
                            <a href="User.php">
                            <i class="fas fa-ellipsis-h"></i>
                                <span>Main Menu</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="makereq">
                            <i class="fas fa-handshake"></i>
                                <span>Make Request</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="reqlist">
                            <i class="fas fa-stream"></i>
                                <span>All Request</span>
                            </a>
                        </li>
                        <hr>
                    </ul>
                </div>
                <!-- End sidebar-menu  -->
            </div>
        </nav>
        <!-- rop Nav bar -->
        <main class="page-content pt-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav me-auto">
                            <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                                <i class="fas fa-bars"></i>
                            </a>
                        </ul>
                    </div>
                    <div class="col-2" id="navbarColor02">
                        <ul class="navbar-nav me-auto py-2">
                            <a class="dropdown-item py-2 px-2" href="../function/logout.php" style="color:red; border-color: red;  text-align: center;
                            border-style: solid; border-radius: 25px;
                            border-width: 1px;"><i class="fas fa-sign-out-alt"></i>Sign Out</a>
                        </ul>
                    </div>
                </div>
            </nav>
            <input class="form-control mx-1 my-1" type="hidden" value="<?php
                                                        //chek the user session
                                                    if(empty($_SESSION['user_id'])){}
                                                    else{print_r($_SESSION['user_id']);}?>" id="userid" name="cby">
           <div class="container" id="adminloadContent">
            <img src="../upload/ui/Hydratation-amico.png"  style="width:30%; display: block; margin-left: auto; margin-right: auto; margin-top:100px; margin-bottom:20px;" alt="">
           </div>
        </main>
    </div>
</body>
<script>
    $('#makereq').click(function(){
        $('#adminloadContent').load('gulley/addrequest.php');
    });

    $('#reqlist').click(function(){
        $('#adminloadContent').load('gulley/requestlist.php');
    });
</script>
</html>