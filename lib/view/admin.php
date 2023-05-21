<?php
session_start();

if(empty($_SESSION['login_email'])){
//redirect user backto login
header('location:../../index.php');

}
if(($_SESSION['type'])!= "Admin"){
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
        Aqua Guard-Admin
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
                            <a href="#" id="allwaterrewuest">
                                <i class="fas fa-retweet"></i>
                                <span>All Water Request</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="allwaterrequesttodo">
                                <i class="fas fa-hand-holding-water"></i>
                                <span>All Water Jobs</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="waterfeedbacks">
                                <i class="fas fa-comment"></i>
                                <span>All Water Feedbacks</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="waterreport">
                            <i class="fas fa-chart-line"></i>
                                <span>Water supplying Report</span>
                            </a>
                        </li>
                        <hr style="color:white;">
                        <li>
                            <a href="#" id="allgulleyrewuest">
                                <i class="fas fa-retweet"></i>
                                <span>All Gulley Request</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="todojobcards">
                                <i class="fas fa-recycle"></i>
                                <span>All Gulley Jobs</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="allrequestrate">
                                <i class="fas fa-comment"></i>
                                <span>All Gulley Feedbacks</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="gulleyreporrt2">
                            <i class="fas fa-chart-line"></i>
                                <span>Gulley supplying Report</span>
                            </a>
                        </li>
                        <hr style="color:white;">
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-layer-group"></i>
                                <span>Plant Location</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a id="add_Plant">Add Plant Location</a>
                                    </li>
                                    <li>
                                        <a id="edit_Plant">Edit Plant Location</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>
                        <hr style="color:white;">
                        <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-user-md"></i>
                <span>Employer</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a id="add_employer">Add Employer</a>
                  </li>
                  <li>
                    <a id="edit_employer">Edit Employer</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-layer-group"></i>
                <span>Plant</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a id="add_Customer">Add Plant</a>
                  </li>
                  <li>
                    <a id="edit_Customer">Edit Plants</a>
                  </li>
                  <li>
                    <a id="activate_Customer">Activate Plant Account</a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a id="edit_plantdata">
              <i class="fas fa-wrench"></i>
                <span>Plant Data</span>
              </a>
            </li>
            <li>
                    </ul>
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
            <div class="container" id="adminloadContent" style="background-color:#C1D7E8;">
                <img src="../upload/ui/AQUA GUARD.png"
                    style="width:50%; display: block; margin-left: auto; margin-right: auto; margin-top:10px; margin-bottom:20px;"
                    alt="">
               

    
                   
            </div>
        </main>
    </div>
</body>
<script>
    $('#waterreport').click(function () {
        window.open("invoice/waterprint2.php"," Aqua Guard", "width=600, height=600");
    });

    $('#gulleyreporrt2').click(function () {
        window.open("invoice/gulleyprint2.php"," Aqua Guard", "width=600, height=600");
    });

    $('#allgulleyrewuest').click(function () {
        $('#adminloadContent').load('gulley/allrequest.php');
    });

    $('#allwaterrewuest').click(function () {
        $('#adminloadContent').load('water/allrequest.php');
    });

    $('#allwaterrequesttodo').click(function () {
        $('#adminloadContent').load('water/allrequesttodo.php');
    });

    $('#waterfeedbacks').click(function () {
        $('#adminloadContent').load('water/allrequestrate.php');
    });

    $('#todojobcards').click(function () {
        $('#adminloadContent').load('gulley/allrequesttodo.php');
    });

    $('#allrequestrate').click(function () {
        $('#adminloadContent').load('gulley/allrequestrate.php');
    });

    $('#add_Plant').click(function(){
        $('#adminloadContent').load('plant/addplant.php');
    });

    $('#edit_Plant').click(function(){
      $('#adminloadContent').load('plant/edit_plant.php');
    });
</script>

</html>
