<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
$useremail=$_SESSION['login'];
$eventseat=$_POST['seat'];
$comment=$_POST['comment'];
$eventid=$_POST['eid'];
$status=0;


$selectSql = "SELECT audience_capacity FROM tblevent WHERE EventId = :eid";
$selectQuery = $dbh->prepare($selectSql);
$selectQuery->bindParam(':eid', $eventid, PDO::PARAM_INT);
$selectQuery->execute();
$row = $selectQuery->fetch(PDO::FETCH_ASSOC);
$audienceCapacity = $row['audience_capacity'];

// Update the audience_capacity in tblevent after subtracting the seat value
$updatedCapacity = $audienceCapacity - $eventseat;
if ($updatedCapacity < 0 ) {
	$msg = "Entered number of seats are not available.";
} elseif($eventseat == 0){
	$msg = "please enter number of seats";
}else{
	$updateSql = "UPDATE tblevent SET audience_capacity = :updatedCapacity WHERE EventId = :eid";
	$updateQuery = $dbh->prepare($updateSql);
	$updateQuery->bindParam(':updatedCapacity', $updatedCapacity, PDO::PARAM_INT);
	$updateQuery->bindParam(':eid', $eventid, PDO::PARAM_INT);
	$updateQuery->execute();
	
	$sql="INSERT INTO tbleventbooking(EventId,UserEmail,Seat,Comment,status) VALUES(:eid,:useremail,:seat,:comment,:status)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':eid',$eventid,PDO::PARAM_INT);
	$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
	$query->bindParam(':seat',$eventseat,PDO::PARAM_STR);
	$query->bindParam(':comment',$comment,PDO::PARAM_STR);
	$query->bindParam(':status',$status,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
	$msg="Booked Successfully";
	}
	else 
	{
	$error="Something went wrong. Please try again";
	}
}

}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>CIS | Event Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		 new WOW().init();
	</script>
<script src="js/jquery-ui.js"></script>
					<script>
						$(function() {
						$( "#datepicker,#datepicker1" ).datepicker();
						});
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
.button-corner {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 9999;
  color:green;
}
.emoji:hover::before {
  content: "Add Event";
  position: absolute;
  top: -20px;
  left:0;
  color:#34ad00;
  padding: 5px;
}
		</style>				
</head>
<body>
<!-- top-header -->
<?php include('includes/header.php');?>
<div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> CIS -Event Details</h1>
	</div>
</div>
<!--- /banner ---->
<!--- selectroom ---->
<div class="selectroom">
	<div class="container">	
		  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
 

<?php $sql = "SELECT * from tblevent where status=1";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form name="book" method="post">
		<div class="selectroom_top">
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="eventimages/<?php echo htmlentities($result->EventImage);?>" class="img-responsive" alt="">
			</div>
			<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
				<h2><?php echo htmlentities($result->EventName);?></h2>
				<p class="dow">#Ev-<?php echo htmlentities($result->EventId);?></p>
				<p><b>Event Location :</b> <?php echo htmlentities($result->EventLocation);?></p>
        <p><b>Audiance Capacity :</b> <?php echo htmlentities($result->audience_capacity);?></p>
        <p><b>Event Date :</b> <?php echo htmlentities($result->schedule);?></p>

						<div class="clearfix"></div>
				<div class="grand">
					<p>Event Fee</p>
					<h3> Rs. <?php echo htmlentities($result->amount);?></p></h3>
				</div>
			</div>
		<h3>Event Details</h3>
				<p style="padding-top: 1%"><?php echo htmlentities($result->EventDetails);?> </p>	
				<div class="clearfix"></div>
		</div>
		<div class="selectroom_top">
			<h2></h2>
			<input type="hidden" name="eid" value="<?php echo $result->EventId; ?>">
			<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
				<ul>
				<li class="spe">
						<label class="inputLabel">Seat</label>
						<input class="special" type="number" name="seat" required>
					</li>
					<li class="spe">
						<label class="inputLabel">Comment</label>
						<input class="special" type="text" name="comment" required>
					</li>
					<?php if($_SESSION['login'])
					{?>
						<li class="spe" align="center">
					<button type="submit" name="submit2" class="btn-primary btn">Book</button>
						</li>
						<?php } else {?>
							<li class="sigi" align="center" style="margin-top: 1%">
							<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn" > Book</a></li>
							<?php } ?>
					<div class="clearfix"></div>
				</ul>
			</div>
			
		</div>
		</form>
<?php }} ?>


	</div>
</div>
<a href="eventform.php" class="button-corner emoji"><span style='font-size:100px;'>&#10133;</span></a>
<!--- /selectroom ---->
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