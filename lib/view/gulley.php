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
    Aqua Guard-Gulley Service
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
                        <li>
                            <a href="#" id="makereq">
                            <i class="fas fa-handshake"></i>
                                <span>Make Request</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="reqlist">
                            <i class="fas fa-stream"></i>
                                <span>All Request</span>
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
            <input class="form-control mx-1 my-1" type="hidden" value="<?php
                                                        //chek the user session
                                                    if(empty($_SESSION['user_id'])){}
                                                    else{print_r($_SESSION['user_id']);}?>" id="userid" name="cby">
           <div class="container" id="adminloadContent">
           <section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
				<div class="about_content">
					<h2 class="wow slideInDown" data-wow-duration=".8s" data-wow-delay=".5s">WELCOME TO <span>AQUA GUARD</span></h2>
					<h5 style="color:darkblue">Defend you water... Defend your health</h5>
					<hr>
					<p class="wow slideInDown" data-wow-duration=".8s" data-wow-delay="" style="color:black; font-family:Arial; font-size: 18px; font-style: italic;">
  Aquaguard Clean Water and Sanitation App is a revolutionary web application that focuses on delivering essential gully and water services to users. Our app is designed to ensure clean and safe water access, promoting hygiene and improving sanitation practices. With Aquaguard Clean Water and Sanitation App, users can conveniently request gully cleaning and water-related services through a user-friendly interface. Our team of trained professionals promptly responds to these requests, addressing gully blockages and water supply issues efficiently.
</p>
<p class="wow slideInDown" data-wow-duration=".8s" data-wow-delay="" style="color:black; font-family:Arial; font-size: 18px; font-style: italic;">
We prioritize the health and well-being of our users by offering comprehensive water purification solutions. Through the app, users can access information about water quality, receive alerts on contamination risks, and explore options for water treatment. Our goal is to empower individuals and communities to make informed decisions about their water consumption.
</p>
<p class="wow slideInDown" data-wow-duration=".8s" data-wow-delay="" style="color:black; font-family:Arial; font-size: 18px; font-style: italic; font-weight:bold;">
Join us on our mission to ensure clean water access and improved sanitation for all. Try out the Aquaguard Clean Water and Sanitation App today and experience the convenience and reliability of our services. Together, let's create a healthier and more hygienic world.</p><hr>
					
				</div>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<div class="about_img wow slideInRight">
					<img src="../upload/ui/AQUA GUARD (1).png" width="450px"  id="imghver" class="bounce-image">
				</div>
				
			</div> 
		</div>
	</div>
</section>
<section id="choose">
	<div class="container">
		<div class="row">
			<div class="title">
				
				<h2 style="color: red;text-align:center; font-weight:bold;">WHY CHOOSE US?</h2>
				<p style="color: white;text-align:center">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,</p>
			</div>

			<div class="col-lg-3 col-ms-3 col-sm-6 col-xs-12">
				<div class="single_box wow slideInUp" data-wow-duration=".5s" data-wow-delay=".3s">
					<div class="img_box">
						<img src="../upload/ui/icon1.png" alt="" class="img-responsive">
					</div>
					<div class="content_box">
						<h4>We deliver quality</h4>
							</div>
				</div>
			</div>
			<div class="col-lg-3 col-ms-3 col-sm-6 col-xs-12">
				<div class="single_box wow slideInUp" data-wow-duration=".5s" data-wow-delay=".4s">
					<div class="img_box">
						<img src="../upload/ui/icon2.png" alt="" class="img-responsive">
					</div>
					<div class="content_box">
						<h4>Always on time  </h4>
							</div>
				</div>
			</div>
			<div class="col-lg-3 col-ms-3 col-sm-6 col-xs-12">
				<div class="single_box wow slideInUp" data-wow-duration=".5s" data-wow-delay=".5s">
					<div class="img_box">
						<img src="../upload/ui/icon3.png" alt="" class="img-responsive">
					</div>
					<div class="content_box">
						<h4>We are pasionate</h4>
							</div>
				</div>
			</div>
			<div class="col-lg-3 col-ms-3 col-sm-6 col-xs-12">
				<div class="single_box wow slideInUp" data-wow-duration=".5s" data-wow-delay=".6s">
					<div class="img_box">
						<img src="../upload/ui/icon4.png" alt="" class="img-responsive">
					</div>
					<div class="content_box">
						<h4>Professional Services </h4>
							</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="customer">

	<div class="container">
		<div class="row">
			<div class="title">
				<h2 style="color: red;text-align:center;  font-weight:bold;">CUSTOMER REVIEWS</h2>
					</div>

			<div class="owl-carousel owl-theme">
	
			<div class="row">
			    <div class="item col-4">
			    	<div class="single_customer">
			    		<div class="customer_content">
			    			<p><span><img src="../../upload/UI/qute.png" alt=""></span> "My life with the Aquaguard Clean Water and Sanitation App has been so easy. It has made requesting gully cleaning and water services so easy and convenient. The response time is impressive, and the professionals who come to address the issues are highly skilled and friendly. This app has truly improved the quality of water in my area, and I feel much safer knowing that I can rely on it for clean water access." - Sarah T.</p>
			    		</div>
			    		<div class="user_id">
			    			<img src="../upload/ui/user1.png" alt="">
			    			<h4 style="color: white">John Smith </h4>
			    		</div>
			    	</div>
			    </div>


			    <div class="item col-4">
			    	<div class="single_customer">
			    		<div class="customer_content">
			    			<p><span><img src="../../upload/UI/qute.png" alt=""></span> As an environmentally conscious individual, I appreciate the Aquaguard Clean Water and Sanitation App's commitment to sustainability. The app not only provides excellent gully and water services but also educates users about water conservation and responsible usage. It's refreshing to see a company that genuinely cares about the environment. With this app, I feel empowered to make informed choices and contribute to a greener future. Kudos to the Aquaguard team for their efforts!" - Emily R.</p>
			    		</div>
			    		<div class="user_id">
						<img src="../upload/ui/user1.png" alt="">
			    			<h4 style="color: white">John Smith </h4>
			    		</div>
			    	</div>
			    </div>


			    <div class="item col-4">
			    	<div class="single_customer">
			    		<div class="customer_content">
			    			<p><span><img src="../../upload/UI/qute.png" alt=""></span> "The Aquaguard Clean Water and Sanitation App has been a game-changer for me and my family. We used to struggle with frequent gully blockages and unreliable water supply. But ever since we started using this app, those problems have become a thing of the past. The app's interface is user-friendly, and the services are prompt and efficient. I highly recommend this app to anyone who wants hassle-free access to clean water and reliable sanitation services." - John M.</p>
			    		</div>
			    		<div class="user_id">
						<img src="../upload/ui/user1.png" alt="">
			    			<h4 style="color: white">John Smith </h4>
			    		</div>
			    	</div>
			    </div>
				</div>
			</div>
		</div>
	</div>
</section> 
<section >
	<div class="container" style="background-color: aqua;">
				<div class="container" style="background-color: light-blue; padding-top:10px;  padding-bottom:20px">
				<h2 style="color: black;text-align:center; font-weight:bold; font-style:italic;">Mention all your problems here</h2>
				<h3 style="color: black;text-align:center; font-weight:bold; font-style:italic;">Or visit : 123/1 , 234 Street, Colombo</h3>
				<h3 style="color: black;text-align:center; font-weight:bold; font-style:italic;">Contact Us : 011- 2233456</h3>
				<h3 style="color: black;text-align:center; font-weight:bold; font-style:italic;">Email : aquaguard@gmail.com</h3>
			</div>
				</div>
	</div>
</section>
           </div>
        </main>
    </div>
</body>
<script>
    $('#makereq').click(function(){
        $('#adminloadContent').load('gulley/addrequest.php');
    });

    $('#reqlist').click(function(){
        $('#adminloadContent').load('gulley/requestlist.php');
    });
</script>
</html>