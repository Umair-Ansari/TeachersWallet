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
$m_id = "";
if(isset($_GET['m_m_id']))
{
	$m_id = $_GET['m_m_id'];
}
else
{
	header("Location: ../index.php");
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
   				 margin-left: -5pt;
		}
		.form-style-2 label > span {
    		width: 130px;
    		font-weight: bold;
    		float: left;
    		padding-top: 8px;
    		padding-right: 5px;
		}
		</style>
		<script>
		$(function() {
    $( "#datepicker" ).datepicker();
    $( "#anim" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    
   
    });
});
    
$(document).ready(function(){
    $("#pass").click(function(){
	    	
	    	     $("#show").show();
	    	
	    	   
	    	});
		});
function meeting(){
			$('#popup').bPopup({
    			easing: 'easeOutBack', //uses jQuery easing plugin
    	    	speed: 450,
    	    	transition: 'slideDown'
    		});
		}
		function update(m_id)
		{
				
			$.ajax(
			{
				type: "POST",
				url: "../includes/MeetingManagement/GetMinutes.php",
				dataType: 'json',
				data: "mm_id="+ m_id ,
				success: function(html)
				{
					$('#update_desition').val(html.desition);
					$('#update_descession').val(html.descession);
					$('#update_mm_id').val(html.mm_id);
					
				}
			});
			$('#update').bPopup({
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
					<!--
					<div class='nav_left'>
						<a href="bnner.html">
						<div class='item_nav_left'>Manage User</div>
						<div class='icon_nav_left'><span class='manage_user'></span></div>
						</a>
					</div>
					-->
					<?php 
						include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%;'>
						<div class='title_middle' style='margin-bottom: -0pt;'><h2>Meeting Minutes<input type='button' value='New Meeting Minutes' class='myButton'  onClick="meeting()" style='margin-left:10pt;'></h2><?php echo $message ?></div>
						<center>
								<table style="margin:5pt 0pt 5pt 0pt;">
								<col width='200'>
								<col width='200'>
								<col width='200'>
								<col width='200'>
								<tr>
									<td colspan='4'><center><h2><u>Meeting Details</u></h2></center></td>
								</tr>
								<?php
								$Query = "SELECt * FROM meeting WHERE m_id = '{$m_id}' ";
						        $result = $database->query($Query);
								if ( $row = mysqli_fetch_assoc($result)) 
								{ ?>
								<tr>
									<td><b>Date</b></td>
									<td><?php echo $row['m_date']; ?></td>
									<td><b>Agenda</b></td>
									<td><?php echo $row['m_agenda']; ?></td>
								</tr>
								<tr>
									<td><b>Start Date</b></td>
									<td><?php echo $row['st_time']; ?></td>
								
									<td><b>End Date</b></td>
									<td><?php echo $row['app_end_time']; ?></td>
								</tr>
								<?php
								}
								?>
							</table>
						
						<table style='width:100%;margin-top:7pt;'>
							<col width='450'>
							<col width='220'>
							<col width='150'>
							<col width='150'>
							<col width='150'>

							<col width='80'>
							<col width='80'>

							<tr style="background-color:rgb(212, 206, 206)">
								<td style='border:1px solid black;padding:5pt;'>
									Meeting Desition
								</td >
								<td style='border:1px solid black;padding:5pt;'>
									Meeting Descession 	
								</td>
								
									<td style='border:1px solid black;padding:5pt;'>
										Update
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										Delete
									</td>
								</tr>
							</tr>
							<?php
							$Query = "SELECT * FROM m_meeting WHERE m_id = '{$m_id}' ";
					        $result = $database->query($Query);
							while ( $row = mysqli_fetch_assoc($result)) 
							{
							?>
								<tr style="background-color:#EDF3F6;">
								<td style='border:1px solid black;padding:5pt;'>
									<?php echo $row['desition']; ?>
								</td >
								<td style='border:1px solid black;padding:5pt;'>
									<?php echo $row['descession']; ?>
								</td>
								
									<td style='border:1px solid black;padding:5pt;'>
										<button   onClick="update(<?php echo $row['mm_id']; ?>);" style='border:none;background-color:none;text-decoration: underline;cursor: pointer;'>update</button>
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										<form action='../includes/MeetingManagement/DeleteMinustes.php' method='post'><input type='text' name='m_id' hidden value="<?php echo $m_id ?>" ><input type='submit' value='Delete' style='border:none;background-color:none;text-decoration: underline;cursor: pointer;'><input type='text' name='mm_id' value="<?php echo $row['mm_id'];?>" hidden></form>
									</td>
								</tr>
							</tr>
							<?php
							}
							?>
						</table>
						</center>
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
						<div class='form-style-2' style='max-width: 630px;'>
						
						<table  style='width: 444pt;' >
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<col width='130'>
						<form action='../includes/MeetingManagement/CreateMinutesMeeting.php' method='post' name='login' >
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>Desition</span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='desition' class="input-field" required  oninvalid="setCustomValidity('must contain date only in mm/dd/yyyy format.use calendar!')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top">
										<label for="field1"><span>Descession <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='m_id' hidden value="<?php echo $m_id ?>" >
										<input type='text' class="input-field" required name='descession' style='width: 122pt' /></label>
										<input name='nationality' hidden>
									</td>
								</tr>
								
								
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Create' class='myButton'></center></td>
								</tr>
							</form>
						</table>

					</div></div></div>
					<div id="update" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='max-width: 630px;'>
						
						<table  style='width: 444pt;' >
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<col width='130'>
						<form action='../includes/MeetingManagement/UpdateMinutes.php' method='post' name='login' >
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>Desition</span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='update_desition' id='update_desition' class="input-field" required  oninvalid="setCustomValidity('must contain date only in mm/dd/yyyy format.use calendar!')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top">
										<label for="field1"><span>Descession <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' class="input-field" id='update_descession' required name='update_descession' style='width: 122pt' /></label>
										
									</td>
								</tr>
								
								<tr>
									<input type='text' id='update_mm_id' name='update_mm_id' hidden>
									<input type='text' value="<?php echo $m_id ?>" name='update_m_id' hidden>
									<td colspan='4'><br><center><input type='submit' value='Update' class='myButton'></center></td>
								</tr>
							</form>
						</table>

					</div></div></div>
  </body>
</html>