<?php
if(session_id() == '') {
    session_start();
}
class LogOut
{
	public function Destry()
    {	
    	session_destroy();
    	 header("Location: ../../index.php");
    }  
}
$MyOBJECT = new LogOut;
$MyOBJECT->Destry();

?>