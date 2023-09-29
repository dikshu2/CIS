<?php
include("configuration.php");
session_start();
error_reporting(0);
ob_start();
if(!isset($_SESSION['login']))
{
	header("location:index.php");
}
$email=$_SESSION['login'];
$sql=mysqli_query($dbh,"SELECT * FROM tblusers WHERE EmailId!='$email' AND chat_type != 'private'");
$receiver=$_POST['user'];
$msg=$_POST['msg'];
$date=date('d-M-Y');
if($receiver==NULL || $msg==NULL)
{
}
else
{
	mysqli_query($dbh,"INSERT INTO message(sender,receiver,msg,date) VALUES('$email','$receiver','$msg','$date')");
	$info="Message Sent";
}
ob_end_flush();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conversation</title>


<link href="scripts/styleSheet.css" rel="stylesheet" type="text/css" />
<style>
	body{
 background-image:url(../images/temple.jpg); 
 background-size: cover;
 background-color: #FAF9F6;
 background-position: center center;
 background-repeat: no-repeat;
}
</style>
</head>

<body>
<span class="heading" style="color: #34ad00;">Private Conversation</span><span style="float:right">
<img src="images/conv.jpg" height="50" width="100"  /></a></span>
<hr style="border:6px dotted #63C;"/><br />
<br />

<br />
<div align="center">
<form method="post" action="">
<table class="table" cellpadding="4" cellspacing="4">
<tr><td class="tableHead" colspan="2" align="center" style="text-decoration:underline; color:#34ad00;">Send Messages</td></tr>
<tr><td class="info" colspan="2" align="center"><?php echo $info;?></td></tr>
<tr><td class="labels" style="color: #34ad00;">Select User : </td><td>
	<select name="user" id="user" class="fields" style="background-color:#34ad00;">
  <option disabled="disabled" selected="selected"> - - - - - - - - - </option>
  <?php while($v=mysqli_fetch_array($sql))
{
?>
  <option value="<?php echo $v['EmailId'];?>"><?php echo $v['FullName'];?></option>
  <?php } ?>
</select></td></tr>
<tr><td class="labels" style="color: #34ad00;">Message : </td><td><textarea name="msg" id="msg" class="fields" rows="2" cols="30" required="required"></textarea></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="SEND" class="commandButton" style="color: #34ad00;" /></td></tr>
</table>
</form>
<br />
<br />
<?php
$r=mysqli_query($dbh,"SELECT * FROM message WHERE receiver='$email' ORDER BY id DESC");
?>
<table cellpadding="4" cellspacing="4" class="table">
<tr><td class="tableHead" align="center" colspan="2" style="text-decoration:underline; color: #34ad00;">Inbox</td></tr>
<?php while($t=mysqli_fetch_array($r))
{
	$ee=$t['sender'];
	$o=mysqli_query($dbh,"SELECT * FROM tblusers WHERE EmailId='$ee'");
	$p=mysqli_fetch_array($o);
	$recv=$p['FullName'];
	?>
<tr><td class="msg" style="font-size:12px;"><?php echo $t['msg'];?>
<span style="color:#F39;"> ( From <?php echo $recv;?> on <?php echo $t['date'];?>)</span>
</td><td><a href="deleteMessage.php?del=<?php echo $t['id'];?>" style="font-size:12px; color: #34ad00;">Delete</a></td></tr>
<?php } ?>


</table>
<br />


<?php 
$r=mysqli_query($dbh,"SELECT * FROM message WHERE sender='$email' ORDER BY id DESC LIMIT 10");
?>
<table cellpadding="4" cellspacing="4" class="table">
<tr><td class="tableHead" align="center" colspan="2" style="text-decoration:underline; color: #34ad00;">Sent Messages</td></tr>
<?php while($t=mysqli_fetch_array($r))
{
	$ee=$t['receiver'];
	$o=mysqli_query($dbh,"SELECT * FROM tblusers WHERE EmailId='$ee'");
	$p=mysqli_fetch_array($o);
	$recv=$p['FullName'];
	?>
<tr><td class="msg" style="font-size:12px;"><?php echo $t['msg'];?><span style="color:#F39;"> ( To <?php echo $recv;?> on <?php echo $t['date'];?>)</span></td><td><a href="deleteMessage.php?del=<?php echo $t['id'];?>" style="font-size:12px; color: #34ad00;">Delete</a></td></tr>
<?php } ?>


</table>
<br />
<br />
<a href="index.php" style="color: #34ad00;">BACK</a>
</div>

</body>

</html>