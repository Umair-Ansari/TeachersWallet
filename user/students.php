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
		<style>
			.form-style-2 input.input-field {
   				 width: 100pt;
		}
		.form-style-2 label > span {
    		width: 100px;
    		font-weight: bold;
    		float: left;
    		padding-top: 8px;
    		padding-right: 5px;
		}
		</style>
		
		
		

		<script src="http://dinbror.dk/bpopup/assets/jquery.bpopup-0.9.4.min.js"></script>
		<script src="http://dinbror.dk/bpopup/assets/jquery.easing.1.3.js"></script>
		<script type="text/javascript">
		
		function del(id){
			$('#user').val(id);
    	 	$('#del').bPopup({
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
						<div class='title_middle' style='margin-bottom:0pt;'><h2>Students</h2><?php echo $message ?></div>
						
							<?php
							
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
							       	{ ?>
										
								        	<b>Course Title :</b>    <?php echo $row_course['c_title'];	?><br>														
								        	<b>Class :</b> <?php echo $row_class['programm_name'] ?><br>
								        	<b>Batch :</b> <?php echo $row_class['batch_name'] ?><br>														
								        	<b>Instructor Name :</b> <?php echo $_SESSION["fname"]." ".$_SESSION["lname"]; ?>	<br>
								        	<br>
						       		<?php
						       		}

					       		} 
					       	}
					       		
					        ?>
					    																
					        <table style='width:100%;margin-top:2pt;'>
								<col width='100'>
								<col width='100'>
								<col width='100'>
								<col width='20'>
								<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;'>
										Registration #
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										First Name
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Last Name
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Delete
									</td >
								</tr>
							<?php
								$Query1 = "SELECT *  FROM course_student WHERE c_id =".$c_id."";
						        $result1 = $database->query($Query1);
						        while($row1 = mysqli_fetch_assoc($result1))
						        {
						        	echo "<tr>";
						        	$Query2 = "SELECT * FROM student WHERE u_id =".$row1['u_id']."";
							        $result2 = $database->query($Query2);
							        if($row2 = mysqli_fetch_assoc($result2))
							        { 

						        		echo "<td>";
						        			echo $reg_no = $row2['Reg_no'];
						        		echo "</td>";
							        }
							        $Query2 = "SELECT * FROM user WHERE u_id =".$row1['u_id']."";
							        $result2 = $database->query($Query2);
							        if($row2 = mysqli_fetch_assoc($result2))
							        {
							        	echo "<td style='padding-left:2pt;'>";
						        			echo $row2['fname'];
						        		echo "</td>";
						        		echo "<td>";
						        			echo $row2['lname'];
						        		echo "</td>";
						        		echo "<td>";
						        			echo "<button style='background:none;border:none' onClick='del(".$row1['u_id'].");'>Delete</button>";
						        		echo "</td>";
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
		 
		
					<div id="del" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Delete Srudent</div>
					   	<form action='../includes/CourseManagement/DeleteStudent.php' method='post' enctype='multipart/form-data'>
					   		
					   		<table>
					   			<tr>
					   				<td><b>Are You Sure!</b></td>
					   			</tr>
					   			<tr>
					   				<td>You Are going to remove this student from course.</td>
					   			</tr>
					   		<tr>
					   			<input hidden type='text' name='course' value='<?php echo $c_id ?>' />
					   			<input hidden type='text' name='user' id='user' />
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Delete'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					</div>
			
  </body>
</html>
