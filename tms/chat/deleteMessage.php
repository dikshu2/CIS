<?php
include("configuration.php");
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
$del=$_GET['del'];
mysqli_query($dbh,"DELETE FROM message WHERE id='$del'");
header("location:conversation.php");
?>