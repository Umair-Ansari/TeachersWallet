<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class CreateMeeting
{
    Private $desition;
    Private $descession;
    Private $mm_id;
    Private $m_id;
    Private $Result;
    function __construct()
    {
        $this->desition = $_POST['update_desition'];
        $this->descession = $_POST['update_descession'];

        $this->mm_id = $_POST['update_mm_id'];
        $this->m_id = $_POST['update_m_id'];
        $this->user = $_SESSION["user"];
    }
    public function Create()
    {	
    	global $database;

    	$query = "UPDATE m_meeting SET desition = '{$this->desition}', descession = '{$this->descession}' WHERE mm_id = $this->mm_id  ";
         $result = $database->query($query);
            if ($result) 
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Minutes Updated</div>";
                header("Location: ../../user/minutes.php?m_m_id=$this->m_id");
            }
            else 
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/minutes.php?m_m_id=$this->m_id");
            }
            
    	
    	

        return $this->Result;
    }  
}
$MyOBJECT = new CreateMeeting;
$MyOBJECT->Create();

?>