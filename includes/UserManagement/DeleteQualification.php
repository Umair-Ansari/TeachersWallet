<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class DeleteQualification
{
    Private $q_id;
    function __construct()
    {
        $this->q_id = $_POST['q_id'];
    }
    public function Delete()
    {	
    	global $database;

    	$query = "DELETE FROM qualification WHERE qt_id =$this->q_id ";
         $result = $database->query($query);
            if ($result) 
            {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Qualification Deleted</div>";
                        header("Location: ../../user/qualification.php");
            }
            else 
            {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;font-size: 10pt;'>Error!</div>";
                        header("Location: ../../user/qualification.php");
            }
            
    	
    	

        return $this->Result;
    }  
}
$MyOBJECT = new DeleteQualification;
$MyOBJECT->Delete();

?>