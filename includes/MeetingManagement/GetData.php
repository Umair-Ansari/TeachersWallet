<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class GetData
{
    Private $m_id;
    Private $Result;
    function __construct()
    {
        $this->m_id = $_POST['m_id'];
    }
    public function Get()
    {	
    	global $database;

    	$query = "SELECT * FROM meeting WHERE m_id =$this->m_id ";
        $result = $database->query($query);
         $row = mysqli_fetch_assoc($result);
         echo json_encode(
                array(
                    "m_id"      => $row['m_id'], 
                    "date"      => $row['m_date'],
                    "agenda"    => $row['m_agenda'],
                    "starte"     => $row['st_time'],
                    "end"       => $row['app_end_time']
                    )
                );
    }  
}
$MyOBJECT = new GetData;
$MyOBJECT->Get();

?>