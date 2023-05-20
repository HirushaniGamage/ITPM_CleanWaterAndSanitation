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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
<div class="no-print">
        <div class="col-7 border my-2 mx-2">
        <div class="form-group row">
        <div class="col-3 py-3 px-4">
                    <label>Select Plant and year</label>
                </div>
                <div class="col-3 py-3">
                <select class="form-select" name="plants" id="plants">
                    
                </select>
                </div>
                <div class="col-3 py-3">
                <select class="form-select" name="year" id="year">
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                </select>
                </div>
                <div class="col-2 px-3 py-3">
                    <button type="button" class="btn btn-success" id="genarate">Genarate</button>
                </div>
            </div>
        </div>
</div>
<div class="container" style="background-color:white;  color: black;">
    <div class="row pt-3">
        <br>
        <img src="../../upload/invoice/head.png" alt="">
    </div>
    <hr style="height: 6px; text-color: black;">
    <h2 class="py-3" style="text-align:center">Annual Energy Consumption(SEC) Chart</h2>
    <div class="row"><div class="col-3"><h6>Invoice Id:</h6></div><div class="col-3"><h6 id="invid"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Invoice Type:</h6></div><div class="col-3"><h6>Annual Report</h6></div></div>
    <div class="row"><div class="col-3"><h6>Printed Date:</h6></div><div class="col-3"><h6 id="printdate"></h6></div></div>
   
     
    <div calss="px-5 py-5">
    <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
    </div>

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

    $.get("../../routes/plant/getallplantsdrop.php", {
        }, function (res1) {
            $("#plants").html(res1);

        })

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
        
       

        $('#genarate').click(function (e) {
            $year = $("#year").val();
            $plant = $("#plants").val();
        //get data from database
        $.get("../../routes/invoice/getdata.php", {
            year: $year,
                id: $plant
            }, function (res) {
        //display data 
        var jdata = jQuery.parseJSON(res);

        $id=Math.floor((Math.random() * 100) + 1);
    //make id
        $('#id').text("INV00"+$id);
//get date
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
//set date
        $('#date').text(date);

// data for chart
        var xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "Septemberl", "October", "November", "December"];
        // var yValues = [555800, 492000, 447600, 347600, 453000, 692000, 755800, 847600, 347600, 457600,557600,547600,];
        
        var yValues = [];
        var barColors = ["blue", "brown","brown","red","brown","green", "green","green","red","brown","blue","blue"];

        yValues.push(jdata.A);
        yValues.push(jdata.B);
        yValues.push(jdata.C);
        yValues.push(jdata.D);
        yValues.push(jdata.E);
        yValues.push(jdata.F);
        yValues.push(jdata.G);
        yValues.push(jdata.H);
        yValues.push(jdata.I);
        yValues.push(jdata.J);
        yValues.push(jdata.K);
        yValues.push(jdata.L);
        // chart script
       
        // alert(yValues);
        new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "Anul Income Chart 2021"
            }
        }
        });
     

        

        });

      
    })
    })

</script> 