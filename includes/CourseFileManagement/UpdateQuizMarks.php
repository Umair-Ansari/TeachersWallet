<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class UpdateQuizMarks
{
    
    private $c_id;
    private $qs_id;
    private $marks;
    private $to_id;

    Private $Result;
	function __construct()
	{
        $this->c_id           = $_POST['c_id'];
        $this->qs_id          = $_POST['qs_id'];
        $this->marks          = $_POST['marks'];
        $this->to_id          = $_POST['to_id'];
    }
    public function update()
    {	
    	global $database;
        $Query_quiz_student = "SELECT q_id FROM quiz_student WHERE qs_id=$this->qs_id ";
        $result_quiz_student = $database->query($Query_quiz_student);
        if ($row_quiz_student =  mysqli_fetch_assoc($result_quiz_student))
        {
            
            $Query_assignment = "SELECT q_total FROM quizzes WHERE q_id=".$row_quiz_student['q_id']." ";
            $result_assignment = $database->query($Query_assignment);
            if ($row_assignment =  mysqli_fetch_assoc($result_assignment))
            {
                $total = $row_assignment['q_total'];
                if($this->marks > $total)
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Can not add more then total marks</div>";
                    header("Location: ../../user/quiz.php?course=".$this->c_id."");
                    die();
                }
            }
        }
        $Query = "Update quiz_student SET marks = '{$this->marks}' WHERE qs_id = '{$this->qs_id}' ";
        $result = $database->query($Query);
        if ($result) 
        {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Quiz Marks Updated</div>";
              header("Location: ../../user/quiz.php?course=".$this->c_id."");
        }
        else 
        {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/quiz.php?course=".$this->c_id."");
        }
        
    }  
}
$MyOBJECT = new UpdateQuizMarks;
$MyOBJECT->update();

?>