<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class DeleteMinustes
{
    Private $mm_id;
    Private $m_id;
    function __construct()
    {
        $this->mm_id = $_POST['mm_id'];
       $this->m_id = $_POST['m_id'];
    }
    public function Delete()
    {	
    	global $database;

    	$query = "DELETE FROM m_meeting WHERE mm_id =$this->mm_id ";
         $result = $database->query($query);
            if ($result) 
            {
              $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;font-size: 10pt;'>Meeting Deleted</div>";
                        header("Location: ../../user/minutes.php?m_m_id=$this->m_id");
            }
            else 
            {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;font-size: 10pt;'>Error!</div>";
                        header("Location: ../../user/minutes.php?m_m_id=$this->m_id");
            
    	
    	}

        return $this->Result;
    }  
}
$MyOBJECT = new DeleteMinustes;
$MyOBJECT->Delete();

?>