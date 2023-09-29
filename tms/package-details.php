<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
$pid=intval($_GET['pkgid']);
$useremail=$_SESSION['login']; 
$comment=$_POST['comment'];
$status=0;
$sql="INSERT INTO tblbooking(PackageId,UserEmail,Comment) VALUES(:pid,:useremail,:comment)";
$query = $dbh->prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':comment',$comment,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Commented Successfully";
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
<title>CIS | Place Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
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
/* rating css */
.rating-box {
  position: relative;
  background: #fff;
  padding: 25px 50px 35px;
  border-radius: 25px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
}
.rating-box .stars {
  display: flex;
  align-items: center;
  gap: 25px;
}
.stars i {
  color: #e6e6e6;
  font-size: 35px;
  cursor: pointer;
  transition: color 0.2s ease;
}
.stars i.active {
  color: #ff9c1a;
}
		</style>				
</head>
<body>
<!-- top-header -->
<?php include('includes/header.php');?>
<div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> CIS -Place Details</h1>
	</div>
</div>
<!--- /banner ---->
<!--- selectroom ---->
<div class="selectroom">
	<div class="container">	
		  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$pid=intval($_GET['pkgid']);
$sql = "SELECT * from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;

if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
 <!-- rating -->
<form name="book" method="post">
		<div class="selectroom_top">
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
			</div>
			<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
				<h2><?php echo htmlentities($result->PackageName);?></h2>
				<p class="dow">#Place-<?php echo htmlentities($result->PackageId);?></p>
				<p><b> Location :</b> <?php echo htmlentities($result->PackageLocation);?></p>			
			</div>
      <div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
      <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0"
       marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=<?php echo htmlentities($result->source);?>&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
       </iframe><a href="https://connectionsgame.org/">Connections Game</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas
       {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>
      </div>
     
		<h3> Details</h3>
				<p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails);?> </p>	
				<div class="clearfix"></div>
				<a href="<?php echo htmlentities($result->links);?>" target="_blank"><b> Visit Website: <?php echo htmlentities($result->links);?></a>	<br>

	
    <?php
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $useremail=$_SESSION['login']; 
    $ratings = []; // Initialize an array to store ratings
$sql = "SELECT rating FROM ratings WHERE item_id = :pid AND UserEmail=:userEmail";
$query = $dbh->prepare($sql);
$query->bindParam(':pid', $pid, PDO::PARAM_STR);
$query->bindParam(':userEmail', $useremail, PDO::PARAM_STR);
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $ratings[] = $row['rating'];
}
$ratingsJSON = json_encode($ratings);

    // Fetch individual ratings
    $avgsql = "SELECT * FROM ratings where item_id=$pid";
    $result = $conn->query($avgsql);
    
    // Calculate average rating
    $averageRating = 0;
    $totalCount = 0;
    
    while ($row = $result->fetch_assoc()) {
        $rating = $row["rating"];
        $averageRating += $rating;
        $totalCount++;
    }
    
    if ($totalCount > 0) {
        $averageRating /= $totalCount;  
  }
   
    // Close the connection
    $conn->close();
    ?>
     </div>
		<div class="selectroom_top">
			<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
				<ul>
        <?php if($_SESSION['login'])
					{?>
				<div class="rating-box">
      <div class="stars">
	    <i class="fa-solid fa-star" data-rating="1"></i>
        <i class="fa-solid fa-star" data-rating="2"></i>
        <i class="fa-solid fa-star" data-rating="3"></i>
        <i class="fa-solid fa-star" data-rating="4"></i>
        <i class="fa-solid fa-star" data-rating="5"></i>
      </div>
        </div><?php } else {?>
          <a href="#" data-toggle="modal" data-target="#myModal4" >
          <div class="rating-box">
      <div class="stars">
	    <i class="fa-solid fa-star" data-rating="1"></i>
        <i class="fa-solid fa-star" data-rating="2"></i>
        <i class="fa-solid fa-star" data-rating="3"></i>
        <i class="fa-solid fa-star" data-rating="4"></i>
        <i class="fa-solid fa-star" data-rating="5"></i>
        </a>
      </div><?php }?><br><br>
        <div><?php  echo "Average Rating: " . round($averageRating, 2);?></div>
    
					<li class="spe">
						<label class="inputLabel">Comment</label>
						<input class="special" type="text" name="comment" required="">
					</li>
					<?php if($_SESSION['login'])
					{?>
						<li class="spe" align="center">
					<button type="submit" name="submit2" class="btn-primary btn">Add Comment</button>
						</li>
						<?php } else {?>
							<li class="sigi" align="center" style="margin-top: 1%">
							<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn" >Add Comment</a></li>
							<?php } ?>
					<div class="clearfix"></div>
				</ul>
			</div>
              
		</div>
		</form>
		<?php
		$packageId=intval($_GET['pkgid']);

		$sql = "SELECT tblusers.FullName as fname, tblbooking.Comment as cmt,tblbooking.AdminReply as adminReply
				FROM tblusers
				INNER JOIN tblbooking ON tblbooking.UserEmail = tblusers.EmailId
				WHERE tblbooking.PackageId = :packageId And tblbooking.status=1";
$query = $dbh->prepare($sql);
$query->bindParam(':packageId', $packageId, PDO::PARAM_INT);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>		
 <div class="comment">
	<div class="comment-author"><?php echo htmlentities($result->fname);?></div>
	<div class="comment-text"><?php echo htmlentities($result->cmt);?></div>
	<?php if (!empty($result->adminReply)) { ?>
		<div class="admin-reply">Admin <br><?php echo htmlentities($result->adminReply);?></div>
	<?php } ?>
</div>
							
							<?php }}?>
<?php }} ?>
<script>

  // Use PHP to pass the value of $pid and 'login' session variable to JavaScript
  const item_id = <?php echo $pid; ?>;
  const loginSession = <?php echo json_encode($_SESSION['login']); ?>; // Properly encode the session variable
  const stars = document.querySelectorAll('.stars i');
  
  setInitialRatings();
  function calculateAverageRating() {
    const ratings=<?php echo $ratingsJSON; ?>;
    console.log("here is ratings :: ", ratings)
    if (ratings.length > 0) {
    let sum = 0;
    for (let i = 0; i < ratings.length; i++) {
      sum += ratings[i];
    }
    return sum / ratings.length;
  }
  return 0; // Default to 0 if no ratings are available
}

  function setInitialRatings() {
    const averageRating = calculateAverageRating();
  const roundedRating = Math.round(averageRating);
  
    console.log("i am inside set intial ratings");
    stars.forEach((star, index) => {
      if (index < roundedRating) {
        star.classList.add("active");
      } else {
        star.classList.remove("active");
      }
    });
}

  stars.forEach(star => {
    star.addEventListener('click', handleRatingClick);
  });

  function handleRatingClick(event) {
    const selectedRating = event.target.getAttribute('data-rating');
    console.log('Selected rating:', selectedRating);

    const dataToSend = {
      rating: selectedRating,
      item_id: item_id,
      login: loginSession // Include the 'login' session variable
    };
    const jsonData = JSON.stringify(dataToSend);
    console.log('JSON data to send:', jsonData);

    // Send the rating data to the server using an AJAX request
    fetch('rating.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: jsonData, // Send the JSON data in the request body
    })
    .then(response => response.text())
    .then(message => {
      // Handle the response from the server if needed
      console.log('Response from server:', message);
    })
    .catch(error => {
      console.error('Error:', error);
    });

    stars.forEach((star, index) => {
      if (index < selectedRating) {
        star.classList.add("active");
      } else {
        star.classList.remove("active");
      }
    });
  }
</script>

</script>

 

	</div>
</div>
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