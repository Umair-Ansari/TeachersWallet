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
    Private $Result;
    function __construct()
    {
        $this->date = $_POST['date'];
        $this->agenda = $_POST['agenda'];
        $this->start = $_POST['start'];
        $this->end = $_POST['end'];
        $this->user = $_SESSION["user"];
    }
    public function Create()
    {	
    	global $database;
         $this->agenda = $database->escape_value($this->agenda);
    	$query = "INSERT INTO meeting (m_date,m_agenda,st_time,app_end_time,c_o_id) VALUES ('{$this->date}','{$this->agenda}','{$this->start}','{$this->end}',$this->user) ";
         $result = $database->query($query);
            if ($result) 
            {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Meeting Created</div>";
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