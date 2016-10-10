<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddMidterm
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
        
        $Query = "INSERT INTO midterm (m_date,m_total,cf_id) VALUES ('{$this->date}','{$this->total}','{$this->c_id}') ";
        $result = $database->query($Query);
        if ($result) 
        {
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Midteam Paper Added</div>";
            header("Location: ../../user/midterm.php?course=".$this->c_id."");
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/midterm.php?course=".$this->c_id."");
        }
        
    }  
}
$MyOBJECT = new AddMidterm;
$MyOBJECT->add();

?>