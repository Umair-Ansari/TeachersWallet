<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class DeleteAllRequests
{

	public function Delete()
    {	
    	global $database;
        $Query  = "START TRANSACTION;";
        //{
            $this->Result = $database->query($Query);
            $Query1  = "DELETE FROM temp_student; ";
            $this->Result = $database->query($Query1);
            $Query2  = "DELETE FROM temp_teacher; ";
            $this->Result = $database->query($Query2);
            $Query3  = "DELETE FROM temp_worker; ";
            $this->Result = $database->query($Query3);
        //}
        $Query  = "COMMIT;";
        if($Query1 && $Query2 && $Query3)
        {
            $this->Result = $database->query($Query);
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'><b>All Requests Deleted</div>";
            header("Location: ../../user/account.php");  
        }
        else
        {
            $Query  = "ROLLBACK;";
            $this->Result = $database->query($Query);
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Failed to perform action</div>";
            header("Location: ../../user/account.php"); 
        }
    }  
}
$MyOBJECT = new DeleteAllRequests;
$MyOBJECT->Delete();

?>