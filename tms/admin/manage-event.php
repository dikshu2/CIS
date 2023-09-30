<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 
	// code for cancel
if(isset($_REQUEST['evid']))
	{
$eid=intval($_GET['evid']);
$status=2;
$cancelby='a';
$sql = "UPDATE tblevent SET status=:status,CancelledBy=:cancelby WHERE EventId=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Event Cancelled successfully";
}


if(isset($_REQUEST['evtid']))
	{
$evid=intval($_GET['evtid']);
$status=1;
$cancelby='a';
$sql = "UPDATE tblevent SET status=:status WHERE EventId=:evid";
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
<title>TMS | Admin manage Bookings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
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
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<?php include('includes/header.php');?>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a><i class="fa fa-angle-right"></i>Manage Event</li>
            </ol>
<div class="agile-grids">	
				<!-- tables -->
				<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Manage Event</h2>
					    <table id="table">
						<thead>
						  <tr>
						  <th>Event id</th>
							<th>UserName</th>
							<th>User EmailId</th>
							<th>Event Name </th>
							<th>Event Location </th>
							<th>Event Details</th>
							<th>Event Schedule</th>
							<th>Audiance Capacity</th>
							<th>Fee </th>
							<th>Status </th>
							<th>Action </th>
						  </tr>
						</thead>
						<tbody>
<?php $sql = "SELECT tblevent.EventId as eventid,tblusers.FullName as fname,tblusers.EmailId as 
email,tblevent.EventName as ename,tblevent.EventLocation as elocation, tblevent.EventDetails as details, tblevent.schedule as
 schedule,tblevent.audience_capacity as capacity,tblevent.amount as amount,tblevent.status as status,tblevent.CancelledBy as cancelby,
 tblevent.UpdationDate 
 as upddate from tblusers join  tblevent on  tblevent.UserEmail=tblusers.EmailId";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>		
						  <tr>
							<td><?php echo htmlentities($result->eventid);?></td>
							<td><?php echo htmlentities($result->fname);?></td>
							<td><?php echo htmlentities($result->email);?></td>
							<td><?php echo htmlentities($result->ename);?></td>
							<td><?php echo htmlentities($result->elocation);?></td>
							<td><?php echo htmlentities($result->details);?></td>
							<td><?php echo htmlentities($result->schedule);?></td>
							<td><?php echo htmlentities($result->capacity);?></td>
							<td><?php echo htmlentities($result->amount);?></td>

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

<?php if($result->status==2){
	?><td>Cancelled</td>
<?php } else if($result->status==1){
	?><td> Confirmed </td>
<?php }else {?>
<td><a href="manage-event.php?evid=<?php echo htmlentities($result->eventid);?>" onclick="return confirm('Do you really want to cancel Event?')" >Cancel</a> / <a href="manage-event.php?evtid=<?php echo htmlentities($result->eventid);?>" onclick="return confirm('Event has been confirm')" >Confirm</a></td>
<?php }?>

						  </tr>
						 <?php $cnt=$cnt+1;} }?>
						</tbody>
					  </table>
					</div>
				  </table>
<?php

$sql= "SELECT UserEmail from tblevent";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if ($query->rowCount() > 0) {
    foreach ($results as $result1) {
        $email = htmlentities($result1->UserEmail);
        
        // Assuming you've defined $conn as your database connection object
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $notificationMessage = "";
        if ($result->status == 1) {
            $notificationMessage = 'Your Event has been confirmed by admin';
        } elseif ($result->status == 2) {
            $notificationMessage = 'Your Event has been canceled by admin';
        }
        
       // Create and execute the insertion statement
	   $sql = "INSERT INTO notification (message,seen, useremail) VALUES (?, 'false',?)";
	   $insertStatement = $conn->prepare($sql);

	   if (!$insertStatement) {
		   // Handle prepare error
		   die("Prepare error: " . $conn->error);
	   }

	   $insertStatement->bind_param('ss', $notificationMessage, $email);

   }
}
?>
			</div>
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
						<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php }?>