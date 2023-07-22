<?php
session_start();
error_reporting(0);
include('includes/config.php');

?>
<!DOCTYPE HTML>
<html>
<head>
<title>CIS | City Information System</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tourism Management System In PHP" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/about.css" rel="stylesheet">
 
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<div class="top-header">
<?php include('includes/header.php');?>
<div class="banner-1 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">CIS-City Information System</h1>
	</div>
</div>
<div class="content-section">
<div class="title">
                    <h1>About Us</h1>
                </div>
                <div class="content">
                
                    <p> CIS is an essential when ever we are visiting a particular city.
                        It gives us the valuable information about the city and saves the time.  It is web based platform for the city 
                        guide and can search every place in the city with out taking the help of any personal guide. You can search a city for its prominent places of the city user,
                         and can get social and political information of the city, city culture,security ,entertainment, Business ,Hotels,Jobs etc.
                        The main aim of this project services provided to the users who have registered in the site. The services regarding to city places like historical place, conventional places, 
                        busroutes, bank,atm,college details.
                    </p>
                    <div class="row pt-3 ">
                    <div class="col-lg-6  m-auto ">
                        <button class="btn1 "> <a href="category-list.php">See More</a></button>
                    </div>
                </div>
                <div class="image-section">
                <img class="img-fluid mb-3" src="images/temple1.jpg" style=" height:20px"  alt="">
            </div>
                    <?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>


</body>
</html>