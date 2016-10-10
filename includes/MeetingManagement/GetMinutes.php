<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class GetMinutes
{
    Private $mm_id;
    Private $Result;
    function __construct()
    {
        $this->mm_id = $_POST['mm_id'];
    }
    public function Get()
    {	
    	global $database;

    	$query = "SELECT * FROM m_meeting WHERE mm_id =$this->mm_id ";
        $result = $database->query($query);
         $row = mysqli_fetch_assoc($result);
         echo json_encode(
                array(
                    "mm_id"         => $row['mm_id'], 
                    "desition"      => $row['desition'],
                    "descession"    => $row['descession']
                    )
                );
    }  
}
$MyOBJECT = new GetMinutes;
$MyOBJECT->Get();

?>