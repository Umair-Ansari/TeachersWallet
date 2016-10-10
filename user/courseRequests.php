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
		
		function blinker() {
		    $('.blink_me').fadeOut(500);
		    $('.blink_me').fadeIn(500);
		}

		setInterval(blinker, 1000);
		function accept(reg,name,email,prog,course,id){
			$('#reg').html(reg);
			$('#name').html(name);
			$('#email').html(email);
			$('#prog').html(prog);
			$('#course').html(course);
			$('#sr_id').val(id);

			$('#popup').bPopup({
    			easing: 'easeOutBack', //uses jQuery easing plugin
    	    	speed: 450,
    	    	transition: 'slideDown'
    		});
		}
		function Delete(id){
			$('#sr_id_detele').val(id);
			$('#popupb').bPopup({
    			easing: 'easeOutBack', //uses jQuery easing plugin
    	    	speed: 450,
    	    	transition: 'slideDown'
    		});
		}
		$(document).ready(function(){
			$(function() {
			    $( document ).tooltip();
			  });
			$("#checkbox").click(function(){
		    	if( $(this).is(':checked')) {
		    	     $("#accept").show();
		    	    
		    	}
		    	else
		    	{
		    		 $("#accept").hide();
		    	}
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
					<div class='nav_left'>
						<a href="addCourse.php">
						<div class='item_nav_left'>Add Course</div>
						<div class='icon_nav_left'><span class='course'></span></div>
						</a>
					</div>
					<div class='nav_left' style='background-color: #E1E2E3;'>
						
						<div class='item_nav_left' style='background-color: #E1E2E3;'>Course Requests</div>
						<div class='icon_nav_left' style='background-color: #E1E2E3;'><span class='course_request'></span></div>
						
					</div>
					<?php
					}
					 include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%'>
						<div class='title_middle' style='margin-bottom: 2pt'><h2>Course Request <span title='requests will recieve only by to revelent course teacher' class='blink_me'>!</span></h2> <?php echo $message ?></div>
						
						<div style='width:100%;border:2px solid #E1E2E3;height:426pt;padding:6pt -5pt 0pt 0pt;'>
							<table style='width:100%'>
							
								<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;'>
										Subject Name
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Credit Hours
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Program
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Batch
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Teacher Name
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Teacher's Email
									</td >
									
									<td style='border:1px solid black;padding:5pt;'>
										Cancel
									</td>
								</tr>
								<?php
								$program = "";
								$batch = "";
								$print = "";
								$error = "<tr><td colspan='7'  style='border:1px solid black;padding:5pt;'><center>No Request Found!</center></td></tr>";
								$user = $_SESSION["user"];
								$teacher = "";
								$Query_student_request = "SELECT * FROM student_request WHERE u_id = {$user}";
					       		$result_student_request = $database->query($Query_student_request);
								while ( $row_student_request= mysqli_fetch_assoc($result_student_request)) 
									{	
										$error = "";
										$print .= "<tr>";
										$Query_course_file = "SELECT * FROM course_file WHERE c_code  = ".$row_student_request['c_code']."";
						       			$result_course_file = $database->query($Query_course_file);
										if($row_course_file= mysqli_fetch_assoc($result_course_file))
										{
											$teacher = $row_course_file['u_id'];
										}
										$Query_user = "SELECT * FROM user WHERE u_id = {$teacher}";
						       			$result_user = $database->query($Query_user);
										if($row_user= mysqli_fetch_assoc($result_user))
										{
											$name 	= $row_user['fname']." ".$row_user['lname'];
											$email 	= $row_user['email'];
										}
										$Query_course  = "SELECT * FROM course WHERE c_code  = ".$row_student_request['c_code']."";
						       			$result_course  = $database->query($Query_course );
										if($row_course = mysqli_fetch_assoc($result_course ))
										{
											$wants 	= $row_course['c_title']."";
											$c_hours  =$row_course['c_hours'];
											$program 	= $row_course['program']."";
											$batch  =$row_course['batch'];
										} ?>
											<td style='border:1px solid black;padding:5pt;'><?php echo $wants ?></td>
											<td style='border:1px solid black;padding:5pt;'><?php echo $c_hours ?></td>
											<td style='border:1px solid black;padding:5pt;'><?php echo $program ?></td>
											<td style='border:1px solid black;padding:5pt;'><?php echo $batch ?></td>
											<td style='border:1px solid black;padding:5pt;'><?php echo $name ?></td>
											<td style='border:1px solid black;padding:5pt;'><?php echo $email ?></td>
											<td style='border:1px solid black;padding:5pt;'><center><button title='Cancel' onClick="Delete(<?php echo $row_student_request['sr_id']?>);" style='padding-left: 2pt;background:none;border:none'><span class='reject'></span></button></center></td>
										</tr>
									<?php	
								}
								if($error != "flase")
								{
									echo $error;
								}
									
																
								
								?>
							
							</table>
							
							

						</div>
						
					</div><!-- middle -->
					
				</div><!-- middle_right -->
			</div>
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
					<div id="popup" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Accepting Student Request For Subjects</div>
					   	<form action='../includes/CourseManagement/AcceptStudentRequest.php' method='post'>
					   		<table>
					   		<tr>
					   			<td colspan='4'><center><h1 style='color:red;'>Warnning!</h1></center><br></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'><b>This operation can't undo</b></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'>1. You must know student by self.</td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'>2. Adding wrong student in subject can cause result problem latter</td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'>3. Onece student beocome part of a subject you will not be able to chnage it.<br><br></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'><center><h3><b>Student Details</b></h3></center></td>
					   		</tr>
					   		<tr>
					   			<td><b>Registration #</b></td>
					   			<td conspan='3' id='reg'></td>
					   		</tr>
					   		<tr>
					   			<td><b>Name</b></td>
					   			<td id='name'></td>
					   			<td><b>Email</b></td>
					   			<td id='email'></td>
					   		</tr>
					   		<tr>
					   			<td><b>Program</b></td>
					   			<td id='prog'></td>
					   			<td><b>Course</b></td>
					   			<td id='course'></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'><br><b>Are you still wish to continue?</b></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'>Yes! I understand the risk and wish to continue  <input type='checkbox' id='checkbox'><br><br></td>
					   		</tr>
					   		<tr>
					   			<td colspan='4'><input type='text' name='sr_id' hidden id='sr_id'><center><input style='display:none' type='submit' id='accept' class='myButton' value='Accept'></center></td>
					   		
					   		</tr>
					   		
					   		
					   			
					   			</table>
					   </form>
					   		
					   
						</div>
					</div>
					<div id="popupb" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
					   <form action='../includes/CourseManagement/CancelStudentRequest.php' method='post'>
					   		<table>
					   		
					   			
					   			
					   				
					   							   		
					   		<tr>
					   			<td colspan='4'><center><b>Are You Sure!</b><br><br></center> </td>
					   		</tr>
					   		<tr>
					   			
					   			<td colspan='4'><center><input type='text' name='sr_id' hidden id='sr_id_detele'><input type='submit' class='myButton' value='Delete'></center></td>
					   		</tr>
					   		</table>
					   </form>
						</div>
					   </div>
  </body>
</html>