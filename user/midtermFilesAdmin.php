<?php
if(session_id() == '') {
    session_start();
}
if (!isset($_SESSION["user"])) {
	 header("Location: ../index.php");
}
$message = "";
if (isset($_SESSION["Message"])) 
{
	$message = $_SESSION["Message"];
	unset($_SESSION["Message"]);
}
require_once("../includes/database.php");
global $database;
$c_id = $_GET['course'];
$role = "";
if(isset($_SESSION["role"]))
	{
		$role 			= $_SESSION["role"];
	}
			
if($role != "Admin")
{
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
	
		<?php
			include("../includes/Utility/header.php");
		?>
		
		
	</head>
	<body>

		<div class='header_container'>
			<div class='header'>
				<div class='logo'>
					<a href='index.php'>
						<P style='font-size:28pt;margin-bottom: -21pt;font-family:Abri;color: #F3F3F3;text-shadow: 0px 0px 3px #D2EBFA;'><b>Teacher's Wallet</b></P><br><i style='margin-left: 145pt;font-size: 8pt;color: #F3F3F3;text-shadow: 0px 0px 3px #D2EBFA;'>powered by iiu</i>
					</a>
				</div><!-- logo -->
				<div class='welcome_logout'>
					<div class='text_welcome_logout' >
						<div class='upper_text_welcome_logout'>Welcome <?php echo $_SESSION["fname"]." ".$_SESSION["lname"]; ?></div>
						<div class='lower_text_welcome_logout' style='color: #F3F3F3;text-shadow: 0px 0px 2px #D2EBFA;'><a href="index.php"  style='color: #E1E2E3;'>Home</a> | <a href="../includes/UserManagement/LogOutBL.php" style='color: #E1E2E3;'>Logout</a></div>
					</div>
				</div>
			</div><!-- header -->
		</div><!-- header container -->
		<div class='container' style='height:auto;'>
			<div class='panel'>
				<div class='left' style='height:850pt;'>
					<div class='nav_left' >
						<a href="index.php" >
							<div class='item_nav_left'>Home</div>
							<div class='icon_nav_left'><span class='dash'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="profile.php">
							<div class='item_nav_left'>Profile</div>
							<div class='icon_nav_left'><span class='profile'></span></div>
						</a>
					</div>
					<?php 
					if($role == "Admin")
					{ ?>
					<div class='nav_left'>
						<a href="meeting.php">
						<div class='item_nav_left'>Meeting Management</div>
						<div class='icon_nav_left'><span class='manage_meeting'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="account.php">
						<div class='item_nav_left'>Account Request</div>
						<div class='icon_nav_left'><span class='account_request'></span></div>
						</a>
					</div>
					<?php } 
					
					if($role == "Teacher")
					{ ?>
					<div class='nav_left'>
						<a href="qualification.php">
						<div class='item_nav_left'>Qualification</div>
						<div class='icon_nav_left'><span class='qualification'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="courseFile.php">
						<div class='item_nav_left'>Course File Management</div>
						<div class='icon_nav_left'><span class='manage_meeting'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="course.php">
						<div class='item_nav_left'>Course Request</div>
						<div class='icon_nav_left'><span class='account_request'></span></div>
						</a>
					</div>
					<?php } 
						include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%'>
						<div class='title_middle' style='margin-bottom:0pt;'><h2><a href='midterm.php?course=<?php echo $c_id ?>'><u>Midterm</u></a> > <?php echo $_GET['action'] ?> <?php echo $_GET['type'] ?> Case Files</h2><?php echo $message ?></div>
						<?php 
						if ($_GET['action'] ==  "View") {
						$dir = "../includes/CourseFileManagement/course_files/Midterm/".$_GET['term']."/".$_GET['type']."/";
						$files = scandir($dir, 0);
						for($i = 2; $i < count($files); $i++)
						    echo  "<img src=".$dir.$files[$i]."  width='200pt' height='200pt'/>";
						
						} else {
							# code...
						?>
						
						
							</table>
						
						<?php } ?>
					</div><!-- middle -->
					
				</div><!-- middle_right -->
			</div>
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
		
  </body>
</html>