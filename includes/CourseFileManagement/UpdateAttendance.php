<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class UpdateAttendance
{
    Private $update_status;
    Private $att_id;
    Private $c_id;
    Private $Result;
    function __construct()
    {
        $this->update_status = $_POST['update_status'];
        $this->att_id = $_POST['update_att_id'];
        $this->c_id = $_POST['c_id'];
    }
    public function Update()
    {	
    	global $database;

    	$query = "UPDATE attendance SET a_status = '{$this->update_status}' WHERE att_id = $this->att_id  ";
         $result = $database->query($query);
            if ($result) 
            {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Attendance Updated</div>";
                header("Location: ../../user/attendance.php?course=".$this->c_id."");
            }
            else 
            {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/attendance.php?course=".$this->c_id."");
            }
            
    	
    	

        return $this->Result;
    }  
}
$MyOBJECT = new UpdateAttendance;
$MyOBJECT->Update();

?>