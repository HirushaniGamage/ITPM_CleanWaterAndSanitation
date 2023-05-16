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
    Aqua Guard-Testing
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
           
        </main>
    </div>
</body>

</html>