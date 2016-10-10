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
		<script src='../css/jquery.timepicker.js'></script>
		<link href="../css/jquery.timepicker.css" rel="stylesheet" />
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
    
    //$("#start").timepicker();
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
				url: "../includes/MeetingManagement/GetData.php",
				dataType: 'json',
				data: "m_id="+ m_id ,
				success: function(html)
				{
					$('#update_date').val(html.date);
					$('#update_agenda').val(html.agenda);
					$('#update_start').val(html.starte);
					$('#update_end').val(html.end);
					$('#update_m_id').val(html.m_id);
					
				}
			});
			$('#update').bPopup({
    			easing: 'easeOutBack', //uses jQuery easing plugin
    	    	speed: 450,
    	    	transition: 'slideDown'
    		});		
		};
		function file(id){
			
			
			$('#mm').val(id);
			 	$('#file').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		function del(id){
			
			
			$('#m_id').val(id);
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
					<div class='nav_left' style='background-color: #E1E2E3;'>
						<div class='item_nav_left' style='background-color: #E1E2E3;'>Meeting Management</div>
						<div class='icon_nav_left' style='background-color: #E1E2E3;'><span class='manage_meeting'></span></div>
						
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
					 include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%;'>
						<div class='title_middle' style='margin-bottom: -0pt;'><h2>Meetings<input type='button' value='New Meeting' class='myButton'  onClick="meeting()" style='margin-left:10pt;'></h2><?php echo $message ?></div>
						
						<table style='width:100%;margin-top:2pt;'>
							<col width='100'>
							<col width='120'>
							<col width='150'>
							<col width='150'>
							<col width='150'>

							<col width='80'>
							<col width='80'>

							<tr style="background-color:rgb(212, 206, 206)">
								<td style='border:1px solid black;padding:5pt;'>
									Meeting Date
								</td >
								<td style='border:1px solid black;padding:5pt;'>
									Meeting Agenda
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Meeting Start Time
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Meeting End Time
								</td>
									
									<td style='border:1px solid black;padding:5pt;'>
									Minutes of Meeting
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
							$Query = "SELECT * FROM meeting";
					        $result = $database->query($Query);
							while ( $row = mysqli_fetch_assoc($result)) 
							{
							?>
								<tr style="background-color:#EDF3F6;">
								<td style='border:1px solid black;padding:5pt;'>
									<?php echo $row['m_date']; ?>
								</td >
								<td style='border:1px solid black;padding:5pt;'>
									<?php echo $row['m_agenda']; ?>
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									<?php echo $row['st_time']; ?>
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									<?php echo $row['app_end_time']; ?>
								</td>
									
									<td style='border:1px solid black;padding:5pt;'>
										<!-- <a href='minutes.php?m_m_id=<?php echo $row['m_id']; ?>'>Menitus of Meeting</a> -->
										<?php if(is_dir("../includes/MeetingManagement/meeting/".$row['m_id']."")){$dir = "../includes/MeetingManagement/meeting/".$row['m_id']."";$files = scandir($dir, 0);for($i = 2; $i < count($files); $i++)echo "<a href='../includes/MeetingManagement/meeting/".$row['m_id']."/".$files[$i]."' target='_blank'>Download</a>";} else {echo "<button style='background=none;border:none;' onClick=file(".$row['m_id'].");>Upload</button>";}  ?>
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										<button   onClick="update(<?php echo $row['m_id']; ?>);" style='border:none;background-color:none;text-decoration: underline;cursor: pointer;'>update</button>
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										<input type='button' onClick='del(<?php echo $row['m_id'];?>);' value='Delete' style='border:none;background-color:none;text-decoration: underline;cursor: pointer;'>
									</td>
								</tr>
							</tr>
							<?php
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
		<div id="popup" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='max-width: 630px;'>
						
						<table  style='width: 444pt;' >
							<col width='130'>
							<col width='130'>
							<col width='130'>
							<col width='130'>
						<form action='../includes/MeetingManagement/CreateMeeting.php' method='post' name='login' >
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>Date</span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='date' class="input-field" required id='datepicker' placeholder='mm/dd/yyyy' pattern="[0-9]{2}/[0-9]{2}/[20|19]{2}[0-9]{2}" oninvalid="setCustomValidity('must contain date only in mm/dd/yyyy format.use calendar!')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top">
										<label for="field1"><span>Agenda <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' class="input-field" required name='agenda' style='width: 122pt' /></label>
										<input name='nationality' hidden>
									</td>
								</tr>
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>Start Time <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='start' class="input-field" required id='start' placeholder='hh:mm'  pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" oninvalid="setCustomValidity('must contain Time 00:00')"  onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>End Time <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='end' class='input-field' required placeholder='hh:mm'  placeholder='hh:mm'  pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" oninvalid="setCustomValidity('must contain Time 00:00')"  onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
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
						<form action='../includes/MeetingManagement/UpdateMeeting.php' method='post' name='login' >
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>Date</span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='update_date' id='update_date' class="input-field" required id='datepicker' placeholder='mm/dd/yyyy' pattern="[0-9]{2}/[0-9]{2}/[20|19]{2}[0-9]{2}" oninvalid="setCustomValidity('must contain date only in mm/dd/yyyy format.use calendar!')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top">
										<label for="field1"><span>Agenda <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' class="input-field" id='update_agenda' required name='update_agenda' style='width: 122pt' /></label>
										<input name='nationality' hidden>
									</td>
								</tr>
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>Start Time <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='update_start' id='update_start' class="input-field" required  pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" oninvalid="setCustomValidity('must contain Time 00:00')"  onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>End Time <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='update_end' class='input-field' required id='update_end' placeholder='hh:mm'  pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$"  oninvalid="setCustomValidity('must contain Time 00:00')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								
								
								<tr>
									<input type='text' id='update_m_id' name='update_m_id' hidden>
									<td colspan='4'><br><center><input type='submit' value='Update' class='myButton'></center></td>
								</tr>
							</form>
						</table>

					</div></div></div>
					<div id="file" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Add Minutes of Meeting</div>
					   	<form action='../includes/MeetingManagement/AddMeetingFile.php' method='post' enctype='multipart/form-data'>
					   		
					   		<table>
					   			<tr>
					   			<td><b>Minutes</b></td>
					   			<td style='padding-left:5pt'><input type='file' name='file' required class="input-field"  accept="image/*" /></td>
					   		</tr>
					   		<tr>
					   			<input hidden type='text' id='mm' name='m_id' />
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Upload'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					</div>
					<div id="del" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Delete Meeting</div>
					   	<form action='../includes/MeetingManagement/DeleteMeeting.php' method='post' enctype='multipart/form-data'>
					   		
					   		<table>
					   			<tr>
					   				<td colspan='2'>Are Your Sure?</td>
					   			</tr>
					   		<tr>
					   			<input hidden type='text' id='m_id' name='m_id' />
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Yes'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					</div>
  </body>
  </body>
</html>