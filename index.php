<?php
if(session_id() == '') 
{
    session_start();
}
$message = "";
if (isset($_SESSION["user"]))
{
	 header("Location: user/index.php");
}
if (isset($_SESSION["Message"])) 
{
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
    		width: 130px;
    		font-weight: bold;
    		float: left;
    		padding-top: 8px;
    		padding-right: 5px;
		}
		</style>
	</head>
	<body>
		<div class='container'>

			<div class='login_area'>
				
				<center style='margin-bottom:40pt;margin-top:50pt;'><P style='font-size:35pt;margin-bottom: -21pt;font-family:Abril'><b>Teacher's Wallet</b></P><br><i style='margin-left: 190pt;font-size: 8pt;'>powered by iiu</i></center>
				<div class='login'>
					<?php echo $message ?>
					<div class="form-style-2" style='display: inline-block;padding-left:126px;'>
				
				
					<form action='includes/UserManagement/LoginBL.php' method='post' name='login'>
						<table>
							<col width="130">
							<tr>
								<td  style="vertical-align:top;" colspan='2'>
									<center><div class="form-style-2-heading">Login</div></center><br>
								</td>
							</tr>
							<tr>
								<td colspan='4'></td>
							</tr>
							<tr>
								<td  style="vertical-align:top"><label for="field1"><span>Email <span class="required">*</span></span></td>
								<td  style="vertical-align:top"><input type='email' name='email' class="input-field" required placeholder='user@domain.com'></label></td>
							</tr>
							<tr>
								<td  style="vertical-align:top"><label for="field1"><span>Password <span class="required">*</span></span></td>
								<td  style="vertical-align:top"><input type='password' name='password' class="input-field" required placeholder='*********' oninvalid="setCustomValidity('must contain 8 to 10 characters that are of at least one number, and one uppercase and lowercase letter')"
    onchange="try{setCustomValidity('')}catch(e){}" /></label></td>
							</tr>
							<tr>
								<td><a href="forget.php" style='text-decoration:underline; font-size:9pt;'>Forget Password</a></td>
							</tr>
							<tr>
								<td colspan='2'><br><center><input type='submit' value='Login' class="myButton"></center></td>
							</tr>
						</table>
					</form>
					</div><!-- form-style-2 -->
					
					<div class='signup'>
						<div style='border-left: 2px solid rgb(221, 221, 221);padding-left: 26pt;height:140pt;'>
							<center><div class="form-style-2-heading">Sign Up</div></center>
							<p style='margin-top:-9pt;font-size: 9pt;'><br><center><u>Dont Have Account?</u></center>Students,Teacher and Staff members from IIU can join us for free.
							</p><br><br>
							<center><form action='signup.php'><input type='submit' value='Sign Up' class="myButton"></from></center>
						</div>
					</div><!-- signup -->
				</div>
				
			</div>
			
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
		
  </body>
</html>