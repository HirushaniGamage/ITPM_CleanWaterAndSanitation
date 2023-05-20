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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="../../../js/all.min.js"></script>
    <script src="../../../js/jquery.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
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
        <div class="col-12 border my-2">
        <div class="form-group row">
                <div class="col-4 py-3 px-4">
                    <label>Enter start and end date</label>
                </div>
                <div class="col-4 py-3">
                <input class="form-control" type="text" name="daterange" />
                </div>
                <div class="col-2 px-4 py-2">
                    <button type="button" class="btn btn-success" id="genarate">Genarate</button>
                </div>
            </div>
        </div>
</div>
<div class="container">
<div class="container" style="background-color:white;  color: black;">
    <div class="row pt-3">
        <br>
        <img src="../../upload/ui/head.jpg" alt="">
    </div>
    <hr style="height: 6px; text-color: black;">
    <h2 class="py-3" style="text-align:center">All Order Report</h2>
   
    <div class="row"><div class="col-3"><h6>Printing Date:</h6></div><div class="col-3"><h6 id="date"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Start Date:</h6></div><div class="col-3"><h6 id="date1"></h6></div></div>
    <div class="row"><div class="col-3"><h6>End Date:</h6></div><div class="col-3"><h6 id="date2"></h6></div></div>
    
     
    
    <table class="center mt-5" style="text-align:center; width:80%; border: 1px solid;margin-left: auto; margin-right: auto;">
        <tr>
            <th>Order ID</th>
            <td>Date</td>
            <td>Name</td>
            <td>Phone</td>
            <td>Capacity</td>
            <td>Price</td>
        </tr>
       
        <tbody id="allorders">
       
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
<button type="button" class="btn btn-success my-3 px-5" onclick="window.print();"><i class="fas fa-print"></i>   Print</button>
</div>

<script>

$(document).ready(function() {

let start_date = '';
let end_date = '';

$(function() {
    $('input[name="daterange"]').daterangepicker({
        opens: 'left'
    }, function(start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        start_date = start.format('YYYY-MM-DD');
        end_date = end.format('YYYY-MM-DD');

    });

    $('#genarate').click(function (e) {
        

        if(start_date==end_date){
            Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please enter a valid date',
                    showConfirmButton: false,
                    timer: 1500
                });
        }
else{
    var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $("#date").text(today);
        $("#date1").text(start_date);
        $("#date2").text(end_date);
                
                $.get("../../routes/water/val06.php",{start:start_date,end:end_date}, function (res) {
                //display data 
                $("#allorders").html(res);
                })
}
    })
});
})

</script> 