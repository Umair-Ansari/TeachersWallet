<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class DeleteMeeting
{
    Private $m_id;
    function __construct()
    {
        $this->m_id = $_POST['m_id'];
    }
    public function Delete()
    {	
    	global $database;

    	$query = "DELETE FROM meeting WHERE m_id =$this->m_id ";
         $result = $database->query($query);
            if ($result) 
            {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Meeting Deleted</div>";
                        header("Location: ../../user/meeting.php");
            }
            else 
            {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;font-size: 10pt;'>Error!</div>";
                        header("Location: ../../user/meeting.php");
            }
            
    	
    	

        return $this->Result;
    }  
}
$MyOBJECT = new DeleteMeeting;
$MyOBJECT->Delete();

?>