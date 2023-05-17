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
<div class="container" style="background-color:white;  color: black;">
    <div class="row pt-3">
        <br>
        <img src="../../upload/ui/head.jpg" alt="">
    </div>
    <hr style="height: 6px; text-color: black;">
    <h2 class="py-3" style="text-align:center">Order Report</h2>
    <input class="form-control mx-1 my-1" type="hidden" value="<?php echo($_GET['id']);?>" id="cby_id" name="cby">


    <div class="row"><div class="col-3"><h6>Invoice Number:</h6></div><div class="col-3"><h6 id="id"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Customer Name:</h6></div><div class="col-3"><h6 id="cid"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Date:</h6></div><div class="col-3"><h6 id="date"></h6></div></div>
    
     
    
    <table class="center mt-5" style="text-align:center; width:80%; border: 1px solid;margin-left: auto; margin-right: auto;">
        
        <tr>
            <th>Order ID</th>
            <td id= "oid"></td>
        </tr>
        <tr>
            <th>Order date</th>
            <td id= "odate"></td>
        </tr>
        <tbody>
        <tr>
            <th>Order Address</th>
            <td id="oaddress"></td>
        </tr>
        <tr>
            <th>Confamation</th>
            <td id="ocon"></td>
        </tr>
        <tr>
            <th>Requested Volum</th>
            <td id="vol"></td>
        </tr>
        <tr>
            <th>Payment </th>
            <td id="opay"></td> 
        </tr> 
        <tr>
            <th>Total (LKR)</th>
            <td id="otot"></td> 
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
<button type="button" class="btn btn-success my-3 px-5" onclick="window.print();"><i class="fas fa-print"></i>   Print</button>
</div>
<script>
$(document).ready(function(){
    $.get("../../routes/water/getreqdata.php", {
            uid: $("#cby_id").val()
        }, function (res) {
            var jdata = jQuery.parseJSON(res);
            $('#cid').text(jdata.name);
            $('#oid').text(jdata.id);
            $('#odate').text(jdata.date);
            $('#oid').text(jdata.id);
            $('#oaddress').text(jdata.address);
            $('#ocon').text('Conformed');
            $('#opay').text(jdata.price);
            $('#otot').html(jdata.price);
            $('#vol').text(jdata.capacity);

        })

    $id=Math.floor((Math.random() * 100) + 1);
    //make id
        $('#id').text("INV00"+$id);
//get date
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
//set date
        $('#date').text(date);
    })

</script> 