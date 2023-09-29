<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}else{
	
	$email = $_SESSION['login'];

	$sqlUnseenCount = "SELECT COUNT(*) AS unseen_count FROM notification WHERE UserEmail = :email AND seen = 0";
	$queryUnseenCount = $dbh->prepare($sqlUnseenCount);
	$queryUnseenCount->bindParam(':email', $email, PDO::PARAM_STR);
	$queryUnseenCount->execute();
	$unseenCountRow = $queryUnseenCount->fetch(PDO::FETCH_ASSOC);
	$unseenCount = $unseenCountRow['unseen_count'];
	
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
.center-text {
    text-align: center;
  }

  .notification-badge {
        background-color: red; /* Customize the badge color */
        color: white; /* Customize the text color */
        border-radius: 50%; /* Create a circular badge */
        padding: 5px 10px; /* Adjust padding to fit the content */
        font-size: 12px; /* Customize font size */
        position: relative;
        top: -20px; /* Adjust the top value to position the badge */
        left: 5px; /* Adjust the left value to position the badge */
        z-index: 1; /* Ensure the badge appears on top of the notification text */
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
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Notification
		<?php if ($unseenCount > 0) { ?>
		<span class="notification-badge"><?php echo $unseenCount; ?></span>
	<?php }?>
	</h3>
		<form name="chngpwd" method="post" onSubmit="return valid();">
		 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
	<p>
	<table border="1" width="100%">
<tr align="center" >
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">Notification
						
						</th>
							<th> </th>
</tr>
<?php 
$uemail=$_SESSION['login'];
$sql = "SELECT * from notification where UserEmail=:uemail";
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
			<td><?php echo htmlentities($result->message);?></td>
			<td>
				<?php if ($result->seen == 0) { ?>
					<a href="mark.php?id=<?php echo $result->id; ?>">Mark as Seen</a>
				<?php } else { ?>
					Seen
				<?php } ?>
			</td>
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
