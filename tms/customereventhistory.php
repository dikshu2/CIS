<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{ 
	// code for cancel
if(isset($_REQUEST['evid']))
	{
$eid=intval($_GET['evid']);
$email=$_SESSION['login'];
$status=2;
$cancelby='a';
$sql = "UPDATE tbleventbooking SET status=:status,CancelledBy=:cancelby WHERE EventId=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
if($query -> execute()){
	$msg="Event Cancelled successfully";
} else{
	$msg = "Failed to cancel event booking";
}

}


if(isset($_REQUEST['evtid']))
	{
$evid=intval($_GET['evtid']);
$status=1;
$cancelby='a';
$sql = "UPDATE tbleventbooking SET status=:status WHERE EventId=:evid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':evid',$evid, PDO::PARAM_STR);
$query -> execute();
$msg="Event Confirm successfully";
}

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
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>

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
<!-- top-header -->
<div class="top-header">
<?php include('includes/header.php');?>
<div class="banner-1 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">CIS-City Information System</h1>
	</div>
</div>
<!--- /banner-1 ---->
<!--- privacy ---->
<div class="privacy">
	<div class="container">
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">My Event History</h3>
		<form name="chngpwd" method="post" onSubmit="return valid();">
		 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
	<p>
	<table border="1" width="100%">
<tr align="center">
                            <th>#</th>
                            <th>Booking id</th>
							<th>FullName </th>
							<th>Mobile No. </th>
							<th>Email</th>
							<th>Event Name</th>
							<th>Booked Seat</th>
							<th>Comment</th>
							<th>Registration Date</th>
							<th>Status </th>
							<th>Action </th>
</tr>
<?php 

$email=$_SESSION['login'];
$sql = "SELECT tbleventbooking.Id as bid,tblusers.FullName as fname,tblusers.MobileNumber as mnumber,tblusers.EmailId as 
email,tblevent.EventName as ename,tbleventbooking.Seat as seat, tbleventbooking.Comment as cmt,tbleventbooking.RegDate as date,tbleventbooking.status as status,tbleventbooking.CancelledBy as cancelby,
tbleventbooking.UpdationDate as upddate FROM tblusers
JOIN tbleventbooking ON tbleventbooking.UserEmail = tblusers.EmailId
LEFT JOIN tblevent ON tblevent.EventId = tbleventbooking.EventId where tblevent.UserEmail='$email'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
<tr align="center">
<td><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($result->bid);?></td>
<td><?php echo htmlentities($result->fname);?></td>
<td><?php echo htmlentities($result->mnumber);?></td>
<td><?php echo htmlentities($result->email);?></td>
<td><?php echo htmlentities($result->ename);?></td> 
<td><?php echo htmlentities($result->seat);?></td>
<td><?php echo htmlentities($result->cmt);?></td>
<td><?php echo htmlentities($result->date);?></td>
<td><?php if($result->status==0)
{
	echo "Pending";
}
if($result->status==1)
{
echo "Confirmed";
}
if($result->status==2 and  $result->cancelby=='a')
{
echo "Canceled by you at " .$result->upddate;
} 
if($result->status==2 and $result->cancelby=='u')
{
echo "Canceled by User at " .$result->upddate;

}
?></td>

<?php if($result->status==2)
{
	?><td>Cancelled</td>
<?php } else {?>
<td><a href="customereventhistory.php?evid=<?php echo htmlentities($result->bid);?>" onclick="return confirm('Do you really want to cancel Event')" >Cancel</a></td>
<?php }?>
</tr>
<?php $cnt=$cnt+1; }} ?>
	</table>
		
			</p>
			</form>

		
	</div>
</div>
<!--- /privacy ---->
<!--- footer-top ---->
<!--- /footer-top ---->
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
<?php } ?>