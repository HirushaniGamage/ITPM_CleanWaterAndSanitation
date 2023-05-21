<?php
//star the session
session_start();
//chek its logd in?
if(empty($_SESSION['user_id'])){
  header('location:login.php');
}
  
else{}

?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <!-- Link css and script file -->
    <link rel="stylesheet" href="../../../css/bootstrap.2min.css">
    <!--Link Bootstrap css file-->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!--Link Font awesome css file-->
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/all.min.css">
    <script src="../../../js/all.min.js"></script>
    <script src="../../../js/jquery.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
    @media print {
        .no-print,
        .no-print,
        #gradient,
        #steps-uid-0-p-3 * {
            display: none !important;
        }
        #date,
        #date * {
            display: none !important;
        }
        #sidenav,
        #sidenav * {
            display: none !important;
        }
    }
    table, th, td {
  border: 1px solid;
}
</style>
</head>

</html>
<div class="container">
<div class="no-print">
        <div class="col-7 border my-2">
        <div class="form-group row">
                <div class="col-3 py-3 px-4">
                    <label>Select Plant and Month</label>
                </div>
                <div class="col-3 py-3">
                <select class="form-select" name="plants" id="plants">
                   
                </select>
                </div>
                <div class="col-3 py-3">
                <input type="month" class="form-control" id="date" name="date">
                </div>
                <div class="col-2 px-3 py-3">
                    <button type="button" class="btn btn-success" id="genarate">Genarate</button>
                </div>
            </div>
        </div>
</div>
</div>
<div class="container" style="background-color:white;  color: black;">
    <div class="row pt-3" style="text-align: center;">
        <br>
        <img src="../../upload/invoice/head.png" style="width:100%;">
    </div>
    <hr style="height: 6px; text-color: black;">
    <h2 class="py-3" style="text-align:center">Plant Monthly Report</h2>
    <div class="row"><div class="col-3"><h6>Invoice Id:</h6></div><div class="col-3"><h6 id="invid"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Invoice Type:</h6></div><div class="col-3"><h6>Monthly Report</h6></div></div>
    <div class="row"><div class="col-3"><h6>Printed Date:</h6></div><div class="col-3"><h6 id="printdate"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Plant ID:</h6></div><div class="col-3"><h6 id="plantid"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Plant Name:</h6></div><div class="col-3"><h6 id="plantname"></h6></div></div>
    <div class="row"><div class="col-3"><h6>E-Bill Number:</h6></div><div class="col-3"><h6 id="billno"></h6></div></div>
    <div class="row"><div class="col-3"><h6>E-Bill Category:</h6></div><div class="col-3"><h6 id="cat"></h6></div></div>

     

    <table class="center mt-5" style="text-align:center; width:80%; border: 1px solid;margin-left: auto; margin-right: auto;">
        <tr>
            <th>Description</th>
            <th>Value</th>
        </tr>
        <tbody>
        <tr>
            <td style="text-align:left;">Plant ID</td>
            <td id="011"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Plant Name</td>
            <td id="01"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Selected Month</td>
            <td id="02"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Energy Consumption (kWh)</td>
            <td id="03"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Energy Consumption Cost (LKR)</td>
            <td id="04"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Maximum Demand (LKR)</td>
            <td id="05"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Maximum Demand Cost (LKR)</td>
            <td id="06"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Total Cost (LKR)</td>
            <td id="07"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Monthly Production (m3)</td>
            <td id="08"></td>
        </tr>
        <tr>
            <td style="text-align:left;">Specific Energy Consumption (SEC)</td>
            <td id="09"></td>
        </tr>
        </tbody>
    </table>
    <br><br><br><br>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <h6>...................................................</h6>
            <h6> Signature</h6>
            <br><br><br>
        </div>
    </div>
</div>
<div class="no-print">
<button type="button" class="btn btn-secondary my-3 mx-5 px-5" onclick="history.back()"><i class="fas fa-arrow-left"></i>   Back</button>
<button type="button" class="btn btn-success my-3 px-5" onclick="window.print();"><i class="fas fa-print"></i>   Print</button>
</div>
<script>

$(document).ready(function() {
        const date = new Date();

        let day = date.getDate();
        let month = date.getMonth()+1;
        let year = date.getFullYear();

        // This arrangement can be altered based on how we want the date's format to appear.
        let currentDate = `${day}-${month}-${year}`;

        //genarete invoive number
        let x = Math.floor((Math.random() * 100) + 1);
        let y = 'INV'+ x;
        $("#invid").text(y);
        $("#printdate").text(currentDate);
        $.get("../../routes/plant/getallplantsdrop.php", {
        }, function (res1) {
            $("#plants").html(res1);

        })

})

$(document).on('click', '#genarate', function (e) {
        e.preventDefault();

        $plant = $("#plants").val();
        $month = $("#date").val();
       if($plant =="" || $month =="")
       {
        Swal.fire(
            'Input Data?',
            'Please Select Plant and Month?',
            'question'
            )
       }
       else
       {
        $.get("../../routes/users/getuserdata.php", {
                uid:  $plant
            },
            function (res) {
                var jdata = jQuery.parseJSON(res);
                $("#plantname").text(jdata.user_name);
                $("#plantid").text(jdata.user_id);
                $("#billno").text(jdata.user_nic);
                $("#cat").text(jdata.ElectracityCat);
            });
        getdetails($plant, $month);
    }
    });

function getdetails($id,$month){
        $.get("../../routes/invoice/getplantrecdata.php", {
                id: $id,
                month: $month
            }, function (res) {
                var jdata = jQuery.parseJSON(res);
                $year= jdata.year;
                $month= jdata.month.padStart(2, '0');
                $date=$year+'-'+$month;              
                $("#02").text($date);
                $("#011").text(jdata.user_id);
                $("#01").text(jdata.user_name);
                $("#03").text(jdata.energyconsumption);
                $("#04").text(jdata.energyconsumptioncost);
                $("#05").text(jdata.maximumdemand);
                $("#06").text(jdata.maximumdemandcost);
                $("#07").text(jdata.totalcost);
                $("#08").text(jdata.monthlyproduction);
                $("#09").text(jdata.specificenergyconsumption);
            })
    }

</script> 