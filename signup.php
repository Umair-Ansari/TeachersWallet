<?php
if(session_id() == '') {
    session_start();
}
$message = "";
if (isset($_SESSION["user"])) {
	 header("Location: user/index.php");
}
if (isset($_SESSION["Message"])) {
	$message = $_SESSION["Message"];
	unset($_SESSION["Message"]);
}


?>
<!DOCTYPE html>
<html>
	
		<?php
			include("includes/Utility/headers.php");
		?>
		<style>
			.form-style-2 input.input-field {
   				 width: 100%;
		}
		.form-style-2 label > span {
    		width: 134px;
    		margin-left: 5px;
    		font-weight: bold;
    		float: left;
    		padding-top: 8px;
    		padding-right: 5px;
		}
		div.ui-datepicker{
 font-size:10px;
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

        $('input[type="radio"]').click(function(){

            if($(this).attr("value")=="Student"){

                $(".box").not(".Student").hide();

                $(".Student").show();

            }

            if($(this).attr("value")=="Teacher"){

                $(".box").not(".Teacher").hide();

                $(".Teacher").show();

            }

            if($(this).attr("value")=="Worker"){

                $(".box").not(".Worker").hide();

                $(".Worker").show();

            }

        });

    });
	 function checkpass()
					    {
					    	var a = $("#country_selector").val();
					    	$('input[name="nationality"]').val(a);
					    	$(".error").hide();
					    	var hasError = false;
					    	var passwordVal = $("#txtNewPassword").val();
					    	var checkVal = $("#txtConfirmPassword").val();
					    	if (passwordVal == '') 
					    	{
					    		$("#a").html("<span style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Please enter a password.</span>");
					    		hasError = true;
					    	}
					    	else if (checkVal == '') 
					    	{
					    		$("#a").html("<span style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Please enter a confrom password.</span>");
					    		
					    		hasError = true;
					    	} 
					    	else if (passwordVal != checkVal ) 
					    	{
					    		$("#a").html("<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Password missmatch.</div>");
					    		
					    		hasError = true;
					    	}
					    	if(hasError == true) 
					    	{
					    		//alert("here");
					    		return false;
					    	}
					   
					    }
					     function checkpass_t()
					    {
					    	
					    	$(".error").hide();
					    	var hasError = false;
					    	var passwordVal = $("#t_txtNewPassword").val();
					    	var checkVal = $("#t_txtConfirmPassword").val();
					    	if (passwordVal == '') 
					    	{
					    		$("#a").html("<span style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Please enter a password.</span>");
					    		hasError = true;
					    	}
					    	else if (checkVal == '') 
					    	{
					    		$("#a").html("<span style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Please enter a confrom password.</span>");
					    		
					    		hasError = true;
					    	} 
					    	else if (passwordVal != checkVal ) 
					    	{
					    		$("#a").html("<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Password missmatch.</div>");
					    		
					    		hasError = true;
					    	}
					    	if(hasError == true) 
					    	{
					    		//alert("here");
					    		return false;
					    	}
					   
					    }
					       function checkpass_w()
					    {
					    	
					    	$(".error").hide();
					    	var hasError = false;
					    	var passwordVal = $("#w_txtNewPassword").val();
					    	var checkVal = $("#w_txtConfirmPassword").val();
					    	
					    	if (passwordVal == '') 
					    	{
					    		$("#a").html("<span style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Please enter a password.</span>");
					    		hasError = true;
					    	}
					    	else if (checkVal == '') 
					    	{
					    		$("#a").html("<span style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Please enter a confrom password.</span>");
					    		
					    		hasError = true;
					    	} 
					    	else if (passwordVal != checkVal ) 
					    	{
					    		$("#a").html("<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Password missmatch.</div>");
					    		
					    		hasError = true;
					    	}
					    	if(hasError == true) 
					    	{
					    		//alert("here");
					    		return false;
					    	}
					   
					    }
</script>
</script>
	</head>
	<body>

		
		<div class='container' style='height:500pt'>
			<div class='login_area' style='height:500pt'>
				<center style='margin-bottom:20pt;margin-top:10pt;'><P style='font-size:35pt;margin-bottom: -21pt;font-family:Abril'><b>Teacher's Wallet</b></P><br><i style='margin-left: 190pt;font-size: 8pt;'>powered by iiu</i></center>
					<center><a href='index.php'><button class='myButton' style="height: 17pt; padding-top: 0pt; margin-bottom: 4pt;">Login</button></a></center>
				<center style='margin-bottom:40pt;'>
				<div class='login' style='margin: 0pt 0pt 20pt 0pt;'>
					<div class="form-style-2" style='max-width: 630px;'>

						<table style='width: 444pt;'>
							<col width="80">
							<col width="130">
							<tr>
								
									
								
								<td  style="vertical-align:top;" colspan='4'>
									<center><div class="form-style-2-heading">Request For Account</div></center><br>
								</td>
							</tr>
							<tr>
								<td colspan='4'><div id='a'></div><?php echo $message ?></td>
							</tr>
							<tr>
								<td  style="vertical-align:top">
									<label for="field1" style="width: 28pt;" ><span>I am </span>
								</td>
								<td colspan='3'align='left' >
									Student <input type='radio' name='type' checked='checked' value='Student' >
									Teacher <input type='radio' name='type' value="Teacher" >
									Worker <input type='radio' name='type' value="Worker">
									</label>
								</td>
							</tr>
						</table>
							<table  class="Student box">
							<col width="130">
							<col width="130">
							<col width="130">
							<col width="130">
							<form action='includes/UserManagement/RegisterStudentBL.php' method='post' name='login' onsubmit='return checkpass()'>
							
								<tr>
									<td  style="vertical-align:top" >
										<label for="field1"><span>Register Number <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top" colspan='3'>
										<input type='text' name='register_no' class="input-field" required placeholder='0000' pattern='[0-9]{4}' style='width:33pt;'  oninvalid="setCustomValidity('must contain 4 numbers only')"  onchange="try{setCustomValidity('')}catch(e){}" />-FBAS/<select name='degree' style='width: 60pt;height:25pt;' class="select-field">
												<option>BS(CS)</option>
												<option>BS(SE)</option>
											</select>/<select name='session' style='width: 60pt;height:25pt;' class="select-field">
												<option>F15</option>
												<option>F14</option>
												<option>F13</option>
												<option>F12</option>
												<option>F11</option>
												<option>F10</option>
												<option>F09</option>
												<option>F08</option>
											</select></label>
									</td>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>First Name <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='fname' class="input-field" required placeholder='Esra' pattern="[a-zA-Z]{3,}" oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Last Name <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='lname' class="input-field" required placeholder='Brakat' pattern="[a-zA-Z]{3,}" oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>Date Of Birth <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='dob' class="input-field" required id='datepicker' placeholder='mm/dd/yyyy' pattern="[0-9]{2}/[0-9]{2}/[20|19]{2}[0-9]{2}" oninvalid="setCustomValidity('must contain date only in mm/dd/yyyy format.use calendar!')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Email <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='email' name='email' class="input-field" required placeholder='user@domain.com'></label>
									</td>
									<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>CNIC / B-Form</span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='cnic' class="input-field"  placeholder='00000-0000000-0' pattern='[0-9]{5}-[0-9]{7}-[0-9]{1}' name='contact' oninvalid="setCustomValidity('must contain a valid CNIC or B-Form number in 00000-0000000-0 format')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Contact <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top"><input type='text' class="input-field" required placeholder='03000000000' pattern='[03]{2}[0-9]{9}' name='contact' oninvalid="setCustomValidity('must contain 11 characters that are srart with 03 and contain number only')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>Password <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='password' name='password' id='txtNewPassword' class="input-field" required  placeholder='*******' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Confirm  Password <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='password' name='Cpassword' id='txtConfirmPassword' class="input-field" required  placeholder='*******' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
								</tr>	
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>Nationality <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' class="input-field" required id="country_selector" style='width: 122pt' /></label>
										<input name='nationality' style='display:none'>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>CPGA <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='cgpa' class="input-field" required placeholder='4.00' style='width: 122pt' pattern='[0-4]{1}.[0-9]{2}' name='contact' oninvalid="setCustomValidity('must contain your CGPA')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>Address <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top" colspan='3'>
										<textarea  class="textarea-field" name='address' style='width:344pt;' required ></textarea>
									</td>
								</tr>
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Request' class="myButton"></center></td>
								</tr>
							</form>
							</table>
						</table>
						<table  class="Teacher box" style='display:none; width: 450pt;'>
							<col width="130">
							<col width="130">
							<col width="130">
							<col width="130">
							<form action='includes/UserManagement/RegisterTeacherBL.php' method='post' name='login' onsubmit='return checkpass_t()'>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>First Name <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='fname' class="input-field" required placeholder='Esra' pattern="[a-zA-Z]{3,}" oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Last Name <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='lname' class="input-field" required placeholder='Brakat' pattern="[a-zA-Z]{3,}" oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Email <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='email' name='email' class="input-field" required placeholder='user@domain.com'></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Contact <span class="required">*</span></span> 
									</td>
									<td  style="vertical-align:top"><input type='text' class="input-field" required placeholder='03000000000' pattern='[03]{2}[0-9]{9}' name='contact' oninvalid="setCustomValidity('must contain 11 characters that are srart with 03 and contain number only')"onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>Password <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='password' name='password' id='t_txtNewPassword' class="input-field" required  placeholder='*******' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span style='width:134px;'>Confirm  Password <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='password' name='Cpassword' id='t_txtConfirmPassword' class="input-field" required  placeholder='*******' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>CNIC</span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='cnic' class="input-field"  placeholder='00000-0000000-0' pattern='[0-9]{5}-[0-9]{7}-[0-9]{1}' name='contact' oninvalid="setCustomValidity('must contain a valid CNIC number in 00000-0000000-0 format')" onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style="vertical-align:top">
										<label for="field1"><span>Gender</span>
									</td>
									<td>
										<select name='gender' style='width: 100pt;height:25pt;' class="select-field">
												<option>Male</option>
												<option>Female</option>
											</select></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Qualification <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top" colspan='3'>
										<select name='degree' style='width: 45pt;height:25pt;' class="select-field">
												<option>BS</option>
												<option>MS</option>
												<option>PHD</option>
											</select>
											<input type='text' name='qualification' style='width: 249pt;' class="input-field" required placeholder='Computer Science'></label>
									</td>
									
								</tr>
								<tr>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Office <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top" colspan='3'>
										<select name='session' style='width: 70pt;height:25pt;' class="select-field">
												<option>1st Floor</option>
												<option>2nd Floor</option>
												<option>3rd Floor</option>
											</select>
											<input type='text' name='rom' style='width: 223pt;' class="input-field" required placeholder='12'></label>
									</td>
									
								</tr>
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Request' class="myButton"></center></td>
								</tr>
							</form>
						</table>
						<table  class="Worker box" style='display:none; width: 444pt;'>
							<col width="130">
							<col width="130">
							<col width="130">
							<col width="130">
							<form action='includes/UserManagement/RegisterWorkerBL.php' method='post' name='login' onsubmit='return checkpass_w()'>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>First Name <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='fname' class="input-field" required placeholder='Esra' pattern="[a-zA-Z]{3,}" oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Last Name <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='lname' class="input-field" required placeholder='Brakat' pattern="[a-zA-Z]{3,}" oninvalid="setCustomValidity('must contain 3 or more letters only with no space')"  onchange="try{setCustomValidity('')}catch(e){}" /></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Email <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='text' name='email' class="input-field" required placeholder='user@domain.com'></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Shift <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<select name='shift' style='width: 97pt;height:25pt;' class="select-field">
												<option>Morning</option>
												<option>Evening</option>
											</select></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>Password <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='password' name='password' id='w_txtNewPassword' class="input-field" required  placeholder='*******' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
									<td  style="vertical-align:top;margin-left: 10pt;">
										<label for="field1"><span>Confirm  Password <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top">
										<input type='password' name='Cpassword' id='w_txtConfirmPassword' class="input-field" required  placeholder='*******' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')" onchange="try{setCustomValidity('')}catch(e){}" /></label></label>
									</td>
								</tr>
								<tr>
									<td  style="vertical-align:top">
										<label for="field1"><span>Designation <span class="required">*</span></span>
									</td>
									<td  style="vertical-align:top" colspan='3'>
										<input type='text' name='designation'  class="input-field" required  placeholder='clerck'  /></label></label>
									</td>
								</tr>	
								<tr>
									<td colspan='4'><br><center><input type='submit' value='Request' class="myButton"></center></td>
								</tr>
							</form>
						</table>
						
					
					</div><!-- form-style-2 -->
					</center>
					
				</div>
				
			</div>
			
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
		
		<script src="css/countrySelect.min.js"></script>
		<script>
			$("#country_selector").countrySelect({
				//defaultCountry: "jp",
				//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
				preferredCountries: ['pk', 'gb', 'us']
			});
		</script>
	</body>
</html>

