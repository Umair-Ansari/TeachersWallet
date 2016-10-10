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
$role = "";
if(isset($_SESSION["role"]))
	{
		$role 			= $_SESSION["role"];
	}
			
if($role != "Admin")
{
	header("Location: index.php");
}
if(!isset($_GET['u_id']))
{
	header("Location: index.php");
}
require_once("../includes/database.php");
global $database;
?>
<!DOCTYPE html>
<html>
		<?php
			include("../includes/Utility/header.php");
		?>
		<style>
			.form-style-2 input.input-field {
   				 width: 100%;
		}
		.form-style-2 label > span {
    		width: 130px;
    		font-weight: bold;
    		float: left;
    		padding-top: 8px;
    		padding-right: 5px;
		}
		</style>
		
		
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
					<div class='nav_left'>
						<a href="newCourse.php">
						<div class='item_nav_left' >Course Management</div>
						<div class='icon_nav_left'><span class='newCourse'></span></div>
						</a>
					</div>
					<div class='nav_left'  style='background-color: #E1E2E3;'>
						
						<div class='item_nav_left'  style='background-color: #E1E2E3;'>Course File Management</div>
						<div class='icon_nav_left'><span class='newCourseFile'></span></div>
						
					</div>
					<?php } 
					
					if($role == "Teacher")
					{ ?>
					<div class='nav_left' style='background-color: #E1E2E3;'>
						
						<div class='item_nav_left' style='background-color: #E1E2E3;'>Course File Management</div>
						<div class='icon_nav_left' style='background-color: #E1E2E3;' ><span class='manage_meeting'></span></div>
						
					</div>
					<div class='nav_left'>
						<a href="course.php">
						<div class='item_nav_left'>Course Request</div>
						<div class='icon_nav_left'><span class='account_request'></span></div>
						</a>
					</div>
					<?php } include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%;'>
						<div class='title_middle' style='margin-bottom: 0pt;'><h2>Teacher's Profile</h2> <?php echo $message ?></div>
						
						<?php
						$Query_teacher = "SELECT * FROM teacher WHERE u_id = ".$_GET['u_id']."";
						$result_teacher = $database->query($Query_teacher);
						if ( $row_teacher = mysqli_fetch_assoc($result_teacher)) 
						{
							$Query_user = "SELECT * FROM user WHERE u_id = ".$_GET['u_id']."";
							$result_user = $database->query($Query_user);
							if ( $row_user = mysqli_fetch_assoc($result_user))
							{ 
							$t_id 			= $row_teacher['t_id'];
							$office 	 	= $row_teacher['t_office'];
							$phone 			= $row_teacher['t_phone'];
							$qualification 	= $row_teacher['final_qualification'];
							$gender 		= $row_teacher['t_gender'];
							$cnic 			= $row_teacher['t_cnic'];

							$office 		=  (explode(" ",$office));
							$qualification 	=  (explode(" ",$qualification));
							$fname 			=  $row_user['fname'];
							$lname 			=  $row_user['lname'];
						?>	
							<table style='width:100%;margin-top:2pt;'>
								<tr>
									<td colspan='4'><b><br><h3><u>Personal Information<u></h3></b></td>
								</tr>
								<tr>
									<td><b>First Name</b></td>
									<td><?php echo $fname ?></td>
								
									<td><b>Last Name</b></td>
									<td><?php echo $lname ?></td>
								</tr>
								<tr>
									<td><b>CNIC</b></td>
									<td><?php echo $cnic ?></td>
								
									<td><b>Gender</b></td>
									<td><?php echo $gender ?></td>
								</tr>
								<tr>
									<td><b>Office</b></td>
									<td><?php echo $office[0]." ".$office[1].", Room no : ".$office[2] ?></td>
								
									<td><b>Phone</b></td>
									<td><?php echo $phone ?></td>
								</tr>
								<tr>
									<td colspan='4'><b><br><h3><u>Qualification <u></h3></b></td>
									
								</tr>
								<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;'>
										Degree
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Institute
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Division
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Percentage
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										CGPA
									</td>
								</tr>
								<?php
								$print = "";
								$Query_qualification = "SELECT *  FROM qualification WHERE u_id =".$_GET['u_id']."";
							    $result_qualification = $database->query($Query_qualification);
							    while($row_qualification = mysqli_fetch_assoc($result_qualification))
							    {
							    	
							    	$print .= "<tr>";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['degree'];
										$print .="</td >";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['institute'];
										$print .="</td >";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['division'];
										$print .="</td >";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['percentage'];
										$print .="</td >";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['cgpa'];
										$print .="</td>";
									$print .="</tr>";
							    }
							    echo $print;
							    ?>
							</table>
						<?php
							}
						}
						else
						{
							echo "<center><h2>No Data Found!</h2></center>";
						}
						?>
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