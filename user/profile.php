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
$u_id = $_SESSION['user'];
global $database;
	$fname = $_SESSION["fname"];
	$lname = $_SESSION["lname"];

	$designation 	= "";
	$shift 			= "";
	$c_o_id 		= "";
	$role 			= "";

	$reg_no 		= "";
	$dob 			= "";
	$address 		= "";
	$cnic 			= "";
	$phone 			= "";
	$cgpa 			= "";
	$nationality 	= "";

	$t_id 			= "";
	$office 		= "";
	$qualification 	= "";
	$gender 		= ""; 

	if(isset($_SESSION["role"]))
	{
		$role 			= $_SESSION["role"];
	}
	//require_once("../includes/UserManagement/UserManagementDL.php");

	
			if($role == "Admin")
			{
				$Query2 = "SELECt * FROM c_officer WHERE u_id = '{$u_id}' ";
		        $result2 = $database->query($Query2);
				if ( $row2 = mysqli_fetch_assoc($result2)) 
				{
					$c_o_id 		= $row2['c_o_id'];
					$designation 	= $row2['c_o_designation'];
					$shift 			= $row2['c_o_shif'];
				}
			}
			else if($role == "Student")
			{
				$Query2 = "SELECt * FROM student WHERE u_id = '{$u_id}' ";
		        $result2 = $database->query($Query2);
				if ( $row2 = mysqli_fetch_assoc($result2)) 
				{
					$reg_no 		= $row2['Reg_no'];
					$dob 			= $row2['s_dob'];
					$address 		= $row2['s_address'];
					$cnic 			= $row2['s_cnic'];
					$phone 			= $row2['s_phone'];
					$cgpa 			= $row2['s_cgpa'];
					$nationality 	= $row2['s_nationality'];

				}
			}
			else if($role == "Teacher")
			{
				$Query2 = "SELECt * FROM teacher WHERE u_id = '{$u_id}' ";
		        $result2 = $database->query($Query2);
				if ( $row2 = mysqli_fetch_assoc($result2)) 
				{
					$t_id 			= $row2['t_id'];
					$office 	 	= $row2['t_office'];
					$phone 			= $row2['t_phone'];
					$qualification 	= $row2['final_qualification'];
					$gender 		= $row2['t_gender'];
					$cnic 			= $row2['t_cnic'];

					$office 		=  (explode(" ",$office));
					$qualification 	=  (explode(" ",$qualification));
					//echo $office[0]." ".$office[1];
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
		<script>
		$(document).ready(function(){

		    $("#update").click(function(){
		    	var r = true;
		    	if (r == true) {
		    	     $("#show").show();
		    	     $("#hide").hide();
		    	     $("#show_pass").hide();
	    	     $("#pass").show();
		    	}
		    	   
		    	});
			
		$("#pass").click(function(){
	    	var r = true;
	    	if (r == true) {
	    	     $("#show_pass").show();
	    	     $("#pass").hide();
	    	     $("#show").hide();
		    	  $("#hide").show();
	    	}
	    	   
	    	});
		});
		
					    function checkpass()
					    {
					    	
					    	$(".error").hide();
					    	var hasError = false;
					    	var passwordVal = $("#txtNewPassword").val();
					    	var checkVal = $("#txtConfirmPassword").val();

					    	if (passwordVal == '') 
					    	{
					    		$("#a").html("<span style='color:red;'>Please enter a password.</span>");
					    		hasError = true;
					    	}
					    	else if (checkVal == '') 
					    	{
					    		$("#b").html("<span style='color:red;'>Please enter a password.</span>");
					    		
					    		hasError = true;
					    	} 
					    	else if (passwordVal != checkVal ) 
					    	{
					    		$("#a").html("<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -28pt 6pt 5pt -6pt;width: 298pt;'>Password missmatch.</div>");
					    		
					    		hasError = true;
					    	}
					    	if(hasError == true) 
					    	{
					    		//alert("here");
					    		return false;
					    	}
					   
					    }
		
		function abc()
		{
			var a = $("#country_selector").val();
			$('input[name="nationality"]').val(a);

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
					<div class='nav_left'  style='background-color: #E1E2E3;'>
						
							<div class='item_nav_left'  style='background-color: #E1E2E3;'>Profile</div>
							<div class='icon_nav_left'><span class='profile'></span></div>
						
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
				<div class='middle_right'>
					<div class='middle' style='overflow: hidden' >
						<div class='title_middle'><h2>Profile</h2> <?php echo $message ?></div>
						<?php if($role == "Student")
						{ ?>
							<div class='profile_about'>
							<center>
								<table id='hide'>
								<col width='150'>
								<col width='200'>
								<tr>
									<td><b>Registration #</b></td>
									<td><?php echo $reg_no ?></td>
									<td><b>Nationality</b></td>
									<td><?php echo $nationality ?></td>
								</tr>
								<tr>
									<td><b>First Name</b></td>
									<td><?php echo $fname ?></td>
								
									<td><b>Last Name</b></td>
									<td><?php echo $lname ?></td>
								</tr>
								<tr>
									<td><b>Date of Birth</b></td>
									<td><?php echo $dob ?></td>
								
									<td><b>CNIC</b></td>
									<td><?php echo $cnic ?></td>
								</tr>
								<tr>
									<td><b>Phone Number</b></td>
									<td><?php echo $phone ?></td>
								
									<td><b>CGPA</b></td>
									<td><?php echo $cgpa ?></td>
								</tr>
								<tr>
									<td><b>Address</b></td>
									<td colspan='3' style='max-width: 130px;'><?php echo $address ?></td>
								</tr>
								<tr>
									<td colspan='4' style='padding-top:6pt;'>
										<center><input type='button' class='myButton' id='update' value='update'></center>
									</td>
								</tr>
							</table>
							<div class='form-style-2' style='max-width: 630px;'>
							<table  id='show' style='display:none; width: 444pt;margin-top:-23pt' >
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<form action='../includes/UserManagement/UpdateProfileStudent.php' method='post' name='login' onsubmit='return abc()'>
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>Registration #</span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='fname' class='input-field' required placeholder='Esra' value='<?php echo $reg_no ?>' disabled pattern='[a-zA-Z]{3,}' oninvalid='setCustomValidity('must contain 3 or more letters only with no space')'  onchange='try{setCustomValidity('')}catch(e){}' /></label>
									</td>
									<td  style="vertical-align:top">
										<label for="field1"><span>Nationality <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' class="input-field" required id="country_selector" style='width: 122pt' /></label>
										<input name='nationality' hidden>
									</td>
								</tr>
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>First Name <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='fname' class='input-field' required placeholder='Esra' value='<?php echo $fname ?>' pattern='[a-zA-Z]{3,}' oninvalid='setCustomValidity('must contain 3 or more letters only with no space')'  onchange='try{setCustomValidity('')}catch(e){}' /></label>
									</td>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>Last Name <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='lname' class='input-field' value='<?php echo $lname ?>' required placeholder='Brakat' pattern='[a-zA-Z]{3,}' oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>Date of Birth <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='dob' class='input-field' value='<?php echo $dob ?>' required placeholder='clerk'></label>
									</td>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>CNIC <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='cnic' class="input-field"  value='<?php echo $cnic ?>' placeholder='00000-0000000-0' pattern='[0-9]{5}-[0-9]{7}-[0-9]{1}'  oninvalid="setCustomValidity('must contain a valid CNIC or B-Form number in 00000-0000000-0 format')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Contact <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top"><input type='text' class="input-field" required value='<?php echo $phone ?>' placeholder='03000000000' pattern='[03]{2}[0-9]{9}' name='contact' oninvalid="setCustomValidity('must contain 11 characters that are srart with 03 and contain number only')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>CPGA <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='cgpa' class="input-field" required placeholder='4.00' value='<?php echo $cgpa ?>' style='width: 122pt' pattern='[0-4]{1}.[0-9]{2}'  oninvalid="setCustomValidity('must contain your CGPA')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>Address <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top" colspan='3'>
										<textarea  class="textarea-field" name='address' style='width:344pt;' required ><?php echo $address ?></textarea>
									</td>
								</tr>
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Save' class='myButton'></center></td>
								</tr>
								<input type='text' name='u_id' value='<?php echo $u_id ?>' hidden />
								<input type='text' name='reg_no' value='<?php echo $reg_no ?>'  hidden />
							</form>
						</table>
						</div>
							</center>
						<?php
						}
						else if($role == "Admin")
						{ ?>

							<div class='profile_about'>
							<center>
								<table id='hide'>
								<col width='150'>
								<col width='200'>
								<tr>
									<td><b>First Name</b></td>
									<td><?php echo $fname ?></td>
								</tr>
								<tr>
									<td><b>Last Name</b></td>
									<td><?php echo $lname ?></td>
								</tr>
								<tr>
									<td><b>Designation</b></td>
									<td><?php echo $designation ?></td>
								</tr>
								<tr>
									<td><b>Shift</b></td>
									<td><?php echo $shift ?></td>
								</tr>
								<tr>
									<td colspan='2' style='padding-top:6pt;'>
										<center><input type='button' class='myButton' id='update' value='update'></center>
									</td>
								</tr>
							</table>
							<div class='form-style-2' style='max-width: 630px;'>
							<table  id='show' style='display:none; width: 444pt;'>
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<form action='../includes/UserManagement/UpdateProfileWorker.php' method='post' name='login'>
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>First Name <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='fname' class='input-field' required placeholder='Esra' value='<?php echo $fname ?>' pattern='[a-zA-Z]{3,}' oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>Last Name <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='lname' class='input-field' value='<?php echo $lname ?>' required placeholder='Brakat' pattern='[a-zA-Z]{3,}' oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>Designation <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='designation' class='input-field' value='<?php echo $designation ?>' required placeholder='clerk'></label>
									</td>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>Shift <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<select name='shift' style='width: 97pt;height:25pt;' class='select-field'>
												<?php
													if($shift == "Morning")
													{
														echo "<option selected>Morning</option>";
														echo "<option>Evening</option>";
													}
													else
													{
														echo "<option>Morning</option>";
														echo "<option selected>Evening</option>";
													}
												?>
											</select></label>
									</td>
								</tr>
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Save' class='myButton'></center></td>
								</tr>
								<input type='text' name='u_id' value='<?php echo $u_id ?>' hidden/>
								<input type='text' name='c_o_id' value='<?php echo $c_o_id ?>' hidden />
							</form>
						</table>
						</div>
							</center>
						<?php
						}
						else if($role='Teacher')
						{ ?>
							<div class='profile_about'>
							<center>
								<table id='hide'>
								<col width='150'>
								<col width='200'>
								<tr>
									<td><b>First Name</b></td>
									<td><?php echo $fname ?></td>
								</tr>
								<tr>
									<td><b>Last Name</b></td>
									<td><?php echo $lname ?></td>
								</tr>
								<tr>
									<td><b>CNIC</b></td>
									<td><?php echo $cnic ?></td>
								</tr>
								<tr>
									<td><b>Gender</b></td>
									<td><?php echo $gender ?></td>
								</tr>
								<tr>
									<td><b>Office</b></td>
									<td><?php echo $office[0]." ".$office[1].", Room no : ".$office[2] ?></td>
								</tr>
								<tr>
									<td><b>Phone</b></td>
									<td><?php echo $phone ?></td>
								</tr>
								<tr>
									<td><b>Qualification</b></td>
									<td><?php echo $qualification[0]." ".$qualification[1] ?></td>
								</tr>
								<tr>
									<td colspan='2' style='padding-top:6pt;'>
										<center><input type='button' class='myButton' id='update' value='update'></center>
									</td>
								</tr>
							</table>
							<div class='form-style-2' style='max-width: 630px;'>
							<table  id='show' style='display:none; width: 472pt;'>
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<form action='../includes/UserManagement/UpdateProfileTeacher.php' method='post' name='login'>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>First Name <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='fname' value='<?php echo $fname ?>' class="input-field" required placeholder='Esra' pattern="[a-zA-Z]{3,}" oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Last Name <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='lname' class="input-field" value='<?php echo $lname ?>' required placeholder='Brakat' pattern="[a-zA-Z]{3,}" oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top;">
										<label for="field1"><span>Office <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top;width:200pt" >
										<select name='session' class="select-field" style='width: 72pt;'>
											<?php 
											if ($office[0]." ".$office[1] == "1st Floor") 
											{ ?>
												<option selected>1st Floor</option>
												<option>2nd Floor</option>
												<option>3rd Floor</option>
											<?php 
											}
											else if ($office[0]." ".$office[1] == "2nd Floor") 
											{ ?>
												<option>1st Floor</option>
												<option selected>2nd Floor</option>
												<option>3rd Floor</option>
											<?php 
											}
											else if ($office[0]." ".$office[1] == "3rd Floor") 
											{ ?>
												<option>1st Floor</option>
												<option>2nd Floor</option>
												<option selected>3rd Floor</option>
											<?php 
											}?>	
											</select>
											<input type='text' name='rom' value='<?php echo $office[2]; ?>' style='width: 38%' class="input-field" required placeholder='12'></label>
									</td>
									
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Contact <span class="required">*</span></span> 
									</td>
									<td  style="vertical-align:top"><input type='text' class="input-field" value='<?php echo $phone ?>' required placeholder='03000000000' pattern='[03]{2}[0-9]{9}' name='contact' oninvalid="setCustomValidity('must contain 11 characters that are srart with 03 and contain number only')"onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>CNIC</span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='cnic' class="input-field" value='<?php echo $cnic ?>' placeholder='00000-0000000-0' pattern='[0-9]{5}-[0-9]{7}-[0-9]{1}'  oninvalid="setCustomValidity('must contain a valid CNIC number in 00000-0000000-0 format')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style="vertical-align:top">
										<label for="field1"><span>Gender<span class="required">*</span></span>
									</td>
									<td>
										<select name='gender' style='width: 100pt;height:25pt;' class="select-field">
											<?php
											if ($gender == "Male") 
											{ ?>
												<option selected>Male</option>
												<option>Female</option>
											<?php	
											} 
											else if($gender == "Female")
											{?>
												<option>Male</option>
												<option selected>Female</option>
											<?php	
											}
											
											?>
												
											</select></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Qualification <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top" colspan='3'>
										<select name='degree' style='width: 49pt;height:25pt;' class="select-field">
												<?php
												if($qualification[0] == "BS")
												{ ?>
													<option selected>BS</option>
													<option>MS</option>
													<option>PHD</option>
												<?php
												}
												else if($qualification[0] == "MS")
												{ ?>
													<option>BS</option>
													<option selected>MS</option>
													<option>PHD</option>
												<?php
												}
												else if($qualification[0] == "PHD")
												{ ?>
													<option>BS</option>
													<option>MS</option>
													<option selected>PHD</option>
												<?php 
												}
												?>
											</select>
											<input type='text' name='qualification' value='<?php echo $qualification[1]; ?>' style='width: 294pt;' class="input-field" required placeholder='Computer Science'></label>
									</td>
									
								</tr>
								
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Update' class="myButton"></center></td>
								</tr>
								<input type='text' name='u_id' value='<?php echo $u_id ?>' hidden/>
								<input type='text' name='t_id' value='<?php echo $t_id ?>' hidden />
							</form>
						</table>
						</div>
							</center>
						<?php
						}
						else
						{

						}
						?>
						
						</div><!-- profile_about -->
						<div class='profile_areas'>
							<div class='title_middle'><h2>Change Password</h2></div>
							<table id='pass'>
									<tr>
									<td colspan='2' style="padding-top:6pt;">
										<center><input type='button' class='myButton' id='pass' value='update'></center>
									</td>
								</tr>
							</table>
							<div class='form-style-2'>
				
				<form action='../includes/UserManagement/UpdatePassword.php' method='post' onsubmit='return checkpass()'>
					<table hidden id='show_pass' style='width:100%'>
						<col width='200' >
						<col width='200'>
						<tr>
							<td><label for='field1'><span>Current Password<span class='required'>*</span></span></td>
							<td><input type='password' name='old' class='input-field' required pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}' placeholder='*********' name='opassword' oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')" onchange="try{setCustomValidity('')}catch(e){}" /></label></td>
						</tr>
						<tr>
							<td><label for='field1'><span>New Password<span class='required'>*</span></span></td><div id='a'></div>
							<td><input type='password' required  class='input-field' name='new' id='txtNewPassword' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}' placeholder='*********' name='password' oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')" onchange="try{setCustomValidity('')}catch(e){}" /></label></td>
						</tr>
						<tr>
							<td><label for='field1'><span style='width:154px'>Confrm New Password<span class='required'>*</span></span></td><div id='b'></div>
							<td><input type='password'   class='input-field' name='confrm' id='txtConfirmPassword' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}'  required placeholder='*********'></label></td>
						</tr>
						<tr>
							<input type='text' name='u_id' value='<?php echo $u_id ?>' hidden/>
							<td colspan='2' style=''><br><center><input class='myButton' type='submit' value='save'></center></td>
						</tr>
					</table>
				</form>
				</div>
						</div>
					</div><!-- middle -->
					
				</div><!-- middle_right -->
			</div>
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
		<script src="../css/countrySelect.min.js"></script>
		<script>
			$("#country_selector").countrySelect({
				//defaultCountry: "jp",
				//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
				preferredCountries: ['pk', 'gb', 'us']
			});
		</script>
  </body>
</html>