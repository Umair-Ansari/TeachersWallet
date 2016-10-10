<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class DeleteNotification
{
    Private $n_id;
    function __construct()
    {
        $this->n_id = $_POST['n_id'];
    }
    public function Delete()
    {	
    	global $database;

    	$query = "DELETE FROM notification WHERE n_id =$this->n_id ";
         $result = $database->query($query);
            if ($result) 
            {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Notification Deleted</div>";
                        header("Location: ../../user/notification.php");
            }
            else 
            {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;font-size: 10pt;'>Error!</div>";
                        header("Location: ../../user/notification.php");
            }
            
    	
    	

        return $this->Result;
    }  
}
$MyOBJECT = new DeleteNotification;
$MyOBJECT->Delete();

?>