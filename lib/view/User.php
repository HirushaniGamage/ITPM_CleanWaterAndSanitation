<?php
//star the session
session_start();
//chek its logd in?
if(empty($_SESSION['user_id'])){
  header('location:login.php');
}


include_once('../layout/app.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>choose what do you want</title>
    <link rel="stylesheet" href="../../css/stepform.css"/>
    <script src="../../js/stepform.js" defer></script>
    <style>
        #cardCOP{
    border-radius:0.5rem;
    max-width:35ch;
    transition: transform 500ms ease;
}

#cardCOP:hover{
    transform: scale(1.1);
}

#cardCOP1{
    border-radius:0.5rem;
    max-width:35ch;
    transition: transform 500ms ease;
}

#cardCOP1:hover{
    transform: scale(1.1);
}
#cardCOP2{
    border-radius:0.5rem;
    max-width:35ch;
    transition: transform 500ms ease;
}

#cardCOP2:hover{
    transform: scale(1.1);
}

        #bodyUO {
            background: url("../upload/ui/bottle-2032980_1920.jpg")no-repeat center fixed;
            background-size: cover;
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>

<body id="bodyUO">
  <div class="container py-5">
    <div class="row py-5">
      <div class="col-4 py-5 px-5">
        <div class="card shadow card border-info" id="cardCOP" name="01">
          <div>
            <img src="../upload/ui/truck-downloads-water-from-the-river-from-vector-41873568.jpg"  class="img-fluid card-img-top">
          </div>
          <div class="card-body">
            <h3 class="card-title">Water Service</h3>
            <h7>Lorem ipsum dolor sit amet consectetur adipisicing elit. ea consequuntur?</h7>
          </div>
        </div>
      </div>
  
      <div class="col-4 py-5 px-5">
       <div class="card shadow card border-info" id="cardCOP1">
          <div>
            <img src="../upload/ui/a-sewer-pumps-out-waste-from-the-sewer-vector-43258629.jpg" alt="image2" class="img-fluid card-img-top">
          </div>
          <div class="card-body">
          <h3 class="card-title">Gulley Services</h3>
          <h7>Quod repellat, nam nulla vitae voluptatibus vel quos eius itaque, alias, ea consequuntur?</h7>
          </div>
        </div>
      </div>
      <div class="col-4 py-5 px-5">
        <div class="card shadow card border-info" id="cardCOP2">
          <div>
            <img src="../upload/ui/istockphoto-1304604966-612x612.jpg" alt="image3" class="img-fluid card-img-top">
          </div>
          <div class="card-body">
          <h3 class="card-title">Water Testing</h3>
          <h7>Make Your Dream Place with us, Designing, All Items selecting and Fixing</h7>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
  <script type="text/javascript">
    $(document).ready(function(){
    //Load Product Add Form to Storkeeper page
    $('#cardCOP').click(function(){
      window.location.href = 'water.php';
    });
    $('#cardCOP1').click(function(){
      window.location.href = 'gulley.php';
    });
    $('#cardCOP2').click(function(){
      window.location.href = 'testing.php';
    });
    });
  </script>
</html>