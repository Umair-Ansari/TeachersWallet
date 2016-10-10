<?php
if(session_id() == '') {
    session_start();
}
$message = "";
if (isset($_SESSION["Message"])) 
{
	$message = $_SESSION["Message"];
	unset($_SESSION["Message"]);
}
$info = "";
if (isset($_SESSION["info"])) 
{
	$info = $_SESSION["info"];
	unset($_SESSION["info"]);
}
?>
<!DOCTYPE html>
<html>
	<head>
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
					<center><a href='index.php'><button class='myButton' style="height: 17pt; padding-top: 0pt; margin-bottom: 4pt;">Home</button></a></center>
				<center style='margin-bottom:40pt;'>
				<div class='login' style='margin: 0pt 0pt 20pt 0pt;'>
					<div class="form-style-2" style='max-width: 840px;'>
						<?php echo $message ?>
						<?php echo $info ?>
					
					</div><!-- form-style-2 -->
					</center>
					
				</div>
				
			</div>
			
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
		
  </body>
</html>