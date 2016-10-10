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
			
if($role != "Teacher")
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
		<script src="http://dinbror.dk/bpopup/assets/jquery.bpopup-0.9.4.min.js"></script>
		<script src="http://dinbror.dk/bpopup/assets/jquery.easing.1.3.js"></script>
		<script type="text/javascript">
		function upload(id){
			
			
			$('#schem').val(id);
			 	$('#best').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		function upload2(id){
			
			
			$('#break').val(id);
			 	$('#pop').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
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
									Students
								</td>
							</tr>
							<?php
							$user = $_SESSION["user"];
							$error = "<h2>No Course Found.Please Contact Your Administration.</h2>";
							$Query = "SELECT * FROM course_file WHERE u_id = $user ";
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
										<?php if(is_dir("../includes/CourseFileManagement/course_files/scheme_of_study/".$row['cf_id']."")){$dir = "../includes/CourseFileManagement/course_files/scheme_of_study/".$row['cf_id']."";$files = scandir($dir, 0);for($i = 2; $i < count($files); $i++)echo "<a href='../includes/CourseFileManagement/course_files/scheme_of_study/".$row['cf_id']."/".$files[$i]."' target='_blank'>Download</a>";} else {echo "<button style='background=none;border:none;' onClick=upload(".$row['cf_id'].");>Upload</button>";}  ?>
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										<?php if(is_dir("../includes/CourseFileManagement/course_files/break_out/".$row['cf_id']."")){$dir = "../includes/CourseFileManagement/course_files/break_out/".$row['cf_id']."";$files = scandir($dir, 0);for($i = 2; $i < count($files); $i++)echo "<a href='../includes/CourseFileManagement/course_files/break_out/".$row['cf_id']."/".$files[$i]."' target='_blank'>Download</a>";} else {echo "<button style='background=none;border:none;' onClick=upload2(".$row['cf_id'].");>Upload</button>";}  ?>
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
									<td style='border:1px solid black;padding:5pt;'>
										<a href='students.php?course=<?php echo $row['cf_id']?>'>View</a>
									</td>
								</tr>
								<tr>
									<td colspan='6'>
										<center>
										<table>
											<tr>
												<td>
													<a href="attendance.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Attendance</button></a> | 
												</td>
												<td style='padding-left:2pt;'>
												<td>
													<a href="notes.php?course=<?php echo $row['cf_id'] ?>&action=View"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Notes</button></a> | 
												</td>
												<td style='padding-left:2pt;'>
													<a href="midterm.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Midterm</button></a> | 
												</td>
												<td style='padding-left:2pt;'>
													<a href="project.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Project</button></a> | 
												</td>
												<td style='padding-left:2pt;'>
													<a href="assignment.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Assignment</button></a> | 
												</td>
												<td style='padding-left:2pt;'>
													<a href="quiz.php?course=<?php echo $row['cf_id'] ?>"><button class='myButton' style='margin-top:2pt;font-size:8pt;'>Quiz</button></a> | 
												</td>
												<td style='padding-left:2pt;'>
													<a href="final.php?course=<?php echo $row['cf_id'] ?>"> <button class='myButton' style='margin-top:2pt;font-size:8pt;'>Final</button></a> | 
												</td>
												<td style='padding-left:2pt;'>
													<a href="result.php?course=<?php echo $row['cf_id'] ?>"> <button class='myButton' style='margin-top:2pt;font-size:8pt;'>Result</button></a>
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
							echo "<tr><td colspan='5'><center>$error</center></td></tr>";
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
					<div id="best" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Add Scheme Of Study</div>
					   	<form action='../includes/CourseFileManagement/AddSchemFile.php' method='post' enctype='multipart/form-data'>
					   		
					   		<table>
					   			<tr>
					   			<td><b>Scheme of study</b></td>
					   			<td style='padding-left:5pt'><input type='file' name='file' required class="input-field"  accept="image/*"/></td>
					   		</tr>
					   		<tr>
					   			<input hidden type='text' id='schem' name='course' />
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Upload'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					</div>
					<div id="pop" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Add Break Out</div>
					   	<form action='../includes/CourseFileManagement/AddBreakFile.php' method='post' enctype='multipart/form-data'>
					   		
					   		<table>
					   			<tr>
					   			<td><b>Break Out</b></td>
					   			<td style='padding-left:5pt'><input type='file' name='file' required class="input-field" accept="image/*"/></td>
					   		</tr>
					   		<tr>
					   			<input  hidden type='text' id='break' name='course' />
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Upload'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					</div>
  </body>
</html>