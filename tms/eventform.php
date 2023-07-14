<?php
session_start();
error_reporting(0);

include('includes/config.php');
if(isset($_POST['submit']))
{
$eid=intval($_GET['eid']);
$useremail=$_SESSION['login'];
$ename=$_POST['eventname'];	
$elocation=$_POST['eventlocation'];
$edetails=$_POST['eventdetails'];	
$eschedule=$_POST['schedule'];
$ecapacity=$_POST['audience_capacity'];
//$epayment=$_POST['payment_type'];
$eamount=$_POST['amount'];
$eimage=$_FILES["eventimage"]["name"];
move_uploaded_file($_FILES["eventimage"]["tmp_name"],"eventimages/".$_FILES["eventimage"]["name"]);
$sql="INSERT INTO tblevent(EventID,UserEmail,EventName,EventLocation,EventDetails,schedule,audience_capacity,amount,EventImage) VALUES(:eid,:useremail,:ename,:elocation,:edetails,:eschedule,:ecapacity,:eamount,:eimage)";
$query = $dbh->prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':ename',$ename,PDO::PARAM_STR);
$query->bindParam(':elocation',$elocation,PDO::PARAM_STR);
$query->bindParam(':edetails',$edetails,PDO::PARAM_STR);
$query->bindParam(':eschedule',$eschedule,PDO::PARAM_STR);
$query->bindParam(':ecapacity',$ecapacity,PDO::PARAM_INT);
//$query->bindParam(':epayment',$epayment,PDO::PARAM_INT);
$query->bindParam(':eamount',$eamount,PDO::PARAM_INT);
$query->bindParam(':eimage',$eimage,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Event Created Successfully";
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
							<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="eventname" id="eventname" placeholder="Event Name" required>
									</div>
								</div>


                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Location</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="eventlocation" id="eventlocation" placeholder="Event Location" required>
									</div>
								</div>	
								<div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Schedule</label>
									<div class="col-sm-8">
										<input type="datetime-local" class="form-control1" name="schedule" id="schedule" placeholder="Event Schedule" required>
									</div>
								</div>

                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Details</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="5" cols="50" name="eventdetails" id="eventdetails" placeholder="Event detail" required></textarea> 
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
										<input type="file" name="eventimage" id="eventimage" required>
									</div>
								</div>	

								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
			<?php if($_SESSION['login'])
					{?>
						<li class="spe">
					<button type="submit" name="submit" class="btn-primary btn">Create</button>
						</li>
						<?php } else {?>
							<li class="sigi"  style="margin-top: 1%">
							<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn" >Create</a></li>
							<?php } ?>

				<button type="reset" class="btn-primary btn ">Reset</button>
				<div class="clearfix"></div>
			</div>
		</div>		
					</div>
					
					</form>

     
      

      
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


</body>
</html>
