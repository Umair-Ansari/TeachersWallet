<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class UpdateAssignmentMarks
{
    
    private $c_id;
    private $as_id;
    private $marks;
    private $to_id;

    Private $Result;
	function __construct()
	{
        $this->c_id           = $_POST['c_id'];
        $this->as_id          = $_POST['as_id'];
        $this->marks          = $_POST['marks'];
        $this->to_id          = $_POST['to_id'];
    }
    public function update()
    {	
    	global $database;
        $Query_assignment_student = "SELECT assign_id FROM assignment_student WHERE as_id=$this->as_id ";
        $result_assignment_student = $database->query($Query_assignment_student);
        if ($row_assignment_student =  mysqli_fetch_assoc($result_assignment_student))
        {
            
            $Query_assignment = "SELECT assign_total FROM assignment WHERE assign_id=".$row_assignment_student['assign_id']." ";
            $result_assignment = $database->query($Query_assignment);
            if ($row_assignment =  mysqli_fetch_assoc($result_assignment))
            {
                $total = $row_assignment['assign_total'];
                if($this->marks > $total)
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Can not add more then total marks</div>";
                    header("Location: ../../user/assignment.php?course=".$this->c_id."");
                    die();
                }
            }
        }


        $Query = "Update assignment_student SET marks = '{$this->marks}' WHERE as_id = '{$this->as_id}' ";
        $result = $database->query($Query);
        if ($result) 
        {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Assignment Marks Updated</div>";
              header("Location: ../../user/assignment.php?course=".$this->c_id."");
        }
        else 
        {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/assignment.php?course=".$this->c_id."");
        }
        
    }  
}
$MyOBJECT = new UpdateAssignmentMarks;
$MyOBJECT->update();

?>