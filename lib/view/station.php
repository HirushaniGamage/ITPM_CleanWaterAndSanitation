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
        National Water Supply and Drainage Board
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
                    <a href="#" #style="color:blue">National Water Supply and Drainage Board</a>
                    <div id="close-sidebar">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                </div>
                <img src="../upload/ui/pngwing.com (2).png" style="width:90%; text-align:center;" alt="">
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                        </li>
                        <li class="header-menu">
                            <span>
                                <h5>Plant Details</h5>
                                <div class="row">
                                    <h6>Plant Name </h6>
                                    <h6 style="color: Aqua;" id="plantname">Plant 01</h6>
                                    <h6>Plant Capacity </h6>
                                    <h6 style="color: Aqua;" id="capacity">5000W</h6>
                                    <h6>Electricity Bill Number </h6>
                                    <h6 style="color: Aqua;" id="billno">112233445566</h6>
                                </div>
                            </span>

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
            <!-- content top 4 cardsS -->
            <div class="container-fluid">
                <div class="row">

                    <div class="col" id="adminloadContent">
                        <div class="row">
                            <div class="col-6" style=" display: block;    height: 90vh; overflow-y: scroll;">
                                <div class="card border-success mb-3" style="max-width: 100%;">
                                    <div class="card-header">
                                        <h5>Submit Monthly Enargy Data</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="adddataForm" enctype="multipart/form-data">
                                            <input class="form-control mx-1 my-1" type="hidden" value="<?php
                                                        //chek the user session
                                                    if(empty($_SESSION['user_id'])){}
                                                    else{print_r($_SESSION['user_id']);}?>" id="plant_id" name="plant_id">
                                             <input class="form-control mx-1 my-1" type="hidden" value="" id="id" name="id">
                                            <div class="form-group mt-3">
                                                <label>Selected Month </label>
                                                <div class="col-6">
                                                    <input type="month" class="form-control" id="date" name="date">
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Energy Consumption (kWh)</label>
                                                <input type="number" name="energyconsumption" onchange="cal()"
                                                    id="energyconsumption" class="form-control"
                                                    placeholder="kilo watt hours (kWh)">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Energy Consumption Cost (LKR)</label>
                                                <div class="col-6">
                                                    <input type="number" required value="0" onchange="cal()"
                                                        class="form-control" id="energyconsumptioncost"
                                                        name="energyconsumptioncost">
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Maximum Demand (kVa)</label>
                                                <input type="number" name="maximumdemand" onchange="cal()"
                                                    id="maximumdemand" class="form-control"
                                                    placeholder="Kilo-volt-amperes (kVa)">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Maximum Demand Cost (LKR)</label>
                                                <div class="col-6">
                                                    <input type="number" onchange="cal()" required value="0"
                                                        class="form-control" id="maximumdemandcost"
                                                        name="maximumdemandcost">
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Total Cost (LKR)</label>
                                                <div class="col-6">
                                                    <input type="number" required value="0" class="form-control"
                                                        id="totalcost" name="totalcost">
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Monthly Production (m3)</label>
                                                <div class="col">
                                                    <input type="number" onchange="cal()" class="form-control"
                                                        id="monthlyproduction" name="monthlyproduction"
                                                        placeholder="Cubic meter (m3)">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group mt-3">
                                                <label>Specific Energy Consumption (SEC)</label>
                                                <div class="col">
                                                    <input type="number" class="form-control"
                                                        id="specificenergyconsumption" name="specificenergyconsumption"
                                                        placeholder="kilo watt hours perCubic meter (kWhm3)">
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <button id="btnAdddata" onclick=' return false;' class="btn btn-success">Submit Data</button>
                                                <button id="btnEditata" onclick=' return false;' class="btn btn-success">Edit Data</button>
                                                <button id="new" onclick=' return false;' class="btn btn-success">New</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6" style=" display: block;    height: 100%; overflow-y: scroll;">
                                <div class="card border-warning mb-3" style="max-width: 100%;">
                                    <div class="card-header">
                                        <h5>previous records</h5>
                                    </div>
                                    <div class="card-body" id="container">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
<script>
    $(document).ready(function () {

        $("#btnEditata").hide();
        $("#new").hide();

        $.get("../routes/users/getuserdata.php", {
                uid: $("#plant_id").val()
            },
            function (res) {
                var jdata = jQuery.parseJSON(res);
                $("#plantname").text(jdata.user_name);
                $("#capacity").text(jdata.user_phone);
                $("#billno").text(jdata.user_nic);
            });

        $.get("../routes/plant/getalldata.php", {
                uid: $("#plant_id").val()
            },
            function (res) {
                $("#container").html(res);
            });

    });

    $(document).on('click', '#new', function (e) {
        e.preventDefault();
        $("#btnAdddata").show();
        $("#btnEditata").hide();
        $("#new").hide();
        $("#date").val("");
                        $("#id").val("");
                        $("#energyconsumption").val("");
                        $("#energyconsumptioncost").val("");
                        $("#maximumdemand").val("");
                        $("#maximumdemandcost").val("");
                        $("#totalcost").val("");
                        $("#monthlyproduction").val("");
                        $("#specificenergyconsumption").val("");
    });


    showTime();

    $(document).on('click', '#btnAdddata', function (e) {
        e.preventDefault();
       if($("#date").val()=="" || $("#date").val()=="" || $("#energyconsumption").val()=="" || $("#energyconsumptioncost").val()=="" || $("#maximumdemand").val()=="" || $("#monthlyproduction").val()=="" ||$("#specificenergyconsumption").val()=="" )
       {
        Swal.fire(
            'required field?',
            'please fill all input fields',
            'question'
            );
       }
       else{
        $.ajax({
            url: "../routes/plant/addmrecods.php",
            type: "post",
            data: $("#adddataForm").serialize(),
            success: function (res) {
                if(res== '03'){
                    Swal.fire(
                    'Already submitted!',
                    'This Month Data was Already Added',
                    'error'
                    )
                }else if(res == '02'){
                    Swal.fire(
                    'Something went wrong!',
                    'please try again later',
                    'error'
                    )
                } else if(res == '01'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        $("#id").val("");
                        $("#energyconsumption").val("");
                        $("#energyconsumptioncost").val("");
                        $("#maximumdemand").val("");
                        $("#maximumdemandcost").val("");
                        $("#totalcost").val("");
                        $("#monthlyproduction").val("");
                        $("#specificenergyconsumption").val("");
                }

                $.get("../routes/plant/getalldata.php", {
                uid: $("#plant_id").val()
            },
            function (res) {
                $("#container").html(res);
            });

            },
            error: function (data) {
                alert(data);
            }

        });
    }
    });

    $(document).on('click', '#btnEditata', function (e) {
        e.preventDefault();
       if($("#date").val()=="" || $("#date").val()=="" || $("#energyconsumption").val()=="" || $("#energyconsumptioncost").val()=="" || $("#maximumdemand").val()=="" || $("#monthlyproduction").val()=="" ||$("#specificenergyconsumption").val()=="" )
       {
        Swal.fire(
            'required field?',
            'please fill all input fields',
            'question'
            );
       }
       else{
        $.ajax({
            url: "../routes/plant/editmrecods.php",
            type: "post",
            data: $("#adddataForm").serialize(),
            success: function (res) {
                if(res== '03'){
                    Swal.fire(
                    'Error!',
                    'You used edit methord to add New Data',
                    'error'
                    )
                }else if(res == '02'){
                    Swal.fire(
                    'Something went wrong!',
                    'please try again later',
                    'error'
                    )
                } else if(res == '01'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your Edit has been saved',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        
                        $("#date").val("");
                        $("#id").val("");
                        $("#energyconsumption").val("");
                        $("#energyconsumptioncost").val("");
                        $("#maximumdemand").val("");
                        $("#maximumdemandcost").val("");
                        $("#totalcost").val("");
                        $("#monthlyproduction").val("");
                        $("#specificenergyconsumption").val("");

                        $("#btnAdddata").show();
                        
                        $("#btnEditata").hide();

                        $.get("../routes/plant/getalldata.php", {
                            uid: $("#plant_id").val()
                            },
                            function (res) {
                                $("#container").html(res);
                            });
                }
            },
            error: function (data) {
                alert(data);
            }

        });
    }
    });

    function getdetails($id){
        $.get("../routes/plant/getplantrecdata.php", {
                id: $id
            }, function (res) {
                var jdata = jQuery.parseJSON(res);
                $year= jdata.year;
                $month= jdata.month.padStart(2, '0');
                $date=$year+'-'+$month;              
                $("#date").val($date);
                $("#id").val(jdata.id);
                $("#energyconsumption").val(jdata.energyconsumption);
                $("#energyconsumptioncost").val(jdata.energyconsumptioncost);
                $("#maximumdemand").val(jdata.maximumdemand);
                $("#maximumdemandcost").val(jdata.maximumdemandcost);
                $("#totalcost").val(jdata.totalcost);
                $("#monthlyproduction").val(jdata.monthlyproduction);
                $("#specificenergyconsumption").val(jdata.specificenergyconsumption);
            })
            $("#btnAdddata").hide();
            $("#btnEditata").show();
            $("#new").show();
    }

    function cal() {
        $mec = 0;
        $mecc = 0;
        $md = 0;
        $mdc = 0;
        $tc = 0;
        $mp = 0;
        $sec = 0;
        if ($("#energyconsumption").val() == "" || $("#energyconsumption").val() == 0) {
            $mec = 0;
        } else {
            $mec = $("#energyconsumption").val();
        }
        if ($("#energyconsumptioncost").val() == "" || $("#energyconsumptioncost").val() == 0) {
            $mecc = 0;
        } else {
            $mecc = $("#energyconsumptioncost").val();
        }
        if ($("#maximumdemand").val() == "" || $("#maximumdemand").val() == 0) {
            $md = 0;
        } else {
            $md = $("#maximumdemand").val();
        }
        if ($("#maximumdemandcost").val() == "" || $("#maximumdemandcost").val() == 0) {
            $mdc = 0;
        } else {
            $mdc = $("#maximumdemandcost").val();
        }
        if ($("#monthlyproduction").val() == "" || $("#monthlyproduction").val() == 0) {
            $mp = 0;
        } else {
            $mp = $("#monthlyproduction").val();
        }

        $tc = parseInt($mecc) + parseInt($mdc);
        $sec =(parseInt($mec) / parseInt($mp)).toFixed(3);
        // $("#totalcost").val($tc);
        if ($mec == 0 || $mp == 0) {
            $("#specificenergyconsumption").val("0");
        } else {
            $("#specificenergyconsumption").val($sec);
        }
    }

    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if (h == 0) {
            h = 12;
        }

        if (h > 12) {
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

</script>

</html>