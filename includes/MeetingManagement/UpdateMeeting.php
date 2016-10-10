<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class CreateMeeting
{
    Private $date;
    Private $agenda;
    Private $start;
    Private $end;
    Private $user;
    Private $m_id;
    Private $Result;
    function __construct()
    {
        $this->date = $_POST['update_date'];
        $this->agenda = $_POST['update_agenda'];
        $this->start = $_POST['update_start'];
        $this->end = $_POST['update_end'];
        $this->m_id = $_POST['update_m_id'];
        $this->user = $_SESSION["user"];
    }
    public function Create()
    {	
    	global $database;
         $this->agenda = $database->escape_value($this->agenda);
    	$query = "UPDATE meeting SET m_date = '{$this->date}', m_agenda = '{$this->agenda}',st_time = '{$this->start}',app_end_time = '{$this->end}' WHERE m_id = $this->m_id  ";
         $result = $database->query($query);
            if ($result) 
            {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Meeting Updated</div>";
                        header("Location: ../../user/meeting.php");
            }
            else 
            {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                        header("Location: ../../user/meeting.php");
            }
            
    	
    	

        return $this->Result;
    }  
}
$MyOBJECT = new CreateMeeting;
$MyOBJECT->Create();

?>