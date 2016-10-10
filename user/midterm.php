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
		<script>
  $(function() {
    $( "#datepicker" ).datepicker();
    $( "#anim" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  });
  </script>
		

		
		<script type="text/javascript">
		function adMidterm(){
    	 	$('#popup').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		function add(user,fname,lname,reg_no,m_id){
			
			$('#user').val(user);
			$('#fname').html(fname);
			$('#lname').html(lname);
			$('#reg_no').html(reg_no);
			$('#m_id').val(m_id);
    	 	$('#popupa').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		function update(user,fname,lname,reg_no,m_id,marks){
			
			$('#user_update').val(user);
			$('#marks_update').val(marks);
			$('#fname_update').html(fname);
			$('#lname_update').html(lname);
			$('#reg_no_update').html(reg_no);
			$('#m_id_update').val(m_id);
    	 	$('#popupb').bPopup({
    			easing: 'easeOutBack',
    	    	speed: 450,
    	    	transition: 'slideDown'
    		}); 
		};
		function best(c){
			
			$('#typename').html(c);
			$('#type').val(c);
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
						<div class='lower_text_welcome_logout' style='color: #F3F3F3;text-shadow: 0px 0px 2px #D2EBFA;'><a href="index.php"  style='color: #E1E2E3;'>Dashbord</a> | <a href="../includes/UserManagement/LogOutBL.php" style='color: #E1E2E3;'>Logout</a></div>
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
						<div class='title_middle' style='margin-bottom:0pt;'><h2>Midterm</h2><?php echo $message ?></div>
						
							<?php
							if(isset($_GET['add']))
							{?>
								<div class="form-style-2" style='max-width: 1000px;'>
								<form action='' method='post'>

							<?php
							}
							$total 		= 0;
							$obtained	= 0;
							$percent 	= 0;
							$Query = "SELECT *  FROM midterm WHERE cf_id =".$c_id."";
					        $result = $database->query($Query);
					        if($row = mysqli_fetch_assoc($result))
					        {  	
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

							       			<center><h3><u>Mid Term Result</u></h3></center>
								        	<b>Course Title :</b>    <?php echo $row_course['c_title'];	?><br>														
								        	<b>Class :</b> <?php echo $row_class['programm_name'] ?><br>
								        	<b>Batch :</b> <?php echo $row_class['batch_name'] ?><br>														
								        	<b>Instructor Name :</b> <?php echo $_SESSION["fname"]." ".$_SESSION["lname"]; ?>	<br>
								        	<b>Date :</b>  <?php echo $row['m_date']; ?>	<br>
								        	<b>Total :</b> <?php echo $total = $row['m_total']; ?> <br>
								        	<b>Best Solution :</b> <?php if(is_dir("../includes/CourseFileManagement/course_files/Midterm/".$row['m_id']."/best/")){echo "<a href='midtermFiles.php?course=$c_id&type=Best&action=View&term=".$row['m_id']."'>View</a>";} else {echo "<button style='background=none;border:none;' onClick=best('Best');>Add</button>";}  ?> <br>
								        	<b>Worst Solution :</b> <?php if(is_dir("../includes/CourseFileManagement/course_files/Midterm/".$row['m_id']."/worst/")){echo "<a href='midtermFiles.php?course=$c_id&type=Worst&action=View&term=".$row['m_id']."'>View</a>";} else {echo "<button style='background=none;border:none;' onClick=best('Worst');>Add</button>";}  ?> <br>
								        	<br>
						       			<?php
						       			$total = $row['m_total'];
						       			}

					       			} 
					       		}
					       		
					        	?>
					    																
					        <table style='width:100%;margin-top:2pt;'>
								<col width='100'>
								<col width='100'>
								<col width='100'>
								<col width='100'>
								<tr style="background-color:rgb(212, 206, 206)">
									<td style='border:1px solid black;padding:5pt;width:120pt'>
										Registration #
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										First Name
									</td >
									<td style='border:1px solid black;padding:5pt;'>
										Last Name
									</td >
									<td style='border:1px solid black;padding:5pt;' id='test' contenteditable="true">
										Marks
									</td>
									<td style='border:1px solid black;padding:5pt;'>
										%
									</td>
								</tr>
							<?php
								$Query1 = "SELECT *  FROM course_student WHERE c_id =".$c_id."";
						        $result1 = $database->query($Query1);
						        while($row1 = mysqli_fetch_assoc($result1))
						        {
						        	
									$obtained	= 0;
									$percent 	= 0;
						        	$Query2 = "SELECT * FROM student WHERE u_id =".$row1['u_id']."";
							        $result2 = $database->query($Query2);
							        if($row2 = mysqli_fetch_assoc($result2))
							        { ?>
						        	<tr>
						        		<td>
						        			<?php echo $reg_no = $row2['Reg_no'] ?>
						        		</td>
						       	<?php
						       		}

									$Query2 = "SELECT * FROM user WHERE u_id =".$row1['u_id']."";
							        $result2 = $database->query($Query2);
							        if($row2 = mysqli_fetch_assoc($result2))
							        {
							    ?>
										<td>
						        			<?php echo $row2['fname'] ?>
						        		</td>
						        		<td>
						        			<?php echo $row2['lname'] ?>
						        		</td>
										<td>
											<?php
											if(isset($_GET['add']))
											{?>
												<input type='text' class="input-field" style='width:100%' name='<?php echo $row1['u_id'] ?>'>

											<?php
											}
								       		else
								       		{
												$Query3 = "SELECT m_marks FROM total WHERE u_id =".$row1['u_id']." AND m_id =".$row['m_id']." ";
										        $result3 = $database->query($Query3);
										        if($row3 = mysqli_fetch_assoc($result3))
										        { ?> 
										        	<button style='background:none;border:none;cursor:pointer;' onClick="update('<?php echo $row1['u_id'] ?>','<?php echo $row2['fname'] ?>','<?php echo $row2['lname'] ?>','<?php echo $reg_no ?>','<?php echo $row['m_id'] ?>','<?php echo $row3['m_marks'] ?>');" ><?php echo $row3['m_marks'] ?> </button>
										        <?php
										        $obtained = $row3['m_marks'];
										        }
										        else
										        {
										        	
										        ?>
										    		<button style='background:none;border:none;cursor:pointer;' onClick="add('<?php echo $row1['u_id'] ?>','<?php echo $row2['fname'] ?>','<?php echo $row2['lname'] ?>','<?php echo $reg_no ?>','<?php echo $row['m_id'] ?>');" >---</button>
										    	<?php }
										    } ?>
										</td>
										<td  style='padding:5pt;width:45pt'>
											<?php 
											if($obtained > 0)
											{
												$percent = ($obtained/$total)*100;
											}
											echo round( $percent, 1)."%";
											?>
										</td>		
									</tr>
									<?php }
								} ?>
							</table>
							<?php 
							
							}
							else
							{
							?>
							<center>
								<h2 style='margin-top:5pt;margin-bttom:5pt'>No Midterm Result Found in System!</h2><br>
								<input type='button' value='Add Midterm Paper' onClick='adMidterm();' class='myButton'   style='margin-left:10pt;'>
							</center>
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
		 <div id="popup" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Add New Midteam Result</div>
					   	<form action='../includes/CourseFileManagement/AddMidterm.php' method='post' enctypt="multipart/from-data">
					   		<input type='text' id='att_id' name='update_att_id' hidden> 
					   		<input type='text' value='<?php echo $c_id ?>' name='c_id' hidden> 
					   		<table>
					   		  		
					   		<tr>
					   			<td><label for="field1" style='margin-left: -12pt;'><span>Date <span class="required">*</span></span></td>
					   			<td style='padding:0pt 5pt 0pt 5pt'><input type='text' name='date' id='datepicker' class="input-field"  required pattern="[0-9]{2}/[0-9]{2}/[20|19]{2}[0-9]{2}" oninvalid="setCustomValidity('must contain date only in mm/dd/yyyy format.use calendar!')" onchange="try{setCustomValidity('')}catch(e){}" /></lable></td>
					   			<td><label for="field1" style='margin-left:8pt' required><span>Total Marks <span class="required">*</span></span></td>
					   			<td style='padding:0pt 5pt 0pt 5pt'><input type='text' name='total' required class="input-field" pattern='[1-9]{1}[0-9]{1,}' oninvalid="setCustomValidity('must contain number only')" onchange="try{setCustomValidity('')}catch(e){}"></lable></td>
					   		</tr>
					   		<!--
					   		<tr>
					   			<td><label for="field1" style='margin-left: -12pt;'><span>File <span class="required"></span></span></td>
					   			<td conspan='3'  style='padding:0pt 0pt 0pt 5pt;margin-left: -12pt;overflow:hidden'><input type='file' name='paper_mid' accept=".pdf" /> </lable></td>
					   		</tr> -->
					   		<tr>	
					   			<td colspan='4'><br><center><input type='submit' class='myButton' value='Add'></center></td>
					   		
					   		</tr>
					   		</form>
					   		</table>
					   
						</div>
					   </div>
		 <div id="popupa" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div id='aa'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Add Marks Midterm Result</div>
					   	<form action='../includes/CourseFileManagement/AddMidtermMarkssend.php' method='post' >
					   		<input type='text' id='m_id' name='m_id' hidden> 
					   		<input type='text' id='user' name='user' hidden> 
					   		<input type='text' id='total' name='total' value='<?php echo $total ?>' hidden> 
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
					   			<td><b>Total</b></td>
					   			<td><?php echo $total ?></td>
					   			<td><b>Marks</b></td>
					   			<td>
					   				<input type='text' name='marks' id='obtained' required class="input-field" pattern='[0-9]{1,}' oninvalid="setCustomValidity('must contain number only')" onchange="try{setCustomValidity('')}catch(e){}" >
					   			</td>
					   		<tr>
					   			
					   			<td colspan='4'><center><input type='submit' class='myButton' value='Add'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					   </div>
		 <div id="popupb" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div id='aab'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Update Marks Midterm Result</div>
					   	<form action='../includes/CourseFileManagement/UpdateMidtermMarks.php' method='post' >
					   		<input type='text' id='m_id_update' name='m_id' hidden> 
					   		<input type='text' id='user_update' name='user' hidden>
					   		<input type='text' id='totalb' name='total' value='<?php echo $total ?>' hidden>
					   		<input type='text' value='<?php echo $c_id ?>' name='c_id' hidden> 
					   		<table>
					   		<tr>
					   			<td><b>Reg #</b></td>
					   			<td id='reg_no_update' style='padding-left:5pt'></td>
					   		</tr>	   		
					   		<tr>
					   			<td><b>First Name</b></td>
					   			<td id='fname_update' style='padding-left:5pt'></td>
					   			<td><b>Last Name</b></td>
					   			<td id='lname_update' style='padding-left:5pt'></td>
					   		</tr>
					   		<tr>
					   			<td><b>Total</b></td>
					   			<td><?php echo $total ?></td>
					   			<td><b>Marks</b></td>
					   			<td>
					   				<input type='text' id='marks_update' name='marks'   required class="input-field" pattern='[0-9]{1,}' oninvalid="setCustomValidity('must contain number only')" onchange="try{setCustomValidity('')}catch(e){}"
					   			</td>
					   		<tr>
					   			
					   			<td colspan='4'><center><input type='submit' class='myButton' value='Update'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					   </div>
			<div id="best" class='a' style="display:none; background:#F6F7F8; float:left;padding:15pt 15pt 0pt 15pt;">
						<div class='pop_header'></div>
						<div class='form-style-2' style='margin-top:-18pt;'>
							<div class="form-style-2-heading">Add <span id='typename'></span> Case Images Midteam Result</div>
					   	<form action='midtermFiles.php' method='get'>
					   		
					   		<table>
					   			<tr>
					   			<td><b>Number Of Images</b></td>
					   			<td style='padding-left:5pt'><input type='text' name='file' class="input-field"  pattern='[0-9]{1,}' /></td>
					   		</tr>
					   		<tr>
					   			<input hidden type='text' name='course' value='<?php echo $c_id ?>' />
					   			<input hidden type='text' name='type' id='type' />
					   			<input hidden type='text' name='action' value='Add' />
					   			<input hidden type='text' name='term' value='<?php echo $row['m_id'] ?>' />
					   			
					   			<td colspan='2'><center><br><input type='submit' class='myButton' value='Continue'></center></td>
					   		</form>
					   		</tr>
					   		</table>
					   
						</div>
					   </div>
  </body>
</html>
