<?php
//lets include app.php
include_once('../layout/app.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Macklink Solution Register Page</title>
</head>
<body>
    <section class="form my-4 mx-1">
        <div class="container">
            <div class="card border-secondary py-0" id="logincard">
                <div class="row ">
                    <div class="col-5 px-2.5 mt-0">
                        <img src="../upload/ui/reg.jpg" class="img-fluid" style="height:600px" id="lofinImage">
                    </div>
                    <div class="col-md-7">
                        <div class="col-lg-9 px-1 pt-4">
                            <h1 class="font-weught-bold py-1">Register</h1>
                            <form id="registrationForm">
                                <div class="form-group has-danger mt-3">
                                    <input type="text" style="border-radius: 25px;"  name="userName" id="userName" class="form-control"
                                        placeholder="Enter Your Name">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="Email" style="border-radius: 25px;"  name="userEmail" id="userEmail" class="form-control"
                                        placeholder="Enter Your Email">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" style="border-radius: 25px;"  name="userPwd" id="userPwd" class="form-control"
                                        placeholder="Enter Your Password">
                                    <span id="pwd_errorMsg" style="color:red"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" style="border-radius: 25px;"  name="reuserPwd" id="reuserPwd" class="form-control"
                                        placeholder="Enter Your Password">
                                    <span id="repwd_errorMsg" style="color:red"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" style="border-radius: 25px;"  name="userPhone" id="userPhone" class="form-control"
                                        placeholder="Enter Your Phone number">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" style="border-radius: 25px;"  name="userNIC" id="userNIC" class="form-control"
                                        placeholder="Enter Your NIC">
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-success" style="border-radius: 25px;"  id="btnSave">Create Your Account</button>
                                    <input type="reset" value="clear" onClick="location.href=location.href" style="border-radius: 25px;"  class="btn btn-danger">
                                    <a href="../../index.php">
                                        <button type="submit" name="add"  style="border-radius: 25px;"  class="btn btn-secondary ">
                                            <i class="fas fa-home"></i>Home</bitton>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>

</html>