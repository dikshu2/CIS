<?php
session_start();
error_reporting(E_ALL);

include('configuration.php');


if(isset($_POST['submit']))
{
$email=$_SESSION['login'];
$gname=$_POST['groupname'];
$purpose=$_POST['purpose'];
$cimage=$_FILES["groupimage"]["name"];
move_uploaded_file($_FILES["groupimage"]["tmp_name"],"groupimages/".$_FILES["groupimage"]["name"]);
$sql="INSERT INTO chat_group(UserEmail, GroupName, Purpose, GroupImage) VALUES(:email,:gname,:purpose,:cimage)";
$query = $db->prepare($sql);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':gname',$gname,PDO::PARAM_STR);
$query->bindParam(':purpose',$purpose,PDO::PARAM_STR);
$query->bindParam(':cimage',$cimage,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $db->lastInsertId();
if($lastInsertId)
{
$msg="Group Created Successfully";
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
<style>
	.tab-content{
		color: #0FF
	}
	body{
		background-color: #FAF9F6;
 background-image:url(../images/temple.jpg); 
 background-size: cover;
 background-position: center center;
 background-repeat: no-repeat;
}

</style>
</head>
<body>
<span class="heading" style="color: #34ad00;">Chat Room</span><span style="float:right">
<img src="images/box.jpg" height="50" width="100"  /></a></span>
<hr style="border:6px dotted #63C;"/><br />
<br />
<!-- top-header -->
<div align="center">
  	         <div class="tab-content ">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="event" method="post" enctype="multipart/form-data">
							<table class="table" cellpadding="4" cellspacing="4">
							<tr><td align="center" class="tableHead" colspan="2" style="color: #34ad00;">Form</td></tr>
						                                 	
								<div class="form-group">
									<tr>
										<td>
									
										<input type="text" class="form-control1" name="groupname" id="groupname" placeholder="Enter Group Name" required>
										</td>
									</tr>
								</div>

                                    <div class="form-group">
									<tr>
										<td>
								
										<textarea class="form-control" rows="5" cols="50" name="purpose" id="purpose" placeholder="Enter the purpose to create the group" required></textarea> 
										</td>
									</tr>
								</div>	
		
                              
                                    <div class="form-group">
								<tr>
									<td>
									
										<input type="file" name="groupimage" id="groupimage" required>
									</td>
								</tr>
								</div>
								<tr>
									<td>	

								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
			
						
					<button type="submit" name="submit" class="btn-primary btn">Create</button>
						

				<button type="reset" class="btn-primary btn ">Reset</button>
				<div class="clearfix"></div>
			</div>
		</div>		
									</td>
								</tr>
					<br><br>
					
							</table>
					</form> <br><br>
					<a href="box.php" style="color: #34ad00;">BACK</a>
			 </div>
			 </div>
</div>


     
      

      
   


</body>
</html>
