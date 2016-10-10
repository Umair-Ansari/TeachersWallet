<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddQuizMarks
{
    private $to_id;
    private $q_id;
    private $marks;
    Private $c_id;
    private $user;

    Private $Result;
    function __construct()
    {
        $this->to_id          = $_POST['to_id'];
        $this->q_id           = $_POST['q_id'];
        $this->marks          = $_POST['marks'];
        $this->c_id           = $_POST['c_id'];
    }
    public function add()
    {   
        global $database;
        $Query_assignment = "SELECT q_total FROM quizzes WHERE q_id=".$this->q_id." ";
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
        $Query = "INSERT INTO quiz_student (marks,q_id,to_id) VALUES ('{$this->marks}','{$this->q_id}','{$this->to_id}') ";
        $result = $database->query($Query);
        if ($result) 
        {
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Quiz Marks Added</div>";
            header("Location: ../../user/quiz.php?course=".$this->c_id."");
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/quiz.php?course=".$this->c_id."");
         }
            
    }  
}
$MyOBJECT = new AddQuizMarks;
$MyOBJECT->Add();

?>