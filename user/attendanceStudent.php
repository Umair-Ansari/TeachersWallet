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
			
if($role == "Teacher")
{
	header("Location: index.php");
}
$month = date("Y-m");
if(isset($_GET['month']))
{
	$str = (explode("/",$_GET['month']));
    $month  = $str[1]."-".$str[0];
	
}
?>
<!DOCTYPE html>
<html>
	<?php
			include("../includes/Utility/header.php");
		?>
		<style>
			.form-style-2 input.input-field {
   				 width: 50pt;
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
		function update(user,date,status,fname,lname,reg_no,att_id){
			
			$('#u_id').html(user);
			$('#update_status').val(status);
			$('#date').html(date);
			$('#fname').html(fname);
			$('#lname').html(lname);
			$('#reg_no').html(reg_no);
			$('#att_id').val(att_id);
    	 	$('#popup').bPopup({
    			easing: 'easeOutBack',
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
				<div class='middle_right' style='width: 78%;'>
					<div class='middle' style='width:100%;overflow:scroll;'>
						<div class='title_middle' style='margin-bottom:0pt;'><h2><div class="form-style-2" style='max-width: 630px;'><form action='attendanceStudent.php'><lable style='font-size:12pt;'>Attendance</lable> Month : <input type="text" name='month' id="month" value='<?php echo date("m/Y") ?>' class='input-field'> <input type='text' value='<?php echo $c_id ?>' name='course' hidden><input type='submit'  value='View' class='myButton'></form></div></h2><?php echo $message ?></div>
						<table style='width:100%;margin-top:2pt;'>
							<col width='100'>
							
							<?php
							$Query1 = "SELECT *  FROM course_student WHERE c_id =".$c_id."";
					        $result1 = $database->query($Query1);
					        if($row1 = mysqli_fetch_assoc($result1))
					        {
					        	$Query2 = "SELECT * FROM user WHERE u_id =".$row1['u_id']."";
						        $result2 = $database->query($Query2);
						        if($row2 = mysqli_fetch_assoc($result2))
						        { ?>
							    	<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;'>
										Name
									</td >
									<?php
									for ($i=1; $i <=date('t') ; $i++) 
									{ 
										if($i <= 9)
								 		{
								 			$i = "0".$i;
								 		}
								 		
										$Query = "SELECT count(*) count  FROM attendance WHERE cf_id =".$c_id." AND u_id = ".$row1['u_id']." AND a_date like '".$month."-".$i."' ";
						       			$result = $database->query($Query);
										if ( $row = mysqli_fetch_assoc($result)) 
										{	
											if($row['count'] >1)
											{

												for($j=1;$j<=$row['count'];$j++)
												{
													echo "<td style='border:1px solid black;padding:5pt;'>$i</td>";
												}
											}
											else
											{
												echo "<td style='border:1px solid black;padding:5pt;'>$i</td>";
											}
											
										}
									}
								}
							}
							$error = "<h2>No Students related with this course</h2>";
							$user = $_SESSION["user"];
							$Query1 = "SELECT *  FROM course_student WHERE c_id =".$c_id." AND u_id = $user ";
							if($role == "Admin")
							{
								$Query1 = "SELECT *  FROM course_student WHERE c_id =".$c_id." ";
							}
					        $result1 = $database->query($Query1);
					        while($row1 = mysqli_fetch_assoc($result1))
					        {
					        	$Query2 = "SELECT * FROM user WHERE u_id =".$row1['u_id']."";
						        $result2 = $database->query($Query2);
						        if($row2 = mysqli_fetch_assoc($result2))
						        { 
									for ($i=1; $i <=date('t') ; $i++) 
									{ 
										if($i <= 9)
								 		{
								 			$i = "0".$i;
								 		}
								 		//$month = date("m");
										$Query = "SELECT count(*) count  FROM attendance WHERE cf_id =".$c_id." AND u_id = ".$row1['u_id']." AND a_date like '".$month."-".$i."' ";
						       			$result = $database->query($Query);
										if ( $row = mysqli_fetch_assoc($result)) 
										{	
											if($row['count'] >1)
											{

												for($j=1;$j<=$row['count'];$j++)
												{
													//echo "<td style='border:1px solid black;padding:5pt;'>$i</td>";
												}
											}
											else
											{
												//echo "<td style='border:1px solid black;padding:5pt;'>$i</td>";
											}
											
										}
									}
								?>
								
							</tr>
					        	<tr>
					       			<td style='border:1px solid black;padding:5pt;'>
									<?php echo $row2['fname'];?>
									</td>


					        <?php
							 for($i=1;$i<=date('t');$i++)
							{
								$Query_reg = "SELECT reg_no FROM student WHERE u_id =".$row1['u_id']."";
						        $result_reg = $database->query($Query_reg);
						        $row_reg = mysqli_fetch_assoc($result_reg);

							 	if($i <= 9)
							 	{
							 		$i = "0".$i;
							 	}
							 	//$month = date("m");
								$Query = "SELECT *  FROM attendance WHERE cf_id =".$c_id." AND u_id = ".$row1['u_id']." AND a_date like '".$month."-".$i."' ";
					       		$result = $database->query($Query);
								if ( $row = mysqli_fetch_assoc($result)) 
								{
									$Query = "SELECT count(*) count  FROM attendance WHERE cf_id =".$c_id." AND u_id = ".$row1['u_id']." AND a_date like '".$month."-".$i."' ";
					       			$result = $database->query($Query);
									if ( $row = mysqli_fetch_assoc($result)) 
									{	
										if($row['count'] >1)
										{
											$Query = "SELECT * FROM attendance WHERE cf_id =".$c_id." AND u_id = ".$row1['u_id']." AND a_date like '".$month."-".$i."' ";
					       					$result = $database->query($Query);
											while ( $row = mysqli_fetch_assoc($result)) 
											{?>
												<td style='border:1px solid black;padding:5pt;'>
													<button style='background:none;border:none;cursor:pointer;' onClick="update('<?php echo $row1['u_id'] ?>','<?php echo $i ?>','<?php echo $row['a_status'] ?>','<?php echo $row2['fname'] ?>','<?php echo $row2['lname'] ?>','<?php echo $row_reg['reg_no'] ?>','<?php echo $row['att_id'] ?>');" ><?php echo $row['a_status']; ?></button>
												</td>
										<?php
											}
											
										}
										else
										{ 
											$Query = "SELECT * FROM attendance WHERE cf_id =".$c_id." AND u_id = ".$row1['u_id']." AND a_date like '".$month."-".$i."' ";
					       					$result = $database->query($Query);
											if ( $row = mysqli_fetch_assoc($result))
											{
										?>
											<td style='border:1px solid black;padding:5pt;'>
												<button style='background:none;border:none;cursor:pointer;' onClick="update('<?php echo $row1['u_id'] ?>','<?php echo $i ?>','<?php echo $row['a_status'] ?>','<?php echo $row2['fname'] ?>','<?php echo $row2['lname'] ?>','<?php echo $row_reg['reg_no'] ?>','<?php echo $row['att_id'] ?>');" ><?php echo $row['a_status']; ?></button>
											</td>
									<?php }
										}
										
									}
							
							
									
							
							 
								}
								else
								{ ?>
									<td style='border:1px solid black;padding:5pt;'>
									 <!-- <button style='background:none;border:none;cursor:pointer;' onClick="update('<?php echo $row1['u_id'] ?>','<?php echo $i ?>','<?php echo $row['a_status'] ?>','<?php echo $row2['fname'] ?>','<?php echo $row2['lname'] ?>','<?php echo $row_reg['reg_no'] ?>','<?php echo $row['att_id'] ?>');" >-</button> --> -
								</td>

								<?php }
							}
						}}
							?>
							<tr>
						</table>
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
					   	<form action='../includes/CourseFileManagement/UpdateAttendance.php' method='post'>
					   		<input type='text' id='att_id' name='update_att_id' hidden> 
					   		<input type='text' value='<?php echo $c_id ?>' name='c_id' hidden> 
					   		<table>
					   		<tr>
					   			<td><b>Reg #</b></td>
					   			<td id='reg_no' style='padding-left:5pt'></td>
					   		</tr>	   		
					   		<tr>
					   			<td><b>First Name</b></td>
					   			<td id='fname' style='padding-left:5pt'></td>
					   			<td><b>Last Name</b></td>
					   			<td id='lname' style='padding-left:5pt'></td>
					   		</tr>
					   		<tr>
					   			<td><b>Day</b></td>
					   			<td id='date' style='padding-left:5pt'></td>
					   			<td><b>Status</b></td>
					   			<td>
					   				<select id='update_status' name='update_status' class="select-field">
					   					<option>P</option>
					   					<option>A</option>
					   					<option>L</option>
					   				</select>
					   			</td>
					   		<tr>
					   			
					   			<td colspan='4'><center><input type='submit' class='myButton' value='Update'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					   </div>
					   <script src="jquery.mtz.monthpicker.js"></script>
<script>
$('#month').monthpicker();

</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </body>
</html>