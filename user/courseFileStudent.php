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
			
if($role != "Student")
{
	header("Location: index.php");
}
require_once("../includes/database.php");
global $database;
?>
<!DOCTYPE html>
<html>
	<head>
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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		
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
					<?php }
					if($role == "Student")
					{?>
					<div class='nav_left'  style='background-color: #E1E2E3;'>
						
						<div class='item_nav_left'  style='background-color: #E1E2E3;'>Course</div>
						<div class='icon_nav_left'  style='background-color: #E1E2E3;'><span class='manage_meeting'></span></div>
						
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
				<div class='middle_right' style='width:78%'>
					<div class='middle' style='width:100%;overflow:scroll'>
						<div class='title_middle' style='margin-bottom: 0pt;'><h2>Course File</h2> <?php echo $message ?></div>
						<table style='width:100%;margin-top:2pt;'>
							
							<col width='190'>
							<col width='150'>
							<col width='300'>
							<col width='100'>

							<col width='150'>

							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Scheme Of Study
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Break Out
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Course : Credit Hours
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Program
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Batch
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Evaluate
								</td>
							</tr>
							<?php
							$user = $_SESSION["user"];
							$Query_course_student = "SELECT c_id FROM course_student WHERE u_id = $user ";
					        $result_course_student = $database->query($Query_course_student);
							while ( $row_course_student = mysqli_fetch_assoc($result_course_student))
							{
								$Query = "SELECT * FROM course_file WHERE cf_id = ".$row_course_student['c_id']." ";
						        $result = $database->query($Query);
								if ( $row = mysqli_fetch_assoc($result)) 
								{
									$Query2 = "SELECT * FROM course WHERE c_code = {$row['c_code']} ";
							        $result2 = $database->query($Query2);
									if ( $row2 = mysqli_fetch_assoc($result2)) 
									{
										$Query3 = "SELECT * FROM class WHERE c_id = {$row2['c_id']} ";
								        $result3 = $database->query($Query3);
										if ( $row3 = mysqli_fetch_assoc($result3)) 
										{	 	
									
								?>	 	 	 
									<tr style="background-color:#EDF3F6;">
										
										<td style='border:1px solid black;padding:5pt;'>
										<?php if(is_dir("../includes/CourseFileManagement/course_files/scheme_of_study/".$row['cf_id']."")){$dir = "../includes/CourseFileManagement/course_files/scheme_of_study/".$row['cf_id']."";$files = scandir($dir, 0);for($i = 2; $i < count($files); $i++)echo "<a href='../includes/CourseFileManagement/course_files/scheme_of_study/".$row['cf_id']."/".$files[$i]."' target='_blank'>Download</a>";} else {echo "No Files Uploaded";}  ?>
										</td>
										<td style='border:1px solid black;padding:5pt;'>
										<?php if(is_dir("../includes/CourseFileManagement/course_files/break_out/".$row['cf_id']."")){$dir = "../includes/CourseFileManagement/course_files/break_out/".$row['cf_id']."";$files = scandir($dir, 0);for($i = 2; $i < count($files); $i++)echo "<a href='../includes/CourseFileManagement/course_files/break_out/".$row['cf_id']."/".$files[$i]."' target='_blank'>Download</a>";} else {echo "No Files Uploaded";}  ?>
										</td>
										<td style='border:1px solid black;padding:5pt;'>
											<?php echo $row2['c_title']." : ".$row2['c_hours']; ?>
										</td>
											
										<td style='border:1px solid black;padding:5pt;'>
											<?php echo $row2['program'] ?>
										</td>
										<td style='border:1px solid black;padding:5pt;'>
											<?php echo $row2['batch'] ?>
										</td>
										<td style='border:1px solid black;padding:5pt;width:110pt;'>
											<a href='TeacherEvaluation.php?u_id=<?php echo $row['u_id']?>&course=<?php echo $row['cf_id'] ?>'>Teacher</a> | <a href='CourseEvaluation.php?u_id=<?php echo $row['u_id']?>&course=<?php echo $row['cf_id'] ?>'>Course</a>
										</td>
									</tr>
									<tr>
										<td colspan='6'>
											<center>
											<table>
												<tr>
													<td>
														<a href="attendanceStudent.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Attendance</button></a> | 
													</td>
													<td style='padding-left:2pt;'>
													<td>
														<a href="notesStudent.php?course=<?php echo $row['cf_id'] ?>&action=View"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Notes</button></a> | 
													</td>
													<td style='padding-left:2pt;'>
													<a href="midtermAdmin.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Midterm</button></a> | 
												</td>
												<td style='padding-left:2pt;'>
													<a href="projectAdmin.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Project</button></a> | 
												</td>
													<td style='padding-left:2pt;'>
														<a href="assignmentStudent.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Assignment</button></a> | 
													</td>
													<td style='padding-left:2pt;'>
														<a href="quizStudent.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Quiz</button></a> | 
													</td>
													<td style='padding-left:2pt;'>
														<a href="resultStudent.php?course=<?php echo $row['cf_id'] ?>"> <button class='myButton' style='margin-top:2pt;font-size:8pt;'>Result</button></a>
													</td>
												</tr>
											</table>
											</center>
											<br>
										</td>
									</tr>
									
								<?php
										}
									}
								}
							}
							?>
						</table>
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