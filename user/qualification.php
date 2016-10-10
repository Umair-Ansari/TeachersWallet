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

$role = "";
if(isset($_SESSION["role"]))
	{
		$role 			= $_SESSION["role"];
	}
			
if($role != "Teacher")
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
    		width: 100px;
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
		$(document).ready(function(){
			$(function() {
			    $( document ).tooltip();
			  });
		});
		function degree(){
			
			 	$('#best').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		function del(id){
			
			
			$('#q_id').val(id);
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
					<?php } 
					include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%'>
						<div class='title_middle' style='margin-bottom:0pt;'><h2>Qualification<span title='Visible to Cordinators' class='blink_me'>!</span><input type='button' value='Add Degree' class='myButton'  onClick='degree();' style='margin-left:10pt;'></h2><?php echo $message ?></div>
						
							 <table style='width:100%;margin-top:2pt;'>
								
								<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;'>
										Degree
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Institute
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Division
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Percentage
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										CGPA
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										Delete
									</td>
								</tr>
								<?php
								$ERROR = "<tr><td colspan='6'><center><h2>No Qualification Added</h2></center></td></tr>";
								$print = "";
								$Query_qualification = "SELECT *  FROM qualification WHERE u_id =".$_SESSION["user"]."";
							    $result_qualification = $database->query($Query_qualification);
							    while($row_qualification = mysqli_fetch_assoc($result_qualification))
							    {
							    	$ERROR = "";
							    	$print .= "<tr>";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['degree'];
										$print .="</td >";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['institute'];
										$print .="</td >";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['division'];
										$print .="</td >";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['percentage'];
										$print .="</td >";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .=$row_qualification['cgpa'];
										$print .="</td>";
										$print .="<td style='border:1px solid black;padding:5pt;'>";
											$print .="<input type='button' onClick='del($row_qualification[qt_id]);' value='Delete' style='border:none;background-color:none;text-decoration: underline;cursor: pointer;'>";
										$print .="</td>";
									$print .="</tr>";
							    }

							    echo $print;
							    echo $ERROR;
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
							<div class="form-style-2-heading">Add New Degree</div>
					   	<form action='../includes/UserManagement/AddQualification.php' method='post' enctype='multipart/form-data'>
					   		
					   		<table>
					   		<tr>
					   			<td style='padding-left:5pt;'><b>Degree</b></td>
					   			<td style='padding-left:5pt'><input type='text' name='degree' required class="input-field" /></td>
					   			<td style='padding-left:5pt;'><b>Division</b></td>
					   			<td style='padding-left:5pt;'>
					   				<select name='division' class='select-field' style='width:100%'>
					   					<option value='1st'>1st</option>
					   					<option value='2nd'>2nd</option>
					   				</select>
					   			</td>
					   		</tr>
					   		<tr>
					   			<td style='padding-left:5pt;'><b>Percentage</b></td>
					   			<td style='padding-left:5pt'><input type='text' name='percentage' required class="input-field" pattern="[1-9]{1}[0-9]{1}%" oninvalid="setCustomValidity('must contain percentage like 70%')"  onchange="try{setCustomValidity('')}catch(e){}" /></td>
					   			<td style='padding-left:5pt;'><b>CGPA</b></td>
					   			<td style='padding-left:5pt'><input type='text' name='cgpa' required class="input-field" pattern='[0-4]{1}.[0-9]{2}'  oninvalid="setCustomValidity('must contain your CGPA like 3.00')" onchange="try{setCustomValidity('')}catch(e){}" /></td>
					   		</tr>
					   		<tr>
					   			<td style='padding-left:5pt;'><b>Institute</b></td>
					   			<td style='padding-left:5pt' colspan='3'><input type='text' name='institute' required class="input-field" style='width: 100%;'/></td>
					   		</tr>
					   		<tr>
					   			<input type='text' hidden name='u_id' value='<?php echo $_SESSION["user"]?>'>
					   			
					   			<td colspan='4'><center><br><input type='submit' class='myButton' value='Add'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					</div>
										<div id="del" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Delete Qualification</div>
					   	<form action='../includes/UserManagement/DeleteQualification.php' method='post' enctype='multipart/form-data'>
					   	<center>
					   		<table>
					   			<tr>
					   				<td colspan='2'>Are Your Sure?</td>
					   			</tr>
					   		<tr>
					   			<input hidden type='text' id='q_id' name='q_id' />
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Yes'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   	</center>
						</div>
					</div>

  </body>
</html>
