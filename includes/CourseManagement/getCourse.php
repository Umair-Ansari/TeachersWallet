<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class getCourse
{
    Private $course;
    Private $Result;
    function __construct()
    {
        $this->course = $_POST['course'];
    }
    public function Get()
    {	
    	global $database;

    	$query = "SELECT * FROM course WHERE c_code  =$this->course ";
        $result = $database->query($query);
        if($row = mysqli_fetch_assoc($result))
        {
            $print  = "<br><br><table style='width:100%'>";
                $print .= "<tr>";
                    $print .= "<td colspan = '4' style='border-bottom:1px solid black'><center><h3>Course Details</h3></center></td>";
                $print .= "</tr>";
                $print .= "<tr>";
                    $print .= "<td colspan = '4' ><br></td>";
                $print .= "</tr>";
                $print .= "<tr>";
                    $print .= "<td style='width:75pt'>Course Name  </td>";
                    $print .= "<td> : ".$row['c_title']."</td>";
                    $print .= "<td  style='width:75pt'>Credit Hours  </td>";
                    $print .= "<td> : ".$row['c_hours']."</td>";
                $print .= "</tr>";
                $print .= "<tr>";
                    $print .= "<td style='width:75pt'>Program  </td>";
                    $print .= "<td> : ".$row['program']."</td>";
                    $print .= "<td  style='width:75pt'>Batch  </td>";
                    $print .= "<td> : ".$row['batch']."</td>";
                $print .= "</tr>";
                $Query_course_file = "SELECT * FROM course_file WHERE c_code  = ".$row['c_code']."";
                $result_course_file = $database->query($Query_course_file);
                if($row_course_file= mysqli_fetch_assoc($result_course_file))
                    {
                    $teacher = $row_course_file['u_id'];
                    $Query_user = "SELECT * FROM user WHERE u_id = {$teacher}";
                    $result_user = $database->query($Query_user);
                    if($row_user= mysqli_fetch_assoc($result_user))
                    {
                        $print .= "<tr>";
                            $print .= "<td style='width:75pt'>Taught By  </td>";
                            $print .= "<td> : ".$row_user['fname']." ".$row_user['lname']."</td>";
                            $print .= "<td  style='width:75pt'>Email  </td>";
                            $print .= "<td> : ".$row_user['email']."</td>";
                        $print .= "</tr>";
                    }
                }
                $print .= "<tr>";
                    $print .= "<td colspan = '4' ><br>I am conforming that i am student of International Islamic University.I am sending this <b>Course Registration Request</b> to my teacher and He/She have right to accept or reject my request.The Information i have provided in my <b>Profile</b> is valid and I will be responsible if my profile contains wrong information</td>";
                $print .= "</tr>";
                $print .= "<tr>";
                    $print .= "<td colspan='4'><center>Yes! I understand the risk and wish to continue  <input type='checkbox' id='checkbox'><center><br><br></td>";
                 $print .= "</tr>";
                $print .= "<tr>";
                    $print .= "<td colspan='4'><form action='../includes/CourseManagement/AddStudentRequest.php' method='post'><input type='text' name='c_code' hidden value='".$this->course."'><input type='text' id='u_id' name='u_id' style='display:none' /><center><input style='display:none' type='submit' id='accept' class='myButton' value='Send Request'></center></form></td>";
                 $print .= "</tr>";
            $print .= "</table>";
            echo $print;
        }
        else
        {
            echo "<center><h3>Error! no course found<br>PLease re-select a course from above drop down menue</h3></center>";
        }
        
    }  
}
$MyOBJECT = new getCourse;
$MyOBJECT->Get();

?>