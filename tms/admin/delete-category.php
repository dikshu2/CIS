
<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$cid=intval($_GET['cid']);	

// $cid=$_POST['CategoryId'];
$sql="delete from tblcategory  where CategoryId=$cid";
$query = $dbh->prepare($sql);
mysqli_query($conn,$sql);
$msg="Category Deleted Successfully";
echo $msg;
header('location:manage-category.php');
}

	?>
