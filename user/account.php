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
	$fname = $database->escape_value($_GET['search']);
	$search = " AND fname = '".$fname."'";
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
   				 width: 30%;
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
		<script src="http://dinbror.dk/bpopup/assets/jquery.bpopup-0.9.4.min.js"></script>
		<script src="http://dinbror.dk/bpopup/assets/jquery.easing.1.3.js"></script>
		<script type="text/javascript">
		var email;
		var id;
		function toDelete(val,table){
			//alert(id);
			id = val;
			tab = table;
			email = $('#'+id).text();
			$('#email').val(email);
			$('#table').val(tab);
			//alert(email);
   		// $('#popup').bPopup();
    	 	$('#popup').bPopup({
    			easing: 'easeOutBack', //uses jQuery easing plugin
    	    	speed: 450,
    	    	transition: 'slideDown'
    		});
		}
		function toAccept(val,table){
			//alert(id);
			id = val;
			tab = table;
			email = $('#'+id+'').text();

			$('#email2').val(email);
			$('#table2').val(tab);
			//alert(email);
   		// $('#popup').bPopup();
    	 	$('#popup2').bPopup({
    			easing: 'easeOutBack', //uses jQuery easing plugin
    	    	speed: 450,
    	    	transition: 'slideDown'
    		});
		}
		function DeleteAll(){
			$('#popup3').bPopup({
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
						<div class='lower_text_welcome_logout' style='color: #F3F3F3;text-shadow: 0px 0px 2px #D2EBFA;'><a href="index.php"  style='color: #E1E2E3;'>Homes</a> | <a href="../includes/UserManagement/LogOutBL.php" style='color: #E1E2E3;'>Logout</a></div>
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
					<div class='nav_left' style='background-color: #E1E2E3;'>
						<div class='item_nav_left' style='background-color: #E1E2E3;'>Account Request</div>
						<div class='icon_nav_left'><span class='account_request'></span></div>
						
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
					include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right' style='width:78%'>
					<div class='middle' style='width:100%;overflow:scroll'>
						<div class='title_middle' style='margin-bottom:5pt;'><h2>Account Requests</h2> <?php echo $message ?></div>
						<div style='width:100%;border:2px solid #E1E2E3;height:30pt; margin-bottom:2pt;'>
							<div class='form-style-2' style='margin-top:-18pt;'>
								
									
								
								<form action='account.php' method='get'>
									<input type='button' value='Delete All' class='myButton' onClick="DeleteAll();" style='margin:0pt 3pt 0pt -13pt;'> 
									<lable>|</lable>
									<input type='text' class="input-field" name='search' style='margin:5pt 5pt 5pt 0pt;'>
									<input type='submit' value='Search' class='myButton' style='margin:5pt 5pt 5pt 0pt;'>
								</form>
							</div>
						</div>
						<div style='width:100%;border:2px solid #E1E2E3;height:426pt;padding:6pt 0pt 6pt 6pt;margin-bottom: 7pt;'>
							<?php
							$counter = 0;
							$Query = "SELECT COUNT(*) count FROM temp_student where status = 1";
						    $result = $database->query($Query);
						    $row = mysqli_fetch_assoc($result);
						    $counter = $row['count'];
						   	$Query = "SELECT COUNT(*) count FROM temp_teacher where status = 1";
						    $result = $database->query($Query);
						    $row = mysqli_fetch_assoc($result);
						    $counter = $counter + $row['count'];
						    $Query = "SELECT COUNT(*) count FROM temp_worker where status = 1";
						    $result = $database->query($Query);
						    $row = mysqli_fetch_assoc($result);
						    $counter = $counter + $row['count'];
							$print = "";
								$Query2 = "SELECT * FROM temp_student ";
								$Query2 .= " where status = 1";
								$Query2 .= " $search ";
						        $result2 = $database->query($Query2);
								while ( $row2 = mysqli_fetch_assoc($result2)) 
								{
									?>
									<div class='request_panel' style='height:133pt;'>
										<table>
											<col width='25%'>
											<col width='25%'>
											<col width='25%'>
											<col width='25%'>
											<tr>
												<td colspan='4'><center><b><u>Student</u></b></center></td>
											</tr>
											<tr>
												<td><b>Registration no</b></td>
												<td><u><?php echo $row2['reg_no'] ?></u></td>
											
											</tr>
											<tr>
												<td><b>First Name</b></td>
												<td><?php echo $row2['fname'] ?></td>
											
												<td style='padding-left:5pt;'><b>Last Name</b></td>
												<td><?php echo $row2['lname'] ?></td>
											</tr>
											<tr>
												<td><b>Email</b></td>
												<td id="s<?php echo $row2['ts_id'] ?>" ><?php echo $row2['email'] ?></td>
											
												<td style='padding-left:5pt;'><b>Contact</b></td>
												<td><?php echo $row2['contact'] ?></td>
											</tr>
											<tr>
												<td><b>Nationality</b></td>
												<td><?php echo $row2['nationality'] ?></td>
												<td style='padding-left:5pt;'><b>CNIC</b></td>
												<td><?php echo $row2['cnic'] ?></td>
											
											<tr>
											<tr>
												<td><b>CGPA</b></td>
												<td><?php echo $row2['cgpa'] ?></td>
												<td style='padding-left:5pt;'><b>DOB</b></td>
												<td><?php echo $row2['dob'] ?></td>
											
											</tr>
											<tr>
												<td><b>Address</b></td>
												<td><?php echo $row2['address'] ?></td>
											</tr>
											<tr>
												
													<td colspan='4'>
														<center>
															<br>
														<input type='submit' class='myButton' value='Accept' onClick="toAccept('s<?php echo $row2['ts_id'] ?>','temp_student');" > | 
														<input type='submit' class='myButton' value='Reject' onClick="toDelete('s<?php echo $row2['ts_id'] ?>','temp_student');" >
														</center>
													</td>
												
											</tr>
										</table>
									</div>

								<?php
								}
								$Query2 = "SELECT * FROM temp_teacher ";
								$Query2 .= " where status = 1";
								$Query2 .= " $search ";
						        $result2 = $database->query($Query2);
								while ( $row2 = mysqli_fetch_assoc($result2)) 
								{
								?>
									<div class='request_panel' style='height:133pt;' >
										<table>
											<col width='25%'>
											<col width='25%'>
											<col width='25%'>
											<col width='25%'>

											<tr>
												<td colspan='4'><center><b><u>Teacher</u></b></center></td>
											</tr>
											<tr>
												<td><b>First Name</b></td>
												<td><?php echo $row2['fname'] ?></td>
											
												<td style='padding-left:5pt;'><b>Last Name</b></td>
												<td><?php echo $row2['lname'] ?></td>
											</tr>
											<tr>
												<td><b>Email</b></td>
												<td id="t<?php echo $row2['tt_id'] ?>" ><?php echo $row2['email'] ?></td>
											
												<td style='padding-left:5pt;'><b>Contact</b></td>
												<td><?php echo $row2['phone'] ?></td>
											</tr>
											<tr>
												<td><b>Qualification</b></td>
												<td><?php echo $row2['qualification'] ?></td>
												<td style='padding-left:5pt;'><b>CNIC</b></td>
												<td><?php echo $row2['cnic'] ?></td>
											
											</tr>
											<tr>
												<td><b>Office</b></td>
												<td><?php echo $row2['office'] ?></td>
												<td style='padding-left:5pt;'><b>Gender</b></td>
												<td><?php echo $row2['gender'] ?></td>
											</tr>
											<tr>
											
												
													<td colspan='4'>
														<center>
															<br>
														<input type='submit' class='myButton' value='Accept' onClick="toAccept('t<?php echo $row2['tt_id'] ?>','temp_teacher');" > | 
														<input type='submit' class='myButton' value='Reject'  onClick="toDelete('t<?php echo $row2['tt_id'] ?>','temp_teacher');" >
														</center>
													</td>
												
											</tr>
										</table>
									</div>

								
								<?php
								}
								$Query2 = "SELECT * FROM temp_worker ";
								$Query2 .= " where status = 1";
								$Query2 .= " $search ";
						        $result2 = $database->query($Query2);
								while ( $row2 = mysqli_fetch_assoc($result2)) 
								{
									?>
									<div class='request_panel' style='height:133pt;' >
										<table>
											<col width='25%'>
											<col width='25%'>
											<col width='25%'>
											<col width='25%'>
											<tr>
												<td colspan='4'><center><b><u>Worker</u></b></center></td>
											</tr>
											<tr>
												<td><b>First Name</b></td>
												<td><?php echo $row2['fname'] ?></td>
											
												<td style='padding-left:5pt;'><b>Last Name</b></td>
												<td><?php echo $row2['lname'] ?></td>
											</tr>
											<tr>
												<td><b>Email</b></td>
												<td  id="w<?php echo $row2['tw_id'] ?>" ><?php echo $row2['email'] ?></td>
											
												<td style='padding-left:5pt;'><b>Shift</b></td>
												<td><?php echo $row2['shift'] ?></td>
											</tr>
											<tr>
												<td><b>Designation</b></td>
												<td colspan='3'><?php echo $row2['designation'] ?></td>;
											</tr>
											
											
											<tr>
											
												
													<td colspan='4'>
														<center>
															<br>
														<input type='submit' class='myButton' value='Accept' onClick="toAccept('w<?php echo $row2['tw_id'] ?>','temp_worker');" > | 
														<input type='submit' class='myButton' value='Reject' onClick="toDelete('w<?php echo $row2['tw_id'] ?>','temp_worker');" >
														</center>
													</td>
												
											</tr>
										</table>
									</div>

								<?php
								}
							?>
							
							
							
							

						</div>
						
				
						
					</div><!-- middle -->
					
				</div><!-- middle_right -->
			</div>
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
		
						<div id="popup" class='a' style="display:none; background:#F6F7F8; float:left;padding:6pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
					   <form action='../includes/UserManagement/DeleteRequest.php' method='post'>
					   		<table>
					   		<tr>
					   			<span id='spnmobileStatus'></span>
					   			<td>Sender</td>
					   			<td ><input type='text' value='Teachers Wallets' class="input-field"  required style='width:90%;margin-left: 10px;' ></td>
					   			<td>Reciever</td>
					   			<td ><input type='text' id='email' name='email' required class="input-field"  style='width:90%;margin-left: 10px;' name='recive'></td>
					   		</tr>
					   		<tr>
					   			<td  style="vertical-align:top" >Rejection Message</td>
					   			<td colspan='3'><textarea class="textarea-field" required rows="4" cols="43" style='margin-left: 10px;' name='reason'>unknowing</textarea></td>
					   		</tr>
					   		<tr>
					   			<input type='text' hidden name='table' id='table'>
					   			<td colspan='4'><center><input type='submit' class='myButton' value='Reject'></center></td>
					   		</tr>
					   		</table>
					   </form>
						</div>
					   </div>
					   <div id="popup2" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
					   <form action='../includes/UserManagement/AcceptRequest.php' method='post'>
					   		<table>
					   		
					   			
					   			
					   				
					   							   		
					   		<tr>
					   			<td colspan='4'><center><b>Are You Sure!</b><br><br></center> </td>
					   		</tr>
					   		<tr>
					   			<input type='text' name='table' id='table2' hidden>
					   			<input type='text' id='email2' name='email' hidden name='accept'>
					   			<td colspan='4'><center><input type='submit' class='myButton' value='Accept'></center></td>
					   		</tr>
					   		</table>
					   </form>
						</div>
					   </div>
					   <div id="popup3" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
					   
					   		<table>
					   		
					   			
					   			
					   				
					   							   		
					   		<tr>
					   			<td><center><b>Are You Sure!</b><br><br></center> </td>
					   			
					   		</tr>
					   		<tr>
					   			<td>If you Accept all requests from system will remove</td>
					   			</tr>
					   		<tr>
					   			<form action='../includes/UserManagement/DeleteAllRequests.php' method='post'>
					   			<td colspan='4'><center><input type='submit' class='myButton' value='Accept'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					   </div>
  </body>
</html>