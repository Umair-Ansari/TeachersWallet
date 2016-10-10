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
$panel = "style='height: 1635pt;'";
$left = "style='height:1633;'";
$user = $_SESSION["user"];
$course = $_GET['course'];
$Query_course_student = "SELECT course  FROM course_student WHERE u_id =".$_SESSION["user"]." AND c_id =".$_GET['course']." ";
$result_course_student = $database->query($Query_course_student);
if($row_course_student = mysqli_fetch_assoc($result_course_student))
{
	if($row_course_student['course'] != 0)
	{
		$message = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Evaluation Already Submited!</div>";
		$block = 'display:none';
		$left = "";
		$panel = "";
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
   				 width: 90%;
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
			<div class='panel' <?php echo  $panel ?> >
				<div class='left' style'height:100%' >
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
							
							<form action='../includes/Evaluation/CourseEvaluation.php' method='post'>

							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Course Content and Organization 
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
									1.	The course objectives were clear
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='A' value='5' required >
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
									2.	The Course workload was manageable
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
									3.	The Course was well organized (e.g. timely access to materials, notification of changes, etc.)
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
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									4. Comments 
									<input type='text' required name='com_a' class='input-field' value='none'style='width:90%;'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Student Contribution  
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
									5.	Approximate level of your own attendance during the whole Course 
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='D' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='D' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='D' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='D' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='D' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									6.	I participated actively in the Course.
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
									7.	I think I have made progress in this Course
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
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									8. Comments 
									<input type='text' required name='com_b' class='input-field' value='none'style='width:90%;'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Learning Environment and Teaching Methods 
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
									9. I think the Course was well structured to achieve the learning outcomes (there was a good balance of lectures, tutorials, practical etc.) 
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
									10.	The learning and teaching methods encouraged participation.
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
									11.	The overall environment in the class was conducive to learning.
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
									12.	Classrooms were satisfactory
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
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									13. Comments 
									<input type='text' required name='com_c' class='input-field' value='none'style='width:89%;'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Learning Resources 
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
									14.	Learning materials (Lesson Plans, Course Notes etc.) were relevant and useful.
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
									15.	Recommended reading Books etc. were relevant and appropriate
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
									16.	The provision of learning resources in the library was adequate and appropriate
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
									17.	The provision of learning resources on the Web was adequate and appropriate ( if relevant)
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
							<tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									18. Comments 
									<input type='text' required name='com_d' class='input-field' value='none'style='width:89%;'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Quality of Delivery
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
									19.	The Course stimulated my interest and thought on the subject area
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
									20.	The pace of the Course was appropriate
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
									21.	Ideas and concepts were presented clearly
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
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									22. Comments 
									<input type='text' required name='com_e' class='input-field' value='none'style='width:89%;'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Assessment
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
									23.	The method of assessment were reasonable 
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
									24.	Feedback on assessment was timely
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
								
								<td style='border:1px solid black;padding:5pt;'>
									25.	Feedback on assessment was helpful
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='T' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='T' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='T' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='T' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='T' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									26. Comments 
									<input type='text' required name='com_f' class='input-field' value='none'style='width:89%;'>
								</td>
							</tr>

								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									<b>Additional Core Questions</b> 
								</td>
								
								
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Instructor / Teaching Assistant Evaluation
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
									27.	I understood the lectures
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='U' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='U' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='U' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='U' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='U' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									28.	The material was well organized and presented
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='V' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='V' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='V' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='V' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='V' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									29.	The instructor was responsive to student needs and problems
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='W' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='W' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='W' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='W' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='W' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									30.	Had the instructor been regular throughout the course?
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='X' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='X' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='X' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='X' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='X' value='1'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Tutorial
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
									31.	The material in the tutorials was useful
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Y' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Y' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Y' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Y' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Y' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									32.	I was happy with the amount of work needed for tutorials
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Z' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Z' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Z' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Z' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='Z' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									33.	The tutor dealt effectively with my problems
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='AA' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='AA' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='AA' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='AA' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='AA' value='1'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;'>
									Practical / Practice
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
									34.	The material in the practicals / practice (like assignments, labs, etc) was useful
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='BB' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='BB' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='BB' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='BB' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='BB' value='1'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									35.	The demonstrators dealt effectively with my problems
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='1'>
								</td>
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									Overall Evaluation 
								</td>
								
								
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									36.	The best features of the Course were:
										<textarea required name='com_g' style='width: 904px; height: 32px;'></textarea>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									37.The Course could have been improved by:
										<textarea required name='com_h' style='width: 904px; height: 32px;'></textarea>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;'>
									38.	The demonstrators dealt effectively with my problems
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='5' required>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='4'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									<input type='radio' name='CC' value='1'>
								</td>
							</tr>
							
						</table>
						<table style='width:100%;margin-top:2pt;<?php echo $block ?>'>
							<tr>
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									<b>Equal Opportunities Monitoring (Optional)</b><br>
									The University does not tolerate discrimination on any irrelevant distinction (e.g. race, age, gender) and is committed to work with diversity in a wholly positive way. Please indicate below anything in relation to this Course which may run counter to this objective:
								</td>
								
								
							</tr>
							<tr style="background-color:rgb(212, 206, 206)">
								
								<td style='border:1px solid black;padding:5pt;' colspan='6'>
									Demographic Information: (Optional) 
								</td>
								
								
								
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='4'>
									39.	Full/part time study:
								</td>
								
								
								
								<td style='border:1px solid black;padding:5pt;width: 70pt;'>
									Full Time <input type='radio' name='DD' value='1'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 72pt;' >
									Part Time <input type='radio' name='DD' value='2'>
								</td>
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='4'>
									40.	Do you consider yourself to be disabled:
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;'>
									Yes <input type='radio' name='EE' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;' >
									No <input type='radio' name='EE' value='1'>
								</td>
							</tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='4'>
									41.	Gender:
								</td>
								
								<td style='border:1px solid black;padding:5pt;width: 20pt;' >
									Male <input type='radio' name='FF' value='1'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;' >
									Female <input type='radio' name='FF' value='2'>
								</td>
							</tr>

								
							<tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='3'>
									42.	Age Group:
								</td>
								
								
								<td style='border:1px solid black;padding:5pt;width: 82pt;' >
									less than 22  <input type='radio' name='GG' value='3'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 54pt;'>
									22-29    <input type='radio' name='GG' value='2'>
								</td>
								<td style='border:1px solid black;padding:5pt;width: 20pt;' >
									over 29 <input type='radio' name='GG' value='1'>
								</td>
								
							</tr>
							<tr>
								
								<td style='border:1px solid black;padding:5pt;' colspan='4'>
									43.	Campus:
								</td>
								
								
								<td style='border:1px solid black;padding:5pt;width: 200pt;' colspan='2'>
									Distance Learning/ Collaborative <input type='radio' name='HH' value='1'>
								</td>
							</tr>
							<tr>
								<input type='text' hidden value='<?php echo $user ?>' name='user' ><input type='text'  hidden  value='<?php echo $course ?>' name='course' >
								<td colspan='6'><br><center><input type='submit' value='Submit' class='myButton' <?php echo $block?>></center></td>
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