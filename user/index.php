<?php
if(session_id() == '') {
    session_start();
}
if (!isset($_SESSION["user"])) {
	 header("Location: ../index.php");
}
$role = "";
if(isset($_SESSION["role"]))
	{
		$role 			= $_SESSION["role"];
	}

require_once("../includes/database.php");
global $database;
$u_id = $_SESSION["user"];

?>
<!DOCTYPE html>
<html>
	<?php
			include("../includes/Utility/header.php");
		?>
		<script type="text/javascript">
		function View(id){

			$("#pic").attr("src", id);
			$('#popup').bPopup({
    			easing: 'easeOutBack', //uses jQuery easing plugin
    	    	speed: 450,
    	    	transition: 'slideDown'
    		});
		}
		
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
					<div class='nav_left'  style='background-color: #E1E2E3;'>
						
							<div class='item_nav_left' style='background-color: #E1E2E3;'>Home</div>
							<div class='icon_nav_left'><span class='dash'></span></div>
						
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
					<div class='nav_left'>
						<a href="newCourseFile.php">
						<div class='item_nav_left' >Course File Management</div>
						<div class='icon_nav_left'><span class='newCourseFile'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="notification.php">
						<div class='item_nav_left' >Notification</div>
						<div class='icon_nav_left'><span class='notification'></span></div>
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
					if($role == "Student")
					{?>
					<div class='nav_left'>
						<a href="courseFileStudent.php">
						<div class='item_nav_left'>Course</div>
						<div class='icon_nav_left'><span class='manage_meeting'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="addCourse.php">
						<div class='item_nav_left'>Add Course</div>
						<div class='icon_nav_left'><span class='course'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="courseRequests.php">
						<div class='item_nav_left'>Course Requests</div>
						<div class='icon_nav_left'><span class='course_request'></span></div>
						</a>
					</div>
					<?php
					}
					 include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='overflow: hidden'>
						<div class='title_middle'><h2>Home</h2></div>
						<?php
						if($role == "Admin")
						{?>
							<div class='dash_ad'>
							<table>
								<col width='154'>
								<col width='134'>
								<col width='130'>
								<col width='130'>
								<tr>
									<td style="border-bottom: 2px solid #E1E2E3;" colspan='3'><b><center>Meetings</center></b></td>
									
								</tr>
								<tr>
									<td style="border-right: 2px solid #E1E2E3;border-bottom: 2px solid #E1E2E3;"><b>Upcoming Meetings</b></td>
									<td style="border-right: 2px solid #E1E2E3;border-bottom: 2px solid #E1E2E3;"><b>Todays Meetings</b></td>
									<td style="border-bottom: 2px solid #E1E2E3;"><b>Total Meetings</b></td>
								</tr>
								<tr>
									<td style="border-right: 2px solid #E1E2E3;">
										<?php
										$counter = 0;
										$date = date("m/d/Y");
										$Query = "SELECT m_date FROM meeting";
										$result = $database->query($Query);
										while( $row = mysqli_fetch_assoc($result))
										{
											$date2 = $row['m_date'];
											if (strtotime($date2) > strtotime($date))
											{
												$counter = $counter + 1;
											}

										}
										echo $counter;
										?>
									</td>
									<td style="border-right: 2px solid #E1E2E3;">
										<?php
										$date = date("m/d/Y");
										$Query = "SELECT count(*) meeting FROM meeting WHERE m_date='".$date."'";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['meeting'];
										}
										?>
									</td>
									<td >
										<?php
										
										$Query = "SELECT count(*) meeting FROM meeting";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['meeting'];
										}
										?>
									</td>
								</tr>
								<tr>
									
									<td style="text-align: right;" colspan='3'><a href='meeting.php'>view</a></td>
								</tr>
							</table>
						</div><!-- dash_ad -->
						
						<div class='dash_agent'>
							<table>
								<col width='154'>
								<col width='134'>
								<col width='130'>
								<col width='130'>
								<tr>
									<td style="border-bottom: 2px solid #E1E2E3;" colspan='3'><b><center>Pending Requests</center></b></td>
									
								</tr>
								<tr>
									<td style="border-right: 2px solid #E1E2E3;border-bottom: 2px solid #E1E2E3;"><b>Student</b></td>
									<td style="border-right: 2px solid #E1E2E3;border-bottom: 2px solid #E1E2E3;"><b>Teachers</b></td>
									<td style="border-bottom: 2px solid #E1E2E3;"><b>Staff</b></td>
								</tr>
								<tr>
									<td style="border-right: 2px solid #E1E2E3;">
										<?php
										
										$Query = "SELECT count(*) request FROM temp_student WHERE status = 1";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['request'];
										}
										?>
									</td>
									<td style="border-right: 2px solid #E1E2E3;">
										<?php
										
										$Query = "SELECT count(*) request FROM temp_teacher WHERE status = 1";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['request'];
										}
										?>
									</td>
									<td >
										<?php
										
										$Query = "SELECT count(*) request FROM temp_worker WHERE status = 1";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['request'];
										}
										?>
									</td>
								</tr>
								<tr>
									<tr>
									
									<td style="text-align: right;" colspan='3'><a href='account.php'>view</a></td>
								</tr>
								</tr>
							</table>
						</div>
						<div class='dash_agent'>
							<table>
								<col width='154'>
								<col width='160'>
								<col width='130'>
								
								<tr>
									<td style="border-right: 2px solid #E1E2E3;border-bottom: 2px solid #E1E2E3;"><b>Total Courses</b></td>
									<td style="border-right: 2px solid #E1E2E3;border-bottom: 2px solid #E1E2E3;"><b>Total Course Files</b></td>
									<td style="border-bottom: 2px solid #E1E2E3;"><b>Notification</b></td>
								</tr>
								<tr>
									<td style="border-right: 2px solid #E1E2E3;">
										<?php
										
										$Query = "SELECT count(*) course FROM course";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['course'];
										}
										?>
									</td>
									<td style="border-right: 2px solid #E1E2E3;">
										<?php
										
										$Query = "SELECT count(*) course_file FROM course_file";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['course_file'];
										}
										?>
									</td>
									<td >
										<?php
										
										$Query = "SELECT count(*) notification FROM notification";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['notification'];
										}
										?>
									</td>
								</tr>
								<tr>
									<tr>
									<td style="border-right: 2px solid #E1E2E3;text-align: right;"><a href='newCourse.php'>view</a></td>
									<td style="border-right: 2px solid #E1E2E3;text-align: right;"><a href='newCourseFile.php'>view</a></td>
									<td style="text-align: right;"><a href='notification.php'>view</a></td>
								</tr>
								</tr>
							</table>
						</div>
						<?php
						}
						else if($role == "Teacher")
						{?>
							<div class='dash_agent' style='margin-top: 0pt;'>
							<table>
								<col width='154'>
								<col width='160'>
								<col width='130'>
								
								<tr>
									
									<td style="border-right: 2px solid #E1E2E3;border-bottom: 2px solid #E1E2E3;"><b>Course Files</b></td>
									<td style="border-bottom: 2px solid #E1E2E3;"><b>Student Requests</b></td>
								</tr>
								<tr>
									
									<td style="border-right: 2px solid #E1E2E3;">
										<?php
										
										$Query = "SELECT count(*) course_file FROM course_file WHERE u_id = $u_id";
										$result = $database->query($Query);
										if( $row = mysqli_fetch_assoc($result))
										{
											echo $row['course_file'];
										}
										?>
									</td>
									<td >
										<?php
										$counter = 0;
										$Query = "SELECT * FROM course_file WHERE u_id = $u_id";
										$result = $database->query($Query);
										while( $row = mysqli_fetch_assoc($result))
										{
											$Query2 = "SELECT count(*) request FROM student_request WHERE c_code = ".$row['c_code']."";
											$result2 = $database->query($Query2);
											if( $row2 = mysqli_fetch_assoc($result2))
											{

												$val = $row2['request'];
												$counter  = $counter  + $val;
											}
										}
										echo $counter;
										?>
									</td>
								</tr>
								<tr>
									<tr>
									<td style="border-right: 2px solid #E1E2E3;text-align: right;"><a href='CourseFile.php'>view</a></td>
									<td style="text-align: right;"><a href='course.php'>view</a></td>
								</tr>
								</tr>
							</table>
						</div>
						<?php
						}
						else if ($role == "Student")
						{?>
							<div class='dash_agent' style='margin-top: 0pt;'>
							<table>
								<col width='154'>
								<col width='160'>
								<col width='130'>
								
								<tr>
									
									<td style="border-right: 2px solid #E1E2E3;border-bottom: 2px solid #E1E2E3;"><b>Courses</b></td>
									<td style="border-bottom: 2px solid #E1E2E3;"><b>Pending Requests</b></td>
								</tr>
								<tr>
									
									<td style="border-right: 2px solid #E1E2E3;">
										<?php
										$counter = ""; 
										$Query = "SELECT * FROM course_student WHERE u_id = $u_id";
										$result = $database->query($Query);
										while( $row = mysqli_fetch_assoc($result))
										{
											$Query2 = "SELECT count(*) course_file FROM course_file WHERE cf_id = ".$row['c_id']."";
											$result2 = $database->query($Query2);
											if( $row2 = mysqli_fetch_assoc($result2))
											{
												$var =  $row2['course_file'];
												$counter = $counter + $var;
											}
										}
										echo $counter;
										?>
									</td>
									<td >
										<?php
										
										$Query2 = "SELECT count(*) request FROM student_request WHERE u_id = $u_id";
											$result2 = $database->query($Query2);
											if( $row2 = mysqli_fetch_assoc($result2))
											{
												echo $row2['request'];
											
										}?>
									</td>
								</tr>
								<tr>
									<tr>
									<td style="border-right: 2px solid #E1E2E3;text-align: right;"><a href='courseFileStudent.php'>view</a></td>
									<td style="text-align: right;"><a href='courseRequests.php'>view</a></td>
								</tr>
								</tr>
							</table>
						</div>
						<?php
						}?>

					</div><!-- middle -->
					
						
						<?php
							
							if($role == "Student")
							{
								echo "<div class='right' style='padding-top: 14pt;border-left:2px solid #E1E2E3;'>";
								echo "<center><u><h2>Notifications</h2></u><center><br>";
								echo "<table style='width:100%'>";
								$print = "";
								$error = "<tr><td><center>No Notification</center></td></tr>";
								$Query = "SELECT * FROM notification WHERE student=1 ORDER BY n_id DESC";
								$result = $database->query($Query);
								while ( $row = mysqli_fetch_assoc($result)) 
								{	
									if(is_dir("../includes/Notification/notification/".$row['n_id'].""))
									{
										$dir = "../includes/Notification/notification/".$row['n_id']."";
										$files = scandir($dir, 0);
										for($i = 2; $i < count($files); $i++)
										{
											$src = "../includes/Notification/notification/".$row['n_id']."/".$files[$i]."";
										} 
									}
									//$src = "../includes/Notification/notification/1/Untitled.png";
									$error = "";
									?>
									<tr><td><center><button style='background:none;border:none' onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" onClick="View('<?php echo $src ?>');"><?php echo $row['title'] ?></button></center></td></tr>
									<?php 
								}
								echo $print;
								echo $error;
								echo "</table>";
								echo "</center>";
								echo  "</div>";
							}
							else if($role == "Teacher")
							{
								echo "<div class='right' style='padding-top: 14pt;border-left:2px solid #E1E2E3;'>";
								echo "<center><u><h2>Notifications</h2></u><center><br>";
								echo "<table style='width:100%'>";
								$print = "";
								$error = "<tr><td><center>No Notification</center></td></tr>";
								$Query = "SELECT * FROM notification WHERE teacher=1 ORDER BY n_id DESC";
								$result = $database->query($Query);
								while ( $row = mysqli_fetch_assoc($result)) 
								{	
									if(is_dir("../includes/Notification/notification/".$row['n_id'].""))
									{
										$dir = "../includes/Notification/notification/".$row['n_id']."";
										$files = scandir($dir, 0);
										for($i = 2; $i < count($files); $i++)
										{
											$src = "../includes/Notification/notification/".$row['n_id']."/".$files[$i]."";
										} 
									}
									//$src = "../includes/Notification/notification/1/Untitled.png";
									$error = "";
									?>
									<tr><td><center><button style='background:none;border:none;cursor:pointer' onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" onClick="View('<?php echo $src ?>');"><?php echo $row['title'] ?></button></center></td></tr>
									<?php 
								}
								echo $print;
								echo $error;

								echo "</table>";
								echo "</center>";
								echo  "</div>";
							}
							
						    
						?>
							
					
				</div><!-- middle_right -->
			</div>
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
		<div id="popup"  style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;overflow:scroll;width:800pt;height:300pt;" >
			<div class='pop_header'></div>
			<img id='pic' src="" height="auto" width="1000">
		</div>
  </body>
</html>