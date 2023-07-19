<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
$eid=intval($_GET['evid']);	

if(isset($_POST['submit']))
{
    $ename=$_POST['eventname'];	
    $elocation=$_POST['eventlocation'];
    $edetails=$_POST['eventdetails'];	
    $eschedule=$_POST['schedule'];
    $ecapacity=$_POST['audience_capacity'];
    $eamount=$_POST['amount'];
    $eimage=$_FILES["eventimage"]["name"];
    move_uploaded_file($_FILES["eventimage"]["tmp_name"],"eventimages/".$_FILES["eventimage"]["name"]);
$sql="update TblTourPackages set EventName=:ename,EventLocation=:elocation,EventDetails=:edetails,schedule=:eschedule,
audienece_capacity=:ecapacity, amount=:eamount where EventId=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->bindParam(':ename',$ename,PDO::PARAM_STR);
$query->bindParam(':elocation',$elocation,PDO::PARAM_STR);
$query->bindParam(':edetails',$edetails,PDO::PARAM_STR);
$query->bindParam(':eschedule',$eschedule,PDO::PARAM_STR);
$query->bindParam(':ecapacity',$ecapacity,PDO::PARAM_INT);
//$query->bindParam(':epayment',$epayment,PDO::PARAM_INT);
$query->bindParam(':eamount',$eamount,PDO::PARAM_INT);
$query->bindParam(':eimage',$eimage,PDO::PARAM_STR);
$query->execute();
$msg="Event Updated Successfully";
}

	?>
<html>
<head>
<title>CIS | Create </title>
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
.comments-container {
  margin-top: 20px;
}

.comment {
  background-color: #f0f0f0;
  padding: 10px;
  margin-bottom: 10px;
}

.comment-author {
  font-weight: bold;
}
.admin-reply {
  background-color: #f0f0f0;
  padding: 10px;
  margin-top: 5px;
  font-style: italic;
}

.comment-text {
  margin-top: 5px;
}
.hidden-element {
    display: none;
  }
		</style>				
</head>
<body>
<!-- top-header -->
<?php include('includes/header.php');?> 
  	       <h3>Create Event</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
						
<?php 
$eid=intval($_GET['evid']);
echo $eid;
$sql = "SELECT * from TblEvent where EventId=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;

if($query->rowCount() > 0)
{
foreach($results as $result)
{ 	?>


							<form class="form-horizontal" name="event" method="post" enctype="multipart/form-data">
							<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="eventname" id="eventname"  required>
									</div>
								</div>


                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Location</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="eventlocation" id="eventlocation" required>
									</div>
								</div>	
								<div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Schedule</label>
									<div class="col-sm-8">
										<input type="datetime-local" class="form-control1" name="schedule" id="schedule" required>
									</div>
								</div>

                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Details</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="5" cols="50" name="eventdetails" id="eventdetails"  required></textarea> 
									</div>
								</div>	
								
                                <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Registration fee</label>
									<div class="col-sm-8">
										<input  type="number" class="form-control1" name="amount" id="amount" required>
									</div>
								</div>
								<div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Audience Capacity</label>
									<div class="col-sm-8">
										<input  type="number" class="form-control1" name="audience_capacity" id="audience_capacity"required>
									</div>
								</div>
								</div>														
<div class="form-group">
<label for="focusedinput" class="col-sm-2 control-label">Image</label>
<div class="col-sm-8">
<img src="eventimages/<?php echo htmlentities($result->EventImage);?>" width="200">&nbsp;&nbsp;&nbsp;<a href="changeeventimage.php?imgid=<?php echo htmlentities($result->EventId);?>">Change Image</a>
</div>
</div>

<div class="form-group">
									
									<div class="col-sm-8 hidden-element">
<?php echo htmlentities($result->UpdationDate);?>
									</div>
								</div>		
								<?php }} ?>

								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="submit" class="btn-primary btn">Update</button>
			</div>
		</div>
						
					
						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

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

</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
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
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>