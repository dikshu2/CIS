<?php
include("configuration.php");
session_start();
error_reporting(0);
if(!isset($_SESSION['login']))
{
	header("location:index.php");
}
$msg=$_POST['msg'];
$email=$_SESSION['login'];
$id= $_GET['pid'];
$sql=mysqli_query($dbh,"SELECT * FROM tblusers WHERE EmailId='$email'");
$b=mysqli_fetch_array($sql);
$name=$b['FullName'];
$date=date('d-M-Y');
if($msg==NULL)
{
}
else
{
	mysqli_query($dbh,"INSERT INTO box(sender,msg,date,GroupID) VALUES('$name','$msg','$date','$id')");
}
$fetch=mysqli_query($dbh,"SELECT * FROM box where GroupID=$id ORDER BY id  DESC");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Chat Room</title>
<link href="scripts/styleSheet.css" rel="stylesheet" type="text/css" />
<style>
body{
 background-image:url(../images/temple.jpg); 
background-color: #FAF9F6;


}
</style>
</head>
<body>
<div align="center">
<form method="post" action="">
<table class="table" cellpadding="4" cellspacing="4">
<tr><td align="center" class="tableHead" colspan="2"  style="color: #34ad00;">Chatter Box</td></tr>
<tr><td colspan="2"><div class="fields" style="overflow:scroll;height:150px;word-wrap:normal;width:300px;">
<?php while($f=mysqli_fetch_array($fetch))
{
	?>
<span class="nick"><?php echo $f['sender'];?></span> : <span class="msg"><?php echo $f['msg'];?></span><br /><?php } ?>
</div></td></tr>
<tr><td><textarea name="msg" class="fields" rows="2" cols="28" placeholder="Enter Your Message" >
</textarea></td>
<td><input type="submit" value="SEND" class="commandButton"  style="color: #34ad00;"/><br />
<br />
<?php
$sq= "SELECT tblusers.FullName as fname, chat_people.Id as id
from tblusers join chat_people on chat_people.UserEmail=tblusers.EmailId";
	$sql =mysqli_query($dbh, $sq);
	
	$query = $db -> prepare($sq);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$cnt=1;
	if ($query->rowCount() > 0) {
		foreach ($results as $result) {
	?>

<a href="deleteUser.php?user_id=<?php echo htmlentities($result->id); ?>" style="color: #34ad00;">Leave Group</a><br> <br>
<select name="user" id="user" class="fields" style="background-color:#34ad00;">
  <option disabled="disabled" selected="selected"> Members </option>
  <?php while($v=mysqli_fetch_array($sql))
{
?>
  <option value="<?php echo $v['id'];?>"><?php echo $v['fname'];?></option>
  <?php } ?>
</select>
</table>
</form>
<br>
<a href="box.php"  style="color: #34ad00;">BACK</a>
</div>
</body>
</html>
<?php }}?>