<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit1']))
{
$fname=$_POST['fname'];
$email=$_POST['email'];	
$mobile=$_POST['mobileno'];
$subject=$_POST['subject'];	
$description=$_POST['description'];
$sql="INSERT INTO  tblenquiry(FullName,EmailId,MobileNumber,Subject,Description) VALUES(:fname,:email,:mobile,:subject,:description)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Enquiry  Successfully submited";
}
else 
{
$error="Something went wrong. Please try again";
}

}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Tourism Management System</title>
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
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">TMS-Tourism Management System</h1>
	</div>
</div>
<div class="container text -white py-5 ">
            <div class="row py-5 ">
                <div class="col-lg-8 m-auto text-center ">
                    <h1> Contact Us </h1>
                    <h6 style="color: rgb(189, 27, 27); "> Always Be In Touch With Us</h6>

                </div>
            </div>
            
                        <form action="contactjs.php" method="post" onsubmit="return Submit()">
                            <div class="row ">
                                <div class="col-lg-6 ">
                                    <input type="text" name="fname" id="name1" class="form-control bg-light" placeholder="First Name" onkeyup="return Submit()" required><span id="uspan"></span>
                                </div>
                                <div class="col-lg-6 ">
                                    <input type="text" name="lname" id="lastname2" class="form-control bg-light" placeholder="Last Name" onkeyup="return Submit()" required><span id="lspan"></span>
                                </div><br><br>
                                <div class="col-lg-6 ">
                                    <input type="text" name="email" id="umail3" class="form-control bg-light" placeholder="Enter Your Email" onkeyup="return Submit()" required><span id="espan"></span>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-12 py-3 ">
                                    <textarea class="form-control bg-light" name="message" placeholder="Enter Your Message " id="msg" cols="10" rows="5" onkeyup="return Submit()" required></textarea><span id="mspan"></span>
                                </div>
                            </div>
                            <input type="submit" value="Submit" name="submit" style="background-color: pink;" onclick="return Submit()">
                        </form>
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