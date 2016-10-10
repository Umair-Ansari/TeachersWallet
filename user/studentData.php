<?php
require_once("../includes/database.php");
global $database;
$full = 0;
 $part = 0;
 $male = 0;
 $fmale = 0;
 $disable = 0;
 $distance = 0;
$Query_user = "SELECT * FROM information WHERE cf_id = ".$_GET['course']."";
$result_user = $database->query($Query_user);
if ( $row_user = mysqli_fetch_assoc($result_user)) 
{
 $full = $row_user['full'];
 $part = $row_user['part'];
 $male = $row_user['male'];
 $fmale = $row_user['fmale'];
 $disable = $row_user['disable']; 
 $distance = $row_user['distance']; 
}

?>
<!DOCTYPE HTML>
<html>
<?php
      include("../includes/Utility/header.php");
    ?>
<head>
	<STYLE TYPE="text/css">
	.canvasjs-chart-credit{
		display: none;
	}
	.teacher{
		outline: medium none;
		margin: 0px;
		position: absolute;
		right: 12px;
		top: 297px;
		color: #696969;
		text-decoration: none;
		font-size: 10px;
		font-family: Lucida Grande,Lucida Sans Unicode,Arial,sans-serif;
	}
	</STYLE>
	<script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Demographic Student's Evaluation"    
      },
      animationEnabled: true,
      axisY: {
        title: "Number OF Students"
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [

      {        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: " ",
        dataPoints: [      
        {y: <?php echo $full ?>, label: "Full Time Study"},
        {y: <?php echo $part ?>,  label: "Part Time Study" },
        {y: <?php echo $disable ?>,  label: "Disabled"},
        {y: <?php echo $male ?>,  label: "Male"},
        {y: <?php echo $fmale ?>,  label: "Female"},
        {y: <?php echo $distance ?>, label: "Distance Learning/ Collaborative"}       
        ]
      }   
      ]
    });

    chart.render();
  }
  </script>

		<script type="text/javascript" src="canvasjs.min.js"></script>
	</head>
<body>
	<div id="chartContainer" style="height:300px; width:100%;">

	</div>
	<div id="chartContainer2" style="height:300px; width:100%;"></div>
	<div class='teacher'>
		Teacher's Wallet
	</div>
</body>

</html>
    