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
			
			
			$('#n_id').val(id);
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
					<div class='nav_left' >
						<a href="meeting.php">
						<div class='item_nav_left' >Meeting Management</div>
						<div class='icon_nav_left' ><span class='manage_meeting'></span></div>
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
					<div class='nav_left'style='background-color: #E1E2E3;'>
						
						<div class='item_nav_left' style='background-color: #E1E2E3;'>Notification</div>
						<div class='icon_nav_left'style='background-color: #E1E2E3;'><span class='notification'></span></div>
						
					</div>
					<?php } include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%;'>
						<div class='title_middle' style='margin-bottom: -0pt;'><h2>Notification<input type='button' value='New Notification' class='myButton'  onClick="meeting()" style='margin-left:10pt;'></h2><?php echo $message ?></div>
						
						<table style='width:100%;margin-top:2pt;'>
							

							<tr style="background-color:rgb(212, 206, 206)">
								<td style='border:1px solid black;padding:5pt;'>
									Title
								</td >
								<td style='border:1px solid black;padding:5pt;'>
									Teacher View
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									Student View
								</td>
								
									
									<td style='border:1px solid black;padding:5pt;'>
									Notification
									</td>
									
									<td style='border:1px solid black;padding:5pt;'>
										Delete
									</td>
								</tr>
							</tr>
							<?php
							$Query = "SELECT * FROM notification";
					        $result = $database->query($Query);
							while ( $row = mysqli_fetch_assoc($result)) 
							{
							?>
								<tr style="background-color:#EDF3F6;">
								<td style='border:1px solid black;padding:5pt;'>
									<?php echo $row['title']; ?>
								</td >
								<td style='border:1px solid black;padding:5pt;'>
									<?php 
										if($row['teacher'] == 1)
											echo "Yes";
										else
											echo "No"; 
									?>
								</td>
								<td style='border:1px solid black;padding:5pt;'>
									<?php 
										if($row['student'] == 1)
											echo "Yes";
										else
											echo "No"; 
									?>
								</td>
								<td style='border:1px solid black;padding:5pt;'>
										<!-- <a href='minutes.php?m_m_id=<?php echo $row['m_id']; ?>'>Menitus of Meeting</a> -->
									<?php if(is_dir("../includes/Notification/notification/".$row['n_id']."")){$dir = "../includes/Notification/notification/".$row['n_id']."";$files = scandir($dir, 0);for($i = 2; $i < count($files); $i++)echo "<a href='../includes/Notification/notification/".$row['n_id']."/".$files[$i]."' target='_blank'>View</a>";} else {echo "<button style='background=none;border:none;' onClick=file(".$row['n_id'].");>Upload</button>";}  ?>
								</td>
									
									<td style='border:1px solid black;padding:5pt;'>
										<input type='button' onClick='del(<?php echo $row['n_id'];?>);' value='Delete' style='border:none;background-color:none;text-decoration: underline;cursor: pointer;'>
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
						<form action='../includes/Notification/AddNotification.php' method='post' name='login' enctype='multipart/form-data'>
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>Title</span>
									</td>
									<td  style='vertical-align:top'>
										<input type='text' name='title' class="input-field" required   oninvalid="setCustomValidity('must contain date only in mm/dd/yyyy format.use calendar!')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top">
										<label for="field1"><span>Notification <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='file' class="input-field" required name='file' style='width: 122pt' accept="image/*" /></label>
										
									</td>
								</tr>
								<tr>
									<td  style='vertical-align:top'>
										<label for='field1'><span>For Teachers <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<select name='teacher' style='width: 104pt;height:25pt;margin-left:-5pt' class="select-field"><option value='1'>Yes</option><option value='0'>No</option></select></label>
									</td>
									<td  style='vertical-align:top;margin-left: 10pt;'>
										<label for='field1'><span>For Students <span class='required'>*</span></span>
									</td>
									<td  style='vertical-align:top'>
										<select name='student' style='width: 121pt;height:25pt;margin-left:-5pt' class="select-field"><option value='1'>Yes</option><option value='0'>No</option></select></label>
									</td>
								</tr>
								
								
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Create' class='myButton'></center></td>
								</tr>
							</form>
						</table>

					</div></div></div>	
					<div id="del" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Delete Notification</div>
					   	<form action='../includes/Notification/DeleteNotification.php' method='post' enctype='multipart/form-data'>
					   		
					   	<center>	<table>
					   			<tr>
					   				<td colspan='2'>Are Your Sure?</td>
					   			</tr>
					   		<tr>
					   			<input hidden type='text' id='n_id' name='n_id' />
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Yes'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   </center>
						</div>
					</div>			
  </body>
  </body>
</html>