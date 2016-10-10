<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddQuiz
{
    
    private $c_id;
    private $total;
    private $date;
    private $user;
    Private $Result;
	function __construct()
	{
        $this->c_id           = $_POST['c_id'];
        $this->total          = $_POST['total'];
        $this->date           = $_POST['date'];
    }
    public function add()
    {	
    	global $database;
        $Query = "SELECT * FROM course_student WHERE c_id='$this->c_id' ";
        $result = $database->query($Query);
        while($row = mysqli_fetch_assoc($result))
        {
            $this->user = $row['u_id'];
            $Query2 = "SELECT to_id FROM total WHERE u_id='$this->user'";
            $result2 = $database->query($Query2);
            if($row2 = mysqli_fetch_assoc($result2))
            {}
            else
            {
                $Query3 = "INSERT INTO total (u_id) VALUES ('{$this->user}') ";
                $result3 = $database->query($Query3);
            }
        }  
        $Query = "INSERT INTO quizzes (q_date,q_total,cf_id) VALUES ('{$this->date}','{$this->total}','{$this->c_id}') ";
        $result = $database->query($Query);
        if ($result) 
        {
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Quiz Added</div>";
            header("Location: ../../user/quiz.php?course=".$this->c_id."");
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/quiz.php?course=".$this->c_id."");
        }
        
    }  
}
$MyOBJECT = new AddQuiz;
$MyOBJECT->add();

?>