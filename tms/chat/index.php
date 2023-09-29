<?php
include("configuration.php");
session_start();
error_reporting(0);


// if(!isset($_SESSION['login']))
// {
// 	header("location:index.php");
// }
$email=$_SESSION['login'];
$sql=mysqli_query($dbh,"SELECT * FROM tblusers WHERE EmailId='$email'");
$b=mysqli_fetch_array($sql);
$name=$b['FullName'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>CIS | City Information System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="../css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="../css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="../js/jquery-1.12.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--animate-->
<link href="../css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="../js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
<body>
<?php include('../includes/header.php');?>
<div class="banner">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> CIS - City Information System</h1>
	</div>
</div>
<span class="heading"><b>Welcome</b> <?php echo $name;?></span><span style="float:right">
<img src="images/download.png" height="50" width="100"  type="hidden"/></a></span>
<hr style="border:6px dotted #63C;"/><br />
<br /><div align="center">
<table class="table" cellpadding="6" cellspacing="6">
<tr><td align="center">
<span class="tableHead" style="text-decoration:underline;">User Commands</span><br /><br />
<a href="box.php"><img src="images/box.jpg" height="65" width="95" style="border-radius:6px;" /></a>
<a href="conversation.php"><img src="images/conv.jpg" height="65" width="95" style="border-radius:6px;" /></a><br />


</td></tr></table></div>
<?php include('../includes/footer.php');?>
<!-- signup -->
<?php include('../includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('../includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('../includes/write-us.php');?>
</body>

</html>