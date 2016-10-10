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
		<script type="text/javascript">
		
		$(document).ready(function()
			{
				$("#course").change(function() 
				{ 
					var course = $('#course').val();
					if(course=="")
					{
						$("#disp").html("<center><h3>Please select a course from above drop down menue</h3></center>");
					}
					else
					{
						$.ajax(
						{
							type: "POST",
							url: "../includes/CourseManagement/getCourse.php",
							data: "course="+ course ,
							success: function(html)
							{
								$("#disp").html(html);
								$("#checkbox").click(function(){
							    	if( $(this).is(':checked')) {
							    	    $("#accept").show();	
							    	    $('#u_id').val('<?php echo $_SESSION["user"] ?>');
							    	    
							    	}
							    	else
							    	{
							    		 $("#accept").hide();
							    	}
							    });
							}
						});
					
					}
				});
				
			});
		function blinker() {
		    $('.blink_me').fadeOut(500);
		    $('.blink_me').fadeIn(500);
		}

		setInterval(blinker, 1000);
		
		function Delete(id){
			$('#sr_id_detele').val(id);
			$('#popupb').bPopup({
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
						<a href="courseFile.php">
						<div class='item_nav_left'>Course File Management</div>
						<div class='icon_nav_left'><span class='manage_meeting'></span></div>
						</a>
					</div>
					<div class='nav_left' style='background-color: #E1E2E3;'>
						
						<div class='item_nav_left' style='background-color: #E1E2E3;'>Course Request</div>
						<div class='icon_nav_left' style='background-color: #E1E2E3;'><span class='account_request'></span></div>
						
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
					<div class='nav_left' style='background-color: #E1E2E3;'>
						
						<div class='item_nav_left' style='background-color: #E1E2E3;'>Add Course</div>
						<div class='icon_nav_left' style='background-color: #E1E2E3;'><span class='course'></span></div>
						
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
					<div class='middle' style='width:100%'>
						<div class='title_middle' style='margin-bottom: 2pt'><h2>Add Course<span title='requests will recieve only by to revelent course teacher' class='blink_me'>!</span></h2> <?php echo $message ?></div>
						<div style='width:100%;border:2px solid #E1E2E3;height:30pt; margin-bottom:2pt;'>
							<?php
							$counter = 0; 
							$Query_student_request = "SELECT *  FROM student_request WHERE u_id= ".$_SESSION["user"]." ";
							$result_student_request = $database->query($Query_student_request);
							while($row_student_request= mysqli_fetch_assoc($result_student_request))
							{
								$Query_course = "SELECT * FROM course WHERE c_code = ".$row_student_request['c_code']." ";
					       		$result_course = $database->query($Query_course);
								if ( $row_course = mysqli_fetch_assoc($result_course))
								{
									$counter = $counter + $row_course['c_hours']; 	
								}
							}
							$Query_course_student = "SELECT *  FROM course_student WHERE u_id= ".$_SESSION["user"]." ";
							$result_course_student = $database->query($Query_course_student);
							while($row_course_student= mysqli_fetch_assoc($result_course_student))
							{
								$Query_course_file = "SELECT * FROM course_file WHERE cf_id  = ".$row_course_student['c_id']."";
						       	$result_course_file = $database->query($Query_course_file);
								if($row_course_file= mysqli_fetch_assoc($result_course_file))
								{
									$Query_course = "SELECT * FROM course WHERE c_code = ".$row_course_file['c_code']." ";
						       		$result_course = $database->query($Query_course);
									if ( $row_course = mysqli_fetch_assoc($result_course))
									{
										$counter = $counter + $row_course['c_hours']; 	
									}
								}
							}
							if($counter <= 21)
							{
							?>
							<div class='form-style-2' style='margin-top:-14.5pt;max-width: none;'>
								Select Course : 
								<select id='course' style='width: 89.3%;height:25pt;' class="select-field">
									<option></option>
									<?php
									$error = "";
									$print = "";
									$name = "";
									$Query_course = "SELECT * FROM course ORDER BY c_title ASC";
					       			$result_course = $database->query($Query_course);
									while ( $row_course = mysqli_fetch_assoc($result_course))
									{
										$Query_course_file = "SELECT * FROM course_file WHERE c_code  = ".$row_course['c_code']."";
						       			$result_course_file = $database->query($Query_course_file);
										while($row_course_file= mysqli_fetch_assoc($result_course_file))
										{
											$Query_course_student = "SELECT count(*) as no FROM course_student WHERE c_id  = ".$row_course_file['cf_id']." AND u_id= ".$_SESSION["user"]." ";
							       			$result_course_student = $database->query($Query_course_student);
											if($row_course_student= mysqli_fetch_assoc($result_course_student))
											{
												if($row_course_student['no'] == 0)
												{

													$Query_student_request = "SELECT count(*) as no FROM student_request WHERE c_code  = ".$row_course['c_code']." AND u_id= ".$_SESSION["user"]." ";
									       			$result_student_request = $database->query($Query_student_request);
													if($row_student_request= mysqli_fetch_assoc($result_student_request))
													{
														if($row_student_request['no'] == 0)
														{
															$teacher = $row_course_file['u_id'];
															$Query_user = "SELECT * FROM user WHERE u_id = {$teacher}";
											       			$result_user = $database->query($Query_user);
															if($row_user= mysqli_fetch_assoc($result_user))
															{
																$name 	= $row_user['fname']." ".$row_user['lname'];
															}
															$print .= "<option value='".$row_course['c_code']."'><span style='color:red'>".$row_course['c_title']." Program : ".$row_course['program'].", Batch : ".$row_course['batch'].", Taught by : ".$name."</option>";
														}
													}
												}
											}
										}
										
									}
									echo $print;
									
									?>
								</select>
								
							</div>
							<?php  echo $error; ?>
							<div id='disp'><center><h3>Please select a course from above drop down menue</h3></center></div>
						</div>
									<?php } 
									else
									{
										echo "<center><h3>You are enroled in maximum credit hours offerd by University</h3></center>";
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