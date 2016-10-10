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
$block = "";
$user = $_SESSION["user"];
$course = $_GET['course'];
$Query_course_student = "SELECT teacher  FROM course_student WHERE u_id =".$_SESSION["user"]." AND c_id =".$_GET['course']." ";
$result_course_student = $database->query($Query_course_student);
if($row_course_student = mysqli_fetch_assoc($result_course_student))
{
	if($row_course_student['teacher'] != 0)
	{
		$message = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Evaluation Already Submited!</div>";
		$block = 'display:none';
	}
}
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
			<div class='panel' style='height: 700pt;'>
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
					<div class='middle' style='width:100%;'>
						<div class='title_middle' style='margin-bottom: 0pt;'><h2>Teacher Evaluation</h2> <?php echo $message ?></div>
							<?php
							$name = "";
							$Query_user = "SELECT *  FROM user WHERE u_id =".$_GET['u_id']."";
							$result_user = $database->query($Query_user);
							if($row_user = mysqli_fetch_assoc($result_user))
							{
								$name = $row_user['fname']." ".$row_user['lname'];
							}
							?>
							<h3>Teacher Name : <?php echo $name; ?></h3><br><br>
							<b>Use the scale to answer the following questions below and make comments</b><br><br>
							<b>A:</b> Strongly Agree &nbsp;&nbsp;<b>B:</b> Agree 	&nbsp;&nbsp;<b>C:</b> Uncertain	&nbsp;&nbsp;	 <b>D:</b> Disagree	&nbsp;&nbsp; <b>E:</b> Strongly Disagree<br><br>

						<table style='width:100%;margin-top:2pt;<?php echo $block ?>'>
							
							<form action='../includes/Evaluation/TeacherEvaluation.php' method='post'>

							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Instructor:
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									A
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									B
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									C
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									D
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									E
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									1.	The Instructor is prepared for each class
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='A' value='5' required  >
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='A' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='A' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='A' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='A' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									2.	The Instructor demonstrates knowledge of the subject
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='B' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='B' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='B' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='B' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='B' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									3.	The Instructor has completed the whole course
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='C' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='C' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='C' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='C' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='C' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									4.	The Instructor provides additional material apart from the textbook
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='E' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='E' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='E' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='E' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='E' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									5.	The Instructor gives citations regarding current situations with reference to Pakistani context.
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='F' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='F' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='F' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='F' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='F' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									6.	The Instructor communicates the subject matter effectively
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='G' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='G' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='G' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='G' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='G' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									7.	The Instructor shows respect towards students and encourages class participation
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='H' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='H' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='H' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='H' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='H' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									8.	The Instructor maintains an environment that is conducive to learning
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='I' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='I' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='I' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='I' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='I' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									9.	The Instructor arrives on time 
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='J' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='J' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='J' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='J' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='J' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									10.	The Instructor leaves on time
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='K' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='K' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='K' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='K' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='K' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									11.	The Instructor is fair in examination
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='L' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='L' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='L' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='L' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='L' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									12.	The Instructor returns the graded scripts etc. in  a reasonable amount of time
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='M' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='M' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='M' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='M' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='M' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									13.	The Instructor was available during the specified office hours and for after class consultations
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='N' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='N' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='N' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='N' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='N' value='1'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									Course:
								</td>
								
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									14.	The Subject matter presented in the course has increased your knowledge of the subject
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='O' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='O' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='O' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='O' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='O' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									15.	The syllabus clearly states course objectives requirements, procedures and grading criteria
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='P' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='P' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='P' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='P' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='P' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									16.	The course integrates theoretical course concepts with real-world applications
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Q' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Q' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Q' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Q' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Q' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									17.	The assignments and exams covered the materials presented in the course
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='R' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='R' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='R' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='R' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='R' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									18.	The course material is modern and updated
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='S' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='S' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='S' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='S' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='S' value='1'>
								</td>
							</tr>
							<tr>
								<input type='text' hidden value='<?php echo $user ?>' name='user' ><input type='text'  hidden  value='<?php echo $course ?>' name='course' >
								<td colspan='5'><br><center><input type='submit' value='Submit' class='myButton' <?php echo $block?> ></center></td>
							</tr>
							</form>
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