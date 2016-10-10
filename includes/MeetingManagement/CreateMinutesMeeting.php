<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class CreateMinutesMeeting
{
    Private $desition;
    Private $descession;
    Private $m_id;
    Private $Result;
    function __construct()
    {
        $this->desition = $_POST['desition'];
        $this->descession = $_POST['descession'];
        $this->m_id = $_POST['m_id'];
    }
    public function Create()
    {	
    	global $database;

    	$query = "INSERT INTO m_meeting (desition,descession,m_id) VALUES ('{$this->desition}','{$this->descession}',$this->m_id) ";
         $result = $database->query($query);
            if ($result) 
            {
              $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Minutes Created</div>";
                        header("Location: ../../user/minutes.php?m_m_id=$this->m_id");
            }
            else 
            {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                        header("Location: ../../user/minutes.phpm_m_id=$this->m_id");
            }
            
    	
    	

        return $this->Result;
    }  
}
$MyOBJECT = new CreateMinutesMeeting;
$MyOBJECT->Create();

?>