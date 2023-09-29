<?php
include("configuration.php");
session_start();
error_reporting(0);
if(isset($_POST['submit']))
{

$useremail=$_SESSION['login'];
$groupname=$_POST['groupid'];	
$sql="INSERT INTO chat_people(UserEmail,ChatGroup) VALUES(:useremail,:group)";
$query = $db->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':group',$groupname,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $db->lastInsertId();
if($lastInsertId)
{
$msg="Joined Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chat Room</title>
<link href="scripts/styleSheet.css" rel="stylesheet" type="text/css" />
<style>.button-corner {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 9999;
  color:green;
}

body{
 
  background-image:url(../images/temple.jpg); 
  background-color: #FAF9F6;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}

.emoji:hover::before {
  content: "Create Group";
  position: absolute;
  top: -20px;
  left:0;
  color:#34ad00;
  padding: 5px;
}
a:hover {
  font-family: "Segoe UI";
  color: #34ad00;;
  text-decoration: none;
  font-size: 16px;
  text-shadow: 2px 2px 3px #333333;
}
</style>
</head>

<body>
  <div>
<span class="heading" style="color: #34ad00;">Chat Room</span><span style="float:right">
<img src="images/box.jpg" height="50" width="100"  /></a></span>
<hr style="border:6px dotted #63C;"/><br />
<br />
<a href="index.php" style="color: #34ad00;">BACK</a>
<div class="rooms">
	<div class="container">
		
		<div class="room-bottom">
			<h3 style="color: #34ad00;">Group List</h3>
			<form class="navbar-form" method="POST" action="" id="searchForm">
                                    <div class="search">
                                        <input class="px-2 search" type="search" name="searchTerm" id="searchTerm" placeholder="Search..." aria-label="Search" style="color: black";>
                                        <button type="submit" name="search"  id="searchbtn" style="background-color: #34ad00;">Go</button>
									
                                    </div>
                                </form>
                                <div id="searchResults"></div>
					
<?php 
$searchTerm = '%%'; // Initialize the variable
if (isset($_POST['search'])) {
    $searchTerm = '%' . $_POST['searchTerm'] . '%';
}
$sql = "SELECT * from chat_group where GroupName Like :searchTerm";
$useremail=$_SESSION['login'];
$query = $db->prepare($sql);
$query->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
			<div class="rom-btm" style="float: left; margin-right: 20px;">
				<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
					<img src="/tms/tms/chat/groupimages/<?php echo htmlentities($result->GroupImage);?>" class="img-responsive"  style="width:2in; height:2in; margin-right:1in; display:flex;"  alt="">
				</div>
				<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
					<h4>Group Name: <?php echo htmlentities($result->GroupName);?></h4>
          <h4>Purpose: <?php echo htmlentities($result->Purpose);?></h4>
					
</div>

  <?php
  $sq= "SELECT * from chat_people where UserEmail=:uemail AND ChatGroup=:cgroup"; 
  $query = $db->prepare($sq);
$query->bindParam(':uemail',$useremail,PDO::PARAM_STR);
$query->bindParam(':cgroup',$result->Id,PDO::PARAM_INT);
$query->execute();
$lastInsertId = $db->lastInsertId();
if($query->rowCount() > 0)
{?>
  <a href="chatgroup.php?pid=<?php echo htmlentities($result->Id);?>">Enter</a>
<?php
}else{?>
  <form action="#" method="POST">
  <input type="text" id="groupid" name="groupid" value="<?php echo htmlentities($result->Id);?>" hidden>
  <button name="submit">Join</button></form>	<?php
}
?>
				</div>
				<div class="clearfix"></div>
			</div>

<?php }}  ?>
			
		</div>
	</div>
<a href="createchat.php" class="button-corner emoji"><span style='font-size:100px;'>&#10133;</span></a>
  </div>
</body>
</html>