<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['evid']))
	{
$eid=intval($_GET['evid']);
$msg=intval($_GET['msg']);
$email=$_SESSION['login'];
$sql ="SELECT CreationDate, schedule FROM tblevent WHERE UserEmail=:email and EventId=:eid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':eid', $eid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
	$fdate=$result->schedule;
	$a=explode("/",$fdate);
	$val=array_reverse($a);
	$mydate =implode("/",$val);
	$cdate=date('Y/m/d');
	$date1=date_create("$cdate");
	$date2=date_create("$fdate");
    $diff=date_diff($date1,$date2);
    echo $df=$diff->format("%a");
if($df>=0)
{
$status=2;
$cancelby='u';
$msg='Event Canclled';
$sql = "UPDATE tblevent SET status=:status,CancelledBy=:cancelby,message=:msg WHERE UserEmail=:email and EventId=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
$query-> bindParam(':email',$email, PDO::PARAM_STR);
$query-> bindParam(':msg',$msg, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Event Cancelled successfully";
}
else
{
    $error = "You can't cancel the booking after the event date";}
}
}
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
                            <th>Event id</th>
							<th>Event Name </th>
							<th>Event Location </th>
							<th>Event Details</th>
							<th>Event Schedule</th>
							<th>Audiance Capacity</th>
							<th>Fee </th>
							<th>Status </th>
                            <th>Creation Date</th>
							<th>Action </th>
</tr>
<?php 

$uemail=$_SESSION['login'];
$sql = "SELECT * from tblevent where UserEmail=:uemail";
$query = $dbh->prepare($sql);
$query -> bindParam(':uemail', $uemail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
<tr align="center">
<td><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($result->EventId);?></td>
<td><?php echo htmlentities($result->EventName);?></td>
<td><?php echo htmlentities($result->EventLocation);?></td>
<td><?php echo htmlentities($result->EventDetails);?></td>
<td><?php echo htmlentities($result->schedule);?></td>
<td><?php echo htmlentities($result->audience_capacity);?></td>
<td><?php echo htmlentities($result->amount);?></td>
<td><?php if($result->status==0)
{
echo "Pending";
}
if($result->status==1)
{
echo "Confirmed";
}
if($result->status==2 and  $result->CancelledBy=='u')
{
echo "Canceled by you at " .$result->UpdationDate;
} 
if($result->status==2 and $result->CancelledBy=='a')
{
echo "Canceled by admin at " .$result->UpdationDate;

}
?></td>
<td><?php echo htmlentities($result->CreationDate);?></td>
<?php if($result->status==2)
{
	?><td>Cancelled</td>
<?php } else {?>
	<td>
    <a href="eventhistory.php?evid=<?php echo htmlentities($result->EventId);?>" onclick="cancelEvent(event)">Cancel</a>

<script>
    function cancelEvent(event) {
        event.preventDefault(); // Prevent the default link behavior

        // Prompt the user for a message
        var userMessage = prompt("Please enter a cancellation message:");

        // Construct the new URL with the user's message
        var eventId = <?php echo htmlentities($result->EventId); ?>;
        var url = "eventhistory.php?evid=" + eventId + "&msg=" + encodeURIComponent(userMessage);

        // Display the confirmation message
        var confirmCancel = confirm('Do you really want to cancel the event?');
        if (confirmCancel) {
            window.location.href = url; // Proceed with the cancellation
        }
    }
</script>

<a href="updateevent.php?evid=<?php echo htmlentities($result->EventId);?>" onclick="return confirm('Do you really want to update Event')" >Update</a></td>
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