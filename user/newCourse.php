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
$search = "";
if(isset($_GET['search']))
{
	$search = " Where fname = '".$_GET['search']."'";
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
		function adCourse(){
    	 	$('#popup').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		function assign(){
    	 	$('#popupb').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		function Delete(id){
			$('#course').val(id);
    	 	$('#popupc').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		 $(function() {
		    $( document ).tooltip();
		  });
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
							<div class='item_nav_left' >Profile</div>
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
					<div class='nav_left' style='background-color: #E1E2E3;'>
						<div class='item_nav_left' style='background-color: #E1E2E3;'>Course Management</div>
						<div class='icon_nav_left'><span class='newCourse'></span></div>
						
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
						include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right' style='width:78%;'>
					<div class='middle' style='width:100%;overflow:scroll'>
						<div class='title_middle' style='margin-bottom:5pt;'><h2>Course Management<input type='button' value='Add Course' class='myButton'  onClick='adCourse();' style='margin-left:10pt;'>|<input type='button' value='New Course Assignment' class='myButton' onClick='assign();'></h2> <?php echo $message ?></div>
						<table style='width:100%'>
							
								<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;'>
										Course Title
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
										Action
									</td>
								</tr>
								<?php
								$print = "";
								$Query_course = "SELECT * FROM course ORDER BY c_title ASC";
								$result_course = $database->query($Query_course);
								while ( $row_course = mysqli_fetch_assoc($result_course))
								{
									$print .= "<tr>";
										$print .= "<td>";
											$print .= $row_course['c_title'];
										$print .= "</td>";
										$print .= "<td>";
											$print .= $row_course['c_hours'];
										$print .= "</td>";
										$print .= "<td>";
											$print .= $row_course['program'];
										$print .= "</td>";
										$print .= "<td>";
											$print .= $row_course['batch'];
										$print .= "</td>";
										$print .= "<td>";
											$print .= "<center><button title='Delete' onClick='Delete(".$row_course['c_code'].");' style='padding-left: 2pt;background:none;border:none'><span class='reject'></span></button></center>";
										$print .= "</td>";
									$print .= "</tr>";
								}
								echo $print;
								
								
								?>
						</table>
						<center>
						
						</center>
						<div style='width:100%;border-bottom: 2px solid #E1E2E3;'></div>
						<center>
						
						</center>
					</div><!-- middle -->
					
				</div><!-- middle_right -->
			</div>
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
	</div>
	<div id="popup" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;width: 450pt;">
		<div class='pop_header'></div>
			<div class='form-style-2' style='max-width: 630px;'>
				<form action='../includes/CourseManagement/AddCourse.php' method='post'>
					<table >
						<tr>
							<td colspan='4'><center><div class="form-style-2-heading">New Course </div></center></td>
						</tr>
						<tr>
							<td  style='vertical-align:top;margin-left: 10pt;'>
								<label for='field1'><span>Course Title <span class='required'>*</span></span>
							</td>
							<td  style='vertical-align:top'>
								<input type='text' name='title' class='input-field'  required placeholder='OOP'></label>
							</td>
							<td  style='vertical-align:top;margin-left: 10pt;'>
								<label for='field1'><span>Credit Hours <span class='required'>*</span></span>
							</td>
							<td  style='vertical-align:top'>
								<input type='text' name='hours' class="input-field" required placeholder='3' pattern='[3|4]{1}' oninvalid="setCustomValidity('must contain Credit Hours')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
							</td>
						</tr>
						<tr>
							<td  style='vertical-align:top;margin-left: 10pt;'>
								<label for='field1'><span>Programm <span class='required'>*</span></span>
							</td>
							<td  style='vertical-align:top'>
								<input type='text' name='program' class='input-field'  required placeholder='BS'  oninvalid="setCustomValidity('must contain Program name')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
							</td>
							<td  style='vertical-align:top;margin-left: 10pt;'>
								<label for='field1'><span>Batch <span class='required'>*</span></span>
							</td>
							<td  style='vertical-align:top'>
								<input type='text' name='batch' class="input-field" required placeholder='F16'  oninvalid="setCustomValidity('must contain Batch like S16')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
							</td>
						</tr>
						<tr>
							<td colspan='4'><br><center><input type='submit' value='Create' class='myButton'></center></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
			<div id="popupb" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;width: 450pt;">
				<div class='pop_header'></div>
				<div class='form-style-2' style='max-width: 630px;'>
							<form action='../includes/CourseManagement/AssignCourse.php' method='post'>
								<table style='width:100%'>
									<tr>
										<td colspan='4'><center><div class="form-style-2-heading">Course Assignment</div></center></td>
									</tr>
									<tr>
										<td  style='vertical-align:top;width: 20pt;'>
											<label for='field1'><span>Course<span class='required'>*</span></span>
										</td>
										<td  style='vertical-align:top' colspan='3'>
											<select name='c_code' style='width: 100%;height:25pt;' class="select-field">
												<option></option>
												<?php
												$print = "";
												$name = "";
												$Query_course = "SELECT * FROM course ORDER BY c_title ASC";
								       			$result_course = $database->query($Query_course);
												while ( $row_course = mysqli_fetch_assoc($result_course))
												{
													
													$print .= "<option value='".$row_course['c_code']."'><span style='color:red'>".$row_course['c_title'].", Credit Hourse : ".$row_course['c_hours'].", Program : ".$row_course['program'].", Batch : ".$row_course['batch']." </option>";
																											
												}
												echo $print;
												 
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td  style='vertical-align:top;width: 20pt'>
											<label for='field1'><span>Teacher<span class='required'>*</span></span>
										</td>
										<td  style='vertical-align:top' colspan='3'>
											<select name='u_id' style='width: 100%;height:25pt;margin-bottom:2pt;margin-top:2pt;' class="select-field">
												<option></option>
												<?php
												$print = "";
												$name = "";
												$Query_teacher = "SELECT * FROM teacher";
								       			$result_teacher = $database->query($Query_teacher);
												while ( $row_teacher = mysqli_fetch_assoc($result_teacher))
												{
													$Query_user = "SELECT * FROM user WHERE u_id =  ".$row_teacher['u_id']."";
								       				$result_user = $database->query($Query_user);
													if ( $row_user = mysqli_fetch_assoc($result_user))
													{
														$print .= "<option value='".$row_user['u_id']."'><span style='color:red'>".$row_user['fname']." ".$row_user['lname'].", Qualification : ".$row_teacher['final_qualification']."</option>";
													}														
												}
												echo $print;
												 
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td colspan='4'><br><center><input type='submit' value='Assign' class='myButton'></center></td>
									</tr>
								</table>
							</form>
						</div>
			</div>
			<div id="popupc" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Deleting Course</div>
					   	<form action='../includes/CourseManagement/DeleteCourse.php' method='post'>
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
	</div>
  </body>
</html>