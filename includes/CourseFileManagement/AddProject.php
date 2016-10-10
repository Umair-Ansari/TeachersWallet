<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddProject
{
    
    private $c_id;
    private $total;
    private $date;

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
        
        $Query = "INSERT INTO project (p_sub_date,p_total,cf_id) VALUES ('{$this->date}','{$this->total}','{$this->c_id}') ";
        $result = $database->query($Query);
        if ($result) 
        {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Project Added</div>";
                header("Location: ../../user/project.php?course=".$this->c_id."");
        }
        else 
        {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/project.php?course=".$this->c_id."");
        }
        
    }  
}
$MyOBJECT = new AddProject;
$MyOBJECT->add();

?>