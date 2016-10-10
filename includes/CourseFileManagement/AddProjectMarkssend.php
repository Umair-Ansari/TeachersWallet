<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddProjectMarkssend
{
    
    private $c_id;
    private $p_id;
    private $marks;
    private $user;

    Private $Result;
	function __construct()
	{
        $this->c_id           = $_POST['c_id'];
        $this->p_id           = $_POST['p_id'];
        $this->marks          = $_POST['marks'];
        $this->user           = $_POST['user'];
    }
    public function add()
    {	
    	global $database;
        $Query_project = "SELECT p_total FROM project WHERE p_id=".$this->p_id." ";
            $result_project = $database->query($Query_project);
            if ($row_project =  mysqli_fetch_assoc($result_project))
            {
                $total = $row_project['p_total'];
                if($this->marks > $total)
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Can not add more then total marks</div>";
                    header("Location: ../../user/project.php?course=".$this->c_id."");
                    die();
                }
            }

        $Query = "SELECT COUNT( to_id ) to_id FROM total WHERE u_id = '{$this->user}'";
        $result = $database->query($Query);
        $row = mysqli_fetch_assoc($result);
        if ($row['to_id'] == 0)
        {
            $Query = "INSERT INTO total (u_id,p_id,p_marks) VALUES ('{$this->user}','{$this->p_id}','{$this->marks}') ";
            $result = $database->query($Query);
            if ($result) 
            {
                $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Project Marks Added</div>";
                header("Location: ../../user/project.php?course=".$this->c_id."");
            }
            else 
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/project.php?course=".$this->c_id."");
            }
        }
        else
        {
            $Query = "UPDATE total SET p_id = '{$this->p_id}',p_marks='{$this->marks}'  WHERE u_id = '{$this->user}' ";
            $result = $database->query($Query);
            if ($result) 
            {
                $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Projetc Marks Updated</div>";
                header("Location: ../../user/project.php?course=".$this->c_id."");
            }
            else 
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/project.php?course=".$this->c_id."");
            }
        }
    }  
}
$MyOBJECT = new AddProjectMarkssend;
$MyOBJECT->add();

?>