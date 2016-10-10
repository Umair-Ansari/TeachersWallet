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
			
if($role == "Student")
{
	header("Location: index.php");
}
require_once("../includes/database.php");
global $database;
$course = 0;
$count = 0;
$result = 0;
$total = 100;
$Query_user = "SELECT course FROM course_student WHERE c_id = ".$_GET['course']."";
$result_user = $database->query($Query_user);
while ( $row_user = mysqli_fetch_assoc($result_user)) 
{
	if($row_user['course'] > 0)
	{
		$course = $course + $row_user['course'];
		$count = $count + 1;
	}
}
if($course > 0)
{
	$result = $course / $count;
	$total = $total - $result;
}
?>
<!DOCTYPE html>
<html>
		<?php
			include("../includes/Utility/header.php");
		?>
		<STYLE TYPE="text/css">
	.canvasjs-chart-credit{
		display: none;
	}
	.teacher{
		outline: medium none;
		margin: 0px;
		position: absolute;
		right: 51px;
		top: 332px;
		color: #696969;
		text-decoration: none;
		font-size: 10px;
		font-family: Lucida Grande,Lucida Sans Unicode,Arial,sans-serif;
	}
	</STYLE>
		<script type="text/javascript">
		function best(){
			$('#best').bPopup({
    		easing: 'easeOutBack',
    	    speed: 450,
    	    transition: 'slideDown'
    		}); 
		};
		</script>
		<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			text: "Course Evaluation",
			fontFamily: "arial black"
		},
                animationEnabled: true,
		legend: {
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		theme: "theme1",
		data: [
		{        
			type: "pie",
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 20,
			indexLabelFontWeight: "bold",
			startAngle:0,
			indexLabelFontColor: "MistyRose",       
			indexLabelLineColor: "darkgrey", 
			indexLabelPlacement: "inside", 
			toolTipContent: "{name}: {y}%",
			showInLegend: true,
			indexLabel: "#percent%", 
			dataPoints: [
				{  y: <?php echo $result ?>, name: "Success", legendMarkerType: "triangle"},
				{  y: <?php echo $total ?>, name: "Failer", legendMarkerType: "square"}
			]
		}
		]
	});
	chart.render();
}
var newwindow;
function poptastic(url)
{
	newwindow=window.open(url,'name','height=350,width=1000');
	if (window.focus) {newwindow.focus()}
}
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
</script>
<script type="text/javascript" src="canvasjs.min.js"></script>
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
					
					if($role == "Teacher")
					{ ?>
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
					if($role == "Student")
					{?>
					<div class='nav_left'>
						<a href="courseFileStudent.php">
						<div class='item_nav_left'>Course</div>
						<div class='icon_nav_left'><span class='manage_meeting'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="addCourse.php">
						<div class='item_nav_left'>Add Course</div>
						<div class='icon_nav_left'><span class='course'></span></div>
						</a>
					</div>
					<div class='nav_left'>
						<a href="courseRequests.php">
						<div class='item_nav_left'>Course Requests</div>
						<div class='icon_nav_left'><span class='course_request'></span></div>
						</a>
					</div>
					<?php
					}
					 include("../includes/Utility/Developer.php");
					?>
				</div><!-- left -->
				<div class='middle_right'>
					<div class='middle' style='width:100%'>
						<div class='title_middle' style='margin-bottom: 2pt'><h2>Course Evaluation</h2> <?php echo $message ?></div>
						<?php 
						if($course == 0)
						{
						?>
							<center><h2>No Evaluation Found!</h2></center>
						<?php
						}
						else
						{ ?>
							
							<div id="chartContainer" style="height:300px; width:100%;">

							</div>
							<div id="chartContainer2" style="height:300px; width:100%;"></div>
							<div class='teacher'>
								Teacher's Wallet
							</div>
							<div style='position: absolute;top: 354px;'>
								<div class='blink_me'>
									<a href="javascript:poptastic('studentData.php?course=<?php echo $_GET['course'] ?> ');">Demographic Information</a>
								</div>
								
								<ul style='list-style-type:none;'>
									<li><br><b>Read Comments</b></li>
									<li><a onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" href='comments.php?comment=com_a&course=<?php echo $_GET['course'] ?>'>Course Content and Organization</a></li>
									<li><a onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" href='comments.php?comment=com_b&course=<?php echo $_GET['course'] ?>'>Student Contribution </a></li>
									<li><a onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" href='comments.php?comment=com_c&course=<?php echo $_GET['course'] ?>'>Learning Environment and Teaching Methods </a></li>
									<li><a onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" href='comments.php?comment=com_d&course=<?php echo $_GET['course'] ?>'>Learning Resources</a></li>
									<li><a onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" href='comments.php?comment=com_e&course=<?php echo $_GET['course'] ?>'>Quality of Delivery</a></li>
									<li><a onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" href='comments.php?comment=com_f&course=<?php echo $_GET['course'] ?>'>Assessment</a></li>
									<li><a onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" href='comments.php?comment=com_g&course=<?php echo $_GET['course'] ?>'>The best features of the Course were:</a></li>
									<li><a onMouseOver="this.style.color='blue'"  onMouseOut="this.style.color='black'" href='comments.php?comment=com_h&course=<?php echo $_GET['course'] ?>'>The Course could have been improved by:</a></li>
								</ul>
							</div>

						<?php
						}
						?>
					</div><!-- middle -->
					
				</div><!-- middle_right -->
			</div>
		</div><!-- container -->
		<div class='footer_container'>
			<div class='footer'><center style='color:white'>2015 Teacher's Wallet</center>
			</div><!-- footer -->
		</div><!-- footer container -->
					
  </body>
</html>