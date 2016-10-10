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
require_once("../includes/database.php");
$LIMIT = "LIMIT 0,6";
if(isset($_GET['item']))
{
	$min = $_GET['item'];
	$max = $min+6;
	$LIMIT = "LIMIT ".$min.",".$max."";
}
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
		
		<script src="http://dinbror.dk/bpopup/assets/jquery.bpopup-0.9.4.min.js"></script>
		<script src="http://dinbror.dk/bpopup/assets/jquery.easing.1.3.js"></script>
		<script type="text/javascript">
		function Delete(id){
			$('#course').val(id);
    	 	$('#popupc').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};

		$(document).ready(function(){
			$(function() {
			    $( document ).tooltip();
			  });
			$("#checkbox").click(function(){
		    	if( $(this).is(':checked')) {
		    	     $("#accept").show();
		    	      $("#pass").show();
		    	       $("#bp").show();
		    	    
		    	}
		    	else
		    	{
		    		 $("#accept").hide();
		    	      $("#pass").hide();
		    	       $("#bp").hide();
		    	}
		    });
		    
		});
		function blinker() {
		    $('.blink_me').fadeOut(500);
		    $('.blink_me').fadeIn(500);
		}
		setInterval(blinker, 1000);
		
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
					<div class='nav_left'>
						<a href="notification.php">
						<div class='item_nav_left' >Notification</div>
						<div class='icon_nav_left'><span class='notification'></span></div>
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
					include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right' style='width:78%;height: 96%;'>
					<div class='middle' style='width:100%;overflow:scroll'>
						<div class='title_middle' style='margin-bottom: 0pt;'><h2>Course File Management</h2> <?php echo $message ?></div>
						<div style='width:100%;border:2px solid #E1E2E3;height:30pt; margin-bottom:2pt;'>
							<div class="form-style-2" style='padding:0pt;max-width:100%'>
							<form action='newCourseFile.php' method='get'>
								Teacher <select  name='teacher' class="select-field" style='width:30%'>
									<option>Any</option>
									<?php
									$Query = "SELECT * FROM user WHERE r_id=2 ORDER BY fname ASC ";
					        		$result = $database->query($Query);
									while ( $row = mysqli_fetch_assoc($result)) 
									{
										echo "<option value='".$row['u_id']."'>".$row['fname']." ".$row['lname']."</option>";
									}
									?>
									
								</select >
								<!-- Batch <select name='batch' class="select-field" style='width:30%'>
									<option>Any</option>
									<?php
									$Query = "SELECT DISTINCT batch FROM course ";
					        		$result = $database->query($Query);
									while ( $row = mysqli_fetch_assoc($result)) 
									{
										echo "<option value='".$row['batch']."'>".$row['batch']."</option>";
									}
									?>
								</select> -->
								<input type='submit' class="myButton" value='Search'>	
							</form>
							</div>
						</div>
						<table style='width:100%;margin-top:2pt;font-size: 10pt;'>
							
							

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
									Teacher<span title='Click Teacher Name to view Profile' class='blink_me'>!</span>
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Program
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Batch
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Evaluation
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Delete
								</td>
							</tr>
							<?php
							$error = "<h2>No Course Found.</h2>";
							if(isset($_GET['teacher']))
							{
								$teacher = "";
								//$batch = "";
								if($_GET['teacher'] != "Any")
								{
									$teacher = "WHERE  u_id = ".$_GET['teacher'];
								}
								/*if($_GET['batch'] != "Any")
								{
									$batch  = "AND batch = '".$_GET['batch']."'";
								} */
								$Query_search = "SELECT * FROM course_file $teacher $LIMIT";
								$result_search = $database->query($Query_search);
								while( $row = mysqli_fetch_assoc($result_search)) 
								{
									$error = "";
									$Query2 = "SELECT * FROM course WHERE c_code = {$row['c_code']}";
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
										<?php 
											$Query_user = "SELECT * FROM user WHERE u_id = {$row['u_id']} ";
									        $result_user = $database->query($Query_user);
											if ( $row_user = mysqli_fetch_assoc($result_user)) 
											{
												echo "<a href='teacherProfile.php?u_id=".$row['u_id']."'>".$row_user['fname']." ".$row_user['lname']."</a>";
											}
										?>
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										<?php echo $row2['program'] ?>
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										<?php echo $row2['batch'] ?>
									</td>
									<td style='border:1px solid black;padding:5pt;width:110pt;'>
											<a href='TeacherEvaluationView.php?u_id=<?php echo $row['u_id']?>&course=<?php echo $row['cf_id'] ?>'>Teacher</a> | <a href='CourseEvaluationView.php?u_id=<?php echo $row['u_id']?>&course=<?php echo $row['cf_id'] ?>'>Course</a>
										</td>
									<td style='border:1px solid black;padding:5pt;'>
										<center><button title='Delete' onClick='Delete(<?php echo $row['cf_id'] ?>);' style='padding-left: 2pt;background:none;border:none'><span class='reject'></span></button></center>
									</td>
								</tr>
								<tr>
									<td colspan='8'>
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
													<a href="finalAdmin.php?course=<?php echo $row['cf_id'] ?>"> <button class='myButton' style='margin-top:2pt;font-size:8pt;'>Final</button></a> | 
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
							else
							{
							$Query = "SELECT * FROM course_file $LIMIT";
					        $result = $database->query($Query);
							while ( $row = mysqli_fetch_assoc($result)) 
							{
								$error = "";
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
										<?php 
											$Query_user = "SELECT * FROM user WHERE u_id = {$row['u_id']} ";
									        $result_user = $database->query($Query_user);
											if ( $row_user = mysqli_fetch_assoc($result_user)) 
											{
												echo "<a href='teacherProfile.php?u_id=".$row['u_id']."'>".$row_user['fname']." ".$row_user['lname']."</a>";
											}
										?>
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										<?php echo $row2['program'] ?>
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										<?php echo $row2['batch'] ?>
									</td>
									<td style='border:1px solid black;padding:5pt;width:110pt;'>
											<a href='TeacherEvaluationView.php?u_id=<?php echo $row['u_id']?>&course=<?php echo $row['cf_id'] ?>'>Teacher</a> | <a href='CourseEvaluationView.php?u_id=<?php echo $row['u_id']?>&course=<?php echo $row['cf_id'] ?>'>Course</a>
										</td>
									<td style='border:1px solid black;padding:5pt;'>
										<center><button title='Delete' onClick='Delete(<?php echo $row['cf_id'] ?>);' style='padding-left: 2pt;background:none;border:none'><span class='reject'></span></button></center>
									</td>
								</tr>
								<tr>
									<td colspan='8'>
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
													<a href="finalAdmin.php?course=<?php echo $row['cf_id'] ?>"> <button class='myButton' style='margin-top:2pt;font-size:8pt;'>Final</button></a> | 
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
							echo "<tr><td colspan='8'><center>$error</center></td></tr>";
							?>
						</table>

					</div><!-- middle -->
					<?php
					if(isset($_GET['teacher']))
					{
						$teacher = "";
								//$batch = "";
								if($_GET['teacher'] != "Any")
								{
									$teacher = "WHERE  u_id = ".$_GET['teacher'];
								}
								/*if($_GET['batch'] != "Any")
								{
									$batch  = "AND batch = '".$_GET['batch']."'";
								} */
						$Query = "SELECT count(*) row FROM course_file $teacher ";
						$result = $database->query($Query);
						if( $row = mysqli_fetch_assoc($result)) 
						{
							if($row['row'] > 6 )
							{
								echo "<div><center>page ";
								for($i=0,$j=1;$i<=$row['row'];$i=$i+6,$j++)
								{
									echo "<a href='newCourseFile.php?item=$i&teacher=".$_GET['teacher']."'> $j </a>";
								}
								echo "</center></div>";
							}	
						}
					}
					else
					{
						$Query = "SELECT count(*) row FROM course_file";
						$result = $database->query($Query);
						if( $row = mysqli_fetch_assoc($result)) 
						{
							if($row['row'] > 6 )
							{
								echo "<div><center>page ";
								for($i=0,$j=1;$i<=$row['row'];$i=$i+6,$j++)
								{
									echo "<a href='newCourseFile.php?item=$i'> $j </a>";
								}
								echo "</center></div>";
							}	
						}
					}
					
					?>
					
				</div><!-- middle_right -->
			</div>
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
		<div id="popupc" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Deleteing Course File </div>
					   	<form action='../includes/CourseFileManagement/DeleteCourseFile.php' method='post'>
					   		<table>
					   		<tr>
					   			<td colspan='4'><center><h1 style='color:red;'>Warnning!</h1></center><br></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'><b>This operation can't undo.This will effects following</b></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'>1. Teachers and Students related to this Course.</td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'>2. Attdendance,Results,Files related to this course. </td>
					   		</tr>
					   		
					   		<tr>
					   			<td colspan='4'><br>Yes! I understand the risk and wish to continue  <input type='checkbox' id='checkbox'><br><br></td>
					   		</tr>
					   		<tr>
					   			<td colspan='2'><lable style='display:none' id='bp'>Your Password<lable></td>
					   			<td colspan='2'><input type='password'  style='display:none' id='pass' class='input-field' name='password'  pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}'  required  ></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'><input type='text' name='course' hidden id='course'><center><br><input style='display:none' type='submit' id='accept' class='myButton' value='Delete Course'></center></td>
					   		
					   		</tr>
					   		
					   		
					   			
					   			</table>
					   </form>
					   		
					   
						</div>
					</div>
					
  </body>
</html>