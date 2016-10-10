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
$role = "";
if(isset($_SESSION["role"]))
	{
		$role 			= $_SESSION["role"];
	}
			
if($role != "Teacher")
{
	header("Location: index.php");
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
		function best(){
			$('#best').bPopup({
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
					<div class='nav_left'>
						<a href="newCourseFile.php">
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
						include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%'>
						<div class='title_middle' style='margin-bottom: 2pt'><h2><?php if ($_GET['action'] ==  "View"){ echo "Notes <button style='margin-left:2pt;'class='myButton' onClick=best();>Add</button>"; } else {echo "<a href='notes.php?course=".$_GET['course']."&action=View' >Notes</a>>Upload Notes";}?></h2> <?php echo $message ?></div>
						<ol style='padding-left:10pt'>
						<?php 
						if ($_GET['action'] ==  "View") 
						{
							if(is_dir("../includes/CourseFileManagement/course_files/Notes/".$_GET['course']."/"))
        					{
								$dir = "../includes/CourseFileManagement/course_files/Notes/".$_GET['course']."/";
								$files = scandir($dir, 0);
								for($i = 2; $i < count($files); $i++)
								{
						    	//echo  "<img src=".$dir.$files[$i]."  width='200pt' height='200pt'/>";
						    	echo  "<li><a href='".$dir.$files[$i]."' target='_blank'>".$files[$i]."</a></li>";
						    	}
						    	echo "</ol>";
							}
						
						
							
							else
							{
								echo "<center><h2 style='margin-top:5pt;margin-bttom:5pt'>No Notes Files Found in System!</h2></center><br>";
							}
						} else {
							
						?>
						<form action='../includes/CourseFileManagement/AddNotesFiles.php' method='post' enctype='multipart/form-data'>
							
							<input hidden type='text' name='course' value='<?php echo $_GET['course'] ?>'> 
							<table style='width:100%;margin-top:2pt;'>
							<col width='100'>
								<col width='70'>
								<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;'>
										File 
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Image File<sup>*</sup>
									</td >
								</tr>
								<?php 
								for($i=1;$i<=$_GET['file'];$i++)
								{ ?>

									<tr>
										<td>Notes Image #<?php echo $i ?></td>
										<td style='padding-left:2pt;'><input type='file' required name='<?php echo $i; ?>'></td>
									</tr>
								<?php
								}
								?>
								<tr>
									<td colspan='2'><br><center><input type='submit' class='myButton' value='Add'></center></td>
								</tr>
							</table>
						</form>
						
						<?php } 

						?>
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
							<div class="form-style-2-heading">Adding Notes</div>
					   	<form action='notes.php' method='get'>
					   		
					   		<table>
					   			<tr>
					   			<td><b>Number Of Files</b></td>
					   			<td style='padding-left:5pt'><input type='text' name='file' class="input-field" /></td>
					   		</tr>
					   		<tr>
					   			
					   			<input hidden type='text' name='course' value='<?php echo $_GET['course'] ?>' />
					   			<input hidden type='text' name='action' value='Add' />
					   			
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Continue'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					</div>
  </body>
</html>