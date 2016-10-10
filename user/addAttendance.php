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
			
if($role != "Teacher")
{
	header("Location: index.php");
}

?>


<!DOCTYPE html>
<html>
	<?php
			include("../includes/Utility/header.php");
		?>
		<style>
			.form-style-2 input.input-field {
   				 width: 60pt;
		}
		.form-style-2 label > span {
    		width: 130px;
    		font-weight: bold;
    		float: left;
    		padding-top: 8px;
    		padding-right: 5px;
		}
		</style>
		<script>
		$(document).ready(function(){
		$("#datepicker").datepicker();
		$("#datepicker").datepicker('setDate', new Date());
		});
  $(function() {
    $( "#datepicker" ).datepicker();
    $( "#anim" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });

  });
  </script>
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
					<?php } ?>
					<!--
					<div class='nav_left'>
						<a href="bnner.html">
						<div class='item_nav_left'>Manage User</div>
						<div class='icon_nav_left'><span class='manage_user'></span></div>
						</a>
					</div>
					-->
					<div style='position: absolute;bottom: 0px;width: 262pt;'>
						<div class='nav_left' >
							<a href="#">
								<div class='item_nav_left' style='width:222pt'>Contact Developers</div>
								<div class='icon_nav_left' style='float:right;'><span class='contact' style='float:right'></span></div>
							</a>
						</div>
						<div class='nav_left'>
							<a href="#">
								<div class='item_nav_left' style='width:222pt'>Report Error</div>
								<div class='icon_nav_left' style='float:right;'><span class='error'></span></div>
							</a>
						</div>
					</div>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%;overflow:scroll'>
						<form action='../includes/CourseFileManagement/AddAttendance.php' method='post'>
						
						<div class='title_middle' style='margin-bottom:0pt;'><h2><a href='attendance.php?course=<?php echo $c_id ?>'><u>Attendance</u></a> > Add Attendance</h2><?php echo $message ?></div>
						<center><h1><b><u><div class="form-style-2" style='max-width: 630px;font-size:16pt'>Adding Attendance for <input type='text' name='date' id='datepicker' class='input-field'></div><?php //echo date("Y-m-d") ?></u></a></h1></center>
						
							<input type='text' name='cf_id' value='<?php echo $c_id ?>' hidden>
							<table style='width:100%;margin-top:2pt;'>
								<col width='100'>
								<col width='100'>
								<col width='100'>
								<col width='100'>
								<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;'>
										Registration #
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										First Name
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Last Name
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Status
									</td>
								</tr>
								<?php
								$Query1 = "SELECT *  FROM course_student WHERE c_id =".$c_id."";
						        $result1 = $database->query($Query1);
						        while($row1 = mysqli_fetch_assoc($result1))
						        {
						        	$Query2 = "SELECT fname,lname FROM user WHERE u_id =".$row1['u_id']."";
							        $result2 = $database->query($Query2);
							        if($row2 = mysqli_fetch_assoc($result2))
							        { 
							        	$Query3 = "SELECT reg_no FROM student WHERE u_id =".$row1['u_id']."";
							        	$result3 = $database->query($Query3);
							        	if($row3 = mysqli_fetch_assoc($result3))
							        	{ ?>
						        	<tr>
						       			<td style='border:1px solid black;padding:5pt;'>
											<?php echo $row3['reg_no'];?>
										</td>
										<td style='border:1px solid black;padding:5pt;'>
											<?php echo $row2['fname'];?>
										</td>
										<td style='border:1px solid black;padding:5pt;'>
											<?php echo $row2['lname'];?>
										</td >
										<td style='border:1px solid black;padding:5pt;'>
											<select name='<?php echo $row1['u_id'] ?>' style='width: 100%;height:25pt;' class="select-field">
												<option>P</option>
												<option>A</option>
												<option>L</option>
											</select>
										</td>
										<?php
										}
									}
								}
								?>
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Add' class="myButton"></center></td>
								</tr>
							</table>

						</form>
						
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