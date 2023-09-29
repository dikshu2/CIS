<?php 

if($_SESSION['login'])
{?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="top-header">
	<div class="container">
		<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
			<li class="hm"><a href="/tms/tms/index.html"><i class="fa fa-home"></i></a></li>
			<li class="prnt"><a href="/tms/tms/profile.php">My Profile</a></li>
				<li class="prnt"><a href="/tms/tms/change-password.php">Change Password</a></li>
			<li class="prnt"><a href="/tms/tms/eventhistory.php">Event History</a></li>
			<li class="prnt"><a href="/tms/tms/tour-history.php">Booking History</a></li>
			<li class="prnt"><a href="/tms/tms/customereventhistory.php">User registered details</a></li>
			<li class="prnt"><a href="/tms/tms/issuetickets.php">Issue</a></li>
			<li class="prnt"><a href="/tms/tms/chatgroup_history.php">ChatGroup</a></li>
			<button id="notification-button" style="background-color: #3F84B1; border: none; height:2px;">
    <a href="/tms/tms/notification.php">
        <i class="fas fa-bell"></i>
    </a>
</button>	
		</ul>
		<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s"> 
			<li class="tol">Welcome :</li>				
			<li class="sig"><?php echo htmlentities($_SESSION['login']);?></li> 
			<li class="sigi"><a href="/tms/tms/logout.php" >/ Logout</a></li>
        </ul>
		<div class="clearfix"></div>
	</div>
</div><?php } else {?>
<div class="top-header">
	<div class="container">
		<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
			<li class="hm"><a href="/tms/tms/index.php"><i class="fa fa-home"></i></a></li>
				<li class="hm"><a href="/tms/tms/admin/index.php">Admin Login</a></li>
		</ul>
		<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s"> 
			<li class="tol">Toll Number : 123-4568790</li>				
			<li class="sig"><a href="#" data-toggle="modal" data-target="#myModal" >Sign Up</a></li> 
			<li class="sigi"><a href="#" data-toggle="modal" data-target="#myModal4" >/ Sign In</a></li>
        </ul>
		<div class="clearfix"></div>
	</div>
</div>
<?php }?>
<!--- /top-header ---->
<!--- header ---->
<div class="header">
	<div class="container">
		<div class="logo wow fadeInDown animated" data-wow-delay=".5s">
			<a href="/tms/tms/index.php">City <span> Information System</span></a>	
		</div>
	
		<div class="lock fadeInDown animated" data-wow-delay=".5s"> 
			<li><i class="fa fa-lock"></i></li>
            <li><div class="securetxt">SAFE &amp; SECURE </div></li>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /header ---->
<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s">
	<div class="container">
	<div class="navigation">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="cl-effect-1">
						<ul class="nav navbar-nav">
							<li><a href="/tms/tms/index.php">Home</a></li>
							<!-- <li><a href="/tms/tms/contact.php">Contact us</a></li> -->
							
							<!-- <li><a href="page.php?type=aboutus">About</a></li> -->
							<li><a href="/tms/tms/chat/index.php">Chat</a></li>
								<li><a href="/tms/tms/event.php">Event</a></li>
								<li><a href="/tms/tms/category-list.php">Category</a></li>
								
								<li><a href="/tms/tms/map.php">Map</a></li>
								<li><a href="/tms/tms/about.php">About Us</a></li>
								<!-- <li><a href="page.php?type=contact">Contact Us</a></li> -->
								<?php if($_SESSION['login'])
{?>
								<li>Need Help?<a href="#" data-toggle="modal" data-target="#myModal3"> / Write Us </a>  </li>
								<?php } else { ?>
								<li><a href="/tms/tms/enquiry.php"> Enquiry </a>  </li>
								<?php } ?>
								<li>
                                
                            </li>
								<div class="clearfix"></div>

						</ul>
					</nav>
				</div><!-- /.navbar-collapse -->	
			</nav>
		</div>
		
		<div class="clearfix"></div>
	</div>
</div>
<script>
	document.addEventListener("DOMContentLoaded", function () {
    const notificationButton = document.getElementById("notification-button");
    const modal = document.getElementById("notification-modal");
    const messageContent = document.getElementById("notification-message");
    const closeButton = document.querySelector(".close-button");

    notificationButton.addEventListener("click", function () {
        // Replace this with your logic to fetch the message from the database
        const messageFromDatabase = "This is a notification message from the database.";
        
        messageContent.textContent = messageFromDatabase;
        modal.classList.remove("hidden");
    });

    closeButton.addEventListener("click", function () {
        modal.classList.add("hidden");
    });
});

</script>


