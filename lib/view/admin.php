<?php
session_start();

if(empty($_SESSION['login_email'])){
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
  AQUA GAURD
  </title>
  <style>
    
.clock {
    color: #17D4FE;
    font-size: 25px;
    font-family: Orbitron;
    text-align: center;

}
  </style>
</head>

<body onload="myFunction()">
  <!-- start side bar -->
  <div class="page-wrapper chiller-theme toggled">
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="" #style="color:blue">AQUA GAURD</a>
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
            <img src="" alt="">
            <li class="header-menu">
              <span>Manage</span>
            </li>
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
             
           <!--  <li class="header-menu">
              <span>Reports</span>
            </li>
            <li>
              <a href="invoice/monthlyplantreport.php">
              <i class="fas fa-chart-line"></i>
                <span >Monthly Plant Report</span>
              </a>
            </li>
            <li>
              <a href="invoice/monthlyreganreport.php">
              <i class="fas fa-chart-line"></i>
                <span >Monthly region-wise Report</span>
              </a>
            </li>
            <li>
              <a href="invoice/annualplantreport.php">
              <i class="fas fa-chart-line"></i>
                <span >Annual Plant Report</span>
              </a>
            </li>
            <li>
              <a href="invoice/annualreganreport.php">
              <i class="fas fa-chart-line"></i>
                <span >Annual region-wise Report</span>
              </a>
            </li>
            <li>
              <a id="stockplane" href="invoice/timeavaragereport.php">
              <i class="fas fa-chart-line"></i>
                <span >Specific Avarage Energy Consumption(SEC) Report</span>
              </a>
            </li>
            <li>
              <a id="stockplane" href="invoice/chart.php">
              <i class="fas fa-chart-line"></i>
                <span >Annual Energy Consumption(SEC) Chart</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- End sidebar-menu  --> -->
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
            <ul class="navbar-nav me-auto py-3">
            <a class="dropdown-item py-2 px-2" href="../function/logout.php" style="color:red; border-color: red;  text-align: center;
            border-style: solid; border-radius: 25px;
            border-width: 1px;"><i class="fas fa-sign-out-alt"></i>Sign Out</a>
            </ul>
          </div>
        </div>
      </nav>
     
      <div class="row" >
      <input class="form-control mx-1 my-1" type="hidden" value="<?php
                                    //chek the user session
                                  if(empty($_SESSION['user_id'])){}

                                  else{print_r($_SESSION['user_id']);}?>"
          id="input_user_id">
        <div class="col" id="adminloadContent" style=" display: block;    height: 450px; overflow-y: scroll;">
            <img src="../upload/ui/pngwing.com (3).png" width="400px" style="display: block; margin-left: auto; margin-right: auto; margin-top:100px; margin-bottom:20px;" alt=""> 
        </div>
        
      </div>
  </div>
  </main>
  </div>
</body>
    <script>

        function showTime(){
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";
            
            if(h == 0){
                h = 12;
            }
            
            if(h > 12){
                h = h - 12;
                session = "PM";
            }
            
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            
            var time = h + ":" + m + ":" + s + " " + session;
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;
            
            setTimeout(showTime, 1000);
            
        }

        showTime();
    </script>
</html>