
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$cid=intval($_GET['cid']);	
if(isset($_POST['delete_btn']))
{
$cid=$_POST['categoryid'];
$sql="delete from tblcategory  where CategoryId=:cid";
$query = $dbh->prepare($sql);
mysqli_query($conn,$sql);
$msg="Category Deleted Successfully";
header('location:manage-category.php');
}

	?>
    <?php } ?>