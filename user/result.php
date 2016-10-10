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
$reg_no = "";
$total = "";
?>
<!DOCTYPE html>
<html>
	<?php
			include("../includes/Utility/header.php");
		?>
		
		
	

	</head>
	<style type="text/css">
	
	</style>
	<script>
  $(function() {
    $( document ).tooltip();
  });
  </script>
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
					<?php } include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%'>
						<div class='title_middle' style='margin-bottom:0pt;'><h2>Final Result</h2><?php echo $message ?></div>
						
							<?php
							$total_glob = 0;
							$count_glob = 0;
							$print  	= "";
							$Error 		= "";
							$status 	= false;
							$total 		= 0;
							$obtained	= 0;
							$percent 	= 0;
							$quiz 		= false;
							$assignment	= false;
							$project 	= false;

							$Query_quiz  = "SELECT COUNT(*) no FROM quizzes WHERE cf_id =".$c_id."";
							$result_quiz = $database->query($Query_quiz);
							if($row_quiz = mysqli_fetch_assoc($result_quiz))
							{
								if ($row_quiz['no'] > 0) 
								{
									$quiz 		= true;
								}
							}
							$Queryassignment  = "SELECT COUNT(*) no FROM assignment WHERE cf_id =".$c_id."";
							$resultassignment = $database->query($Queryassignment);
							if($rowassignment = mysqli_fetch_assoc($resultassignment))
							{
								if ($rowassignment['no'] > 0) 
								{
									$assignment 		= true;
								}
							}
							$Query_project  = "SELECT COUNT(*) no FROM project WHERE cf_id =".$c_id."";
							$result_project = $database->query($Query_project);
							if($row_project = mysqli_fetch_assoc($result_project))
							{
								if ($row_project['no'] > 0) 
								{
									$project 		= true;
								}
							}
							$Query_final  = "SELECT *  FROM final WHERE cf_id =".$c_id."";
					        $result_final = $database->query($Query_final);
					        if($row_final = mysqli_fetch_assoc($result_final))
					        {  	
					        	$Query_midterm  = "SELECT *  FROM midterm WHERE cf_id =".$c_id."";
						        $result_midterm = $database->query($Query_midterm);
						        if($row_midterm = mysqli_fetch_assoc($result_midterm))
						        {  	
						        		$Query_file = "SELECT c_code FROM course_file WHERE cf_id =".$c_id."";
							        	$result_file = $database->query($Query_file);
							       		if($row_file = mysqli_fetch_assoc($result_file))
							       		{	

								       		$Query_course = "SELECT * FROM course WHERE c_code =".$row_file['c_code']."";
								        	$result_course = $database->query($Query_course);
								       		if($row_course = mysqli_fetch_assoc($result_course))
								       		{
									       		$Query_class = "SELECT * FROM class WHERE c_id =".$row_course['c_id']."";
									        	$result_class = $database->query($Query_class);
									       		if($row_class = mysqli_fetch_assoc($result_class))
									       		{ 

									       			$print .= "<center><h3><u>Final Result</u></h3></center>";
										        	$print .= "<b>Course Title :</b>".$row_course['c_title']."<br>";														
										        	$print .= "<b>Class :</b>".$row_class['programm_name']."<br>";
										        	$print .= "<b>Batch :</b>".$row_class['batch_name']."<br>";														
										        	$print .= "<b>Instructor Name :</b> ".$_SESSION["fname"]." ".$_SESSION["lname"]."<br>";
										        	$print .= "<br>";
										        	$print .= "<table style='max-width:107%;margin-top:2pt;font-size:8pt;'>";								
														$print .= "<tr>";
															$print .= "<td style='border:1px solid black;padding:5pt;width:95pt;' bgcolor='#948a54' rowspan='2'>";
																$print .= "<center>Registration #</center>";
															$print .= "</td >";
															$print .= "<td style='border:1px solid black;padding:5pt;max-width: 200pt;' bgcolor='#948a54'  rowspan='2'>";
																$print .= "<center>Name</center>";
															$print .= "</td >";
															if($quiz == true)
															{
																$print .= "<td style='border:1px solid black;'  bgcolor='#963634' colspan='2'><center>Quiz</center></td>";
															}
															if($assignment == true)
															{
																$print .= "<td style='border:1px solid black;'  bgcolor='#e26b0a' colspan='2'><center>Assignment</center></td>";
															}
															if($project == true)
															{
																$print .= "<td style='border:1px solid black;'  bgcolor='#76933c' colspan='2'><center>Project</center></td>";
															}
															$print .= "<td style='border:1px solid black;'  bgcolor='#31869b' colspan='2'><center>Midterm</center></td>";
															$print .= "<td style='border:1px solid black;'  bgcolor='#948a54' colspan='2'><center>Final</center></td>";
															$print .= "<td style='border:1px solid black;'  bgcolor='#963634' colspan='2'><center>Total</center></td>";
															
														$print .= "</tr>";
														$print .= "<tr>";
															$counter_marks_temp = 0;
															if($quiz == true)
															{
																$quiz_total_temp = "undefiend";
																$Query_class = "SELECT sum(q_total) total FROM quizzes WHERE  cf_id =".$c_id."";
													        	$result_class = $database->query($Query_class);
													       		if($row_class = mysqli_fetch_assoc($result_class))
													       		{
													       			$quiz_total_temp = $row_class['total'];
													       			$counter_marks_temp = $counter_marks_temp + $row_class['total'];
													       		}											
													       		$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;'  bgcolor='#da9694'><a href='#' title='total quizzes marks : ".$quiz_total_temp."'>Total</a></td>";
																$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'  bgcolor='#da9694'>%</td>";
															}
															if($assignment == true)
															{
																
																$quiz_total_temp = "undefiend";
																$Query_class = "SELECT sum(assign_total) total FROM assignment WHERE  cf_id =".$c_id."";
													        	$result_class = $database->query($Query_class);
													       		if($row_class = mysqli_fetch_assoc($result_class))
													       		{
													       			$quiz_total_temp = $row_class['total'];
													       			$counter_marks_temp = $counter_marks_temp + $row_class['total'];
													       		}	
																$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;'  bgcolor='#fabf8f'><a href='#' title='total assignemnts marks : ".$quiz_total_temp."'>Total</a></td>";
																$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'  bgcolor='#fabf8f'>%</td>";
															}
															if($project == true)
															{
																$quiz_total_temp = "undefiend";
																$Query_class = "SELECT sum(p_total) total FROM project WHERE  cf_id =".$c_id."";
													        	$result_class = $database->query($Query_class);
													       		if($row_class = mysqli_fetch_assoc($result_class))
													       		{
													       			$quiz_total_temp = $row_class['total'];
													       			$counter_marks_temp = $counter_marks_temp + $row_class['total'];
													       		}	
																$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;'  bgcolor='#c4d79b'><a href='#' title='total project marks : ".$quiz_total_temp."'>Total</a></td>";
																$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'  bgcolor='#c4d79b'>%</td>";
															}
															$quiz_total_temp = "undefiend";
															$Query_class = "SELECT sum(m_total) total FROM midterm WHERE  cf_id =".$c_id."";
													        $result_class = $database->query($Query_class);
													       	if($row_class = mysqli_fetch_assoc($result_class))
													       	{
													       		$quiz_total_temp = $row_class['total'];
													       		$counter_marks_temp = $counter_marks_temp + $row_class['total'];
													       	}
															$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;'  bgcolor='#92cddc'><a href='#' title='total midterm marks : ".$quiz_total_temp."'>Total</a></td>";
															$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'  bgcolor='#92cddc'>%</td>";
															$quiz_total_temp = "undefiend";
															$Query_class = "SELECT sum(f_total) total FROM final WHERE  cf_id =".$c_id."";
													        $result_class = $database->query($Query_class);
													       	if($row_class = mysqli_fetch_assoc($result_class))
													       	{
													       		$quiz_total_temp = $row_class['total'];
													       		$counter_marks_temp = $counter_marks_temp + $row_class['total'];
													       	}
															$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;'  bgcolor='#E1D492'><a href='#' title='total final marks : ".$quiz_total_temp."'>Total</a></td>";
															$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'  bgcolor='#E1D492'>%</td>";
															$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;'  bgcolor='#da9694'><a href='#' title='total marks : ".$counter_marks_temp."'>Total</a></td>";
															$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'  bgcolor='#da9694'>%</td>";
														$print .= "</tr>";
														$Query_course_student     = "SELECT *  FROM course_student WHERE c_id =".$c_id."";
													    $result_course_student    = $database->query($Query_course_student);
													    while($row_course_student = mysqli_fetch_assoc($result_course_student))
													    {
													    	$total_glob = 0;
															$count_glob = 0;
													    	$print .= "<tr>";
													      	$Query_student  = "SELECT * FROM student WHERE u_id =".$row_course_student['u_id']."";
														    $result_student = $database->query($Query_student);
															if($row_student = mysqli_fetch_assoc($result_student))
														    {
														    	$print .= "<td style='border:1px solid black;padding:5pt;' >".$row_student['Reg_no']."</td >";
														    }
														    else
														    {
														    	$print .= "<td style='border:1px solid black;padding:5pt;' >-------</td >";
														    }
														    $Query_user  = "SELECT * FROM user WHERE u_id =".$row_course_student['u_id']."";
													        $result_user = $database->query($Query_user);
													        if($row_user = mysqli_fetch_assoc($result_user))
													        {
													        	$print .= "<td style='border:1px solid black;padding:5pt;' >".$row_user['fname']." ".$row_user['lname']."</td >";
													        }
													        else
													        {
													        	$print .= "<td style='border:1px solid black;padding:5pt;' >-------</td >";
													        }
													        $Query_total  = "SELECT to_id FROM total WHERE u_id =".$row_course_student['u_id']."";
													        $result_total = $database->query($Query_total);
													        if($row_total = mysqli_fetch_assoc($result_total))
													        {
													        	if($quiz == true)
																{
															        $Query_quiz     = "SELECT q_id,q_total FROM quizzes WHERE cf_id =".$c_id."";
													        		$result_quiz    = $database->query($Query_quiz);
													        		while($row_quiz = mysqli_fetch_assoc($result_quiz))
													        		{
													        			$Query_quiz_marks = "SELECT marks FROM quiz_student WHERE q_id =".$row_quiz['q_id']." AND to_id=".$row_total['to_id']." ";
													        			$result_quiz_marks = $database->query($Query_quiz_marks);
													        			if($row_quiz_marks = mysqli_fetch_assoc($result_quiz_marks))
													        			{
													        				$obtained	= $obtained + $row_quiz_marks['marks'];
													        				$total_glob = $total_glob + $row_quiz_marks['marks'];
													        			}
													        			$total = $total + $row_quiz['q_total'];
													        			$count_glob = $count_glob + $row_quiz['q_total'];
													        		}
													        		$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;' >".$obtained."</td>";
													        		if($obtained > 0)
													        		{
													        			$percent = ($obtained/$total)*100;
													        		}
													        		$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'>".round( $percent, 1)."%</td>";
												        		}
												        		if($assignment == true)
																{
													        		$total 		= 0;
																	$obtained	= 0;
																	$percent 	= 0;
																	$Query_ass  = "SELECT assign_id,assign_total FROM assignment WHERE cf_id =".$c_id."";
													        		$result_ass = $database->query($Query_ass);
													        		while($row_ass = mysqli_fetch_assoc($result_ass))
													        		{
													        			$Query_ass_marks = "SELECT marks FROM assignment_student WHERE assign_id =".$row_ass['assign_id']." AND to_id=".$row_total['to_id']." ";
													        			$result_ass_marks = $database->query($Query_ass_marks);
													        			if($row_ass_marks = mysqli_fetch_assoc($result_ass_marks))
													        			{
													        				$obtained	= $obtained + $row_ass_marks['marks'];
													        				$total_glob = $total_glob + $row_ass_marks['marks'];
													        			}
													        			$total = $total + $row_ass['assign_total'];
													        			$count_glob = $count_glob + $row_ass['assign_total'];
													        		}
													        		$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;' >".$obtained."</td>";
													        		if($obtained > 0)
													        		{
													        			$percent = ($obtained/$total)*100;
													        		}
													        		$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'>".round( $percent, 1)."%</td>";
												        		}
												        		if($project == true)
																{
													        		$total 		= 0;
																	$obtained	= 0;
																	$percent 	= 0;
													        		$Query_project = "SELECT p_id ,p_total FROM project WHERE cf_id =".$c_id."";
													        		$result_project = $database->query($Query_project);
													        		while($row_project = mysqli_fetch_assoc($result_project))
													        		{
													        			$Query_project_marks  = "SELECT p_marks FROM total WHERE p_id =".$row_project['p_id']." AND to_id=".$row_total['to_id']." ";
													        			$result_project_marks = $database->query($Query_project_marks);
													        			if($row_project_marks = mysqli_fetch_assoc($result_project_marks))
													        			{
													        				$obtained	= $obtained + $row_project_marks['p_marks'];
													        				$total_glob = $total_glob + $row_project_marks['p_marks'];
													        			}
													        			$total = $total + $row_project['p_total'];
													        			$count_glob = $count_glob + $row_project['p_total'];
													        		}
													        		$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;' >".$obtained."</td>";
													        		if($obtained > 0)
													        		{
													        			$percent = ($obtained/$total)*100;
													        		}
													        		$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'>".round( $percent, 1)."%</td>";
												        		}
												        		$total 		= 0;
																$obtained	= 0;
																$percent 	= 0;
												        		$Query_midterm = "SELECT m_id,m_total FROM midterm WHERE cf_id =".$c_id."";
												        		$result_midterm = $database->query($Query_midterm);
												        		while($row_midterm = mysqli_fetch_assoc($result_midterm))
												        		{
												        			$Query_midterm_marks = "SELECT m_marks FROM total WHERE m_id =".$row_midterm['m_id']." AND to_id=".$row_total['to_id']." ";
												        			$result_midterm_marks = $database->query($Query_midterm_marks);
												        			if($row_midterm_marks = mysqli_fetch_assoc($result_midterm_marks))
												        			{
												        				$obtained	= $obtained + $row_midterm_marks['m_marks'];
												        				$total_glob = $total_glob + $row_midterm_marks['m_marks'];
												        			}
												        			$total = $total + $row_midterm['m_total'];
												        			$count_glob = $count_glob + $row_midterm['m_total'];
												        		}
												        		$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;' >".$obtained."</td>";
												        		if($obtained > 0)
												        		{
												        			$percent = ($obtained/$total)*100;
												        		}
												        		$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'>".round( $percent, 1)."%</td>";
												        		$total 		= 0;
																$obtained	= 0;
																$percent 	= 0;
												        		$Query_final = "SELECT f_id,f_total FROM final WHERE cf_id =".$c_id."";
												        		$result_final = $database->query($Query_final);
												        		while($row_final = mysqli_fetch_assoc($result_final))
												        		{
												        			$Query_final_marks = "SELECT f_marks FROM total WHERE f_id =".$row_final['f_id']." AND to_id=".$row_total['to_id']." ";
												        			$result_final_marks = $database->query($Query_final_marks);
												        			if($row_final_marks = mysqli_fetch_assoc($result_final_marks))
												        			{
												        				$obtained	= $obtained + $row_final_marks['f_marks'];
												        				$total_glob = $total_glob + $row_final_marks['f_marks'];
												        			}
												        			$total = $total + $row_final['f_total'];
												        			$count_glob = $count_glob + $row_final['f_total'];

												        		}
												        		$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;' >".$obtained."</td>";
												        		if($obtained > 0)
												        		{
												        			$percent = ($obtained/$total)*100;
												        		}
												        		$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'>".round( $percent, 1)."%</td>";
												        		$percent = 0;
												        			$obtained = 0;
												        			$total = 0;
												        		$print .= "<td style='border:1px solid black;padding:5pt;width:35pt;' >".$total_glob."</td>";
												        		$total_glob = ($total_glob/$count_glob)*100;
												        		$print .= "<td style='border:1px solid black;padding:5pt;width:10pt;width:45pt;'>".round( $total_glob, 1)."%</td>";
														    $print .= "</tr>";
														   	}
														}
													$print .= "</table>";
								       			
								       			}

							       			} 
							       		}
								}
								else
								{
									$Error .="<h2>Midterm Paper Result</h2><br>";
									$status = true;
								}							
							}
							else
							{	
								$Query_midterm  = "SELECT *  FROM midterm WHERE cf_id =".$c_id."";
						        $result_midterm = $database->query($Query_midterm);
						        if($row_midterm = mysqli_fetch_assoc($result_midterm))
						        {  	
						        	
								
								}
								else
								{
									$Error .="<h2>Midterm Paper Result</h2>";
									$status = true;
								}

								$Error .="<h2>Final Paper Result</h2><br>";
								$status = true;
							}
							if($status == true)
							{
							
							$print .= "<center>";
								$print .= "<h2 style='margin-top:5pt;margin-bttom:5pt'>To Generate Final Result You Must Add</h2><br>";
								$print .= $Error;
								$print .= "<a href='courseFile.php'><input type='button' value='Back' class='myButton'   style='margin-left:10pt;'></a>";
							$print .= "</center>";
							
							}
							echo $print;
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
