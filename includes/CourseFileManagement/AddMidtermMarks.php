<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddMidtermMarks
{
    
    private $array;
    Private $Result;
	function __construct()
	{
        $this->array           = $_POST;
    }
    public function Add()
    {	
    	global $database;
        
        $index = array_keys($this->array);
        $end =  count($this->array);
        for($i =1 ; $i < $end; $i++)
        {
            $Query = "INSERT INTO attendance (u_id,a_date,a_time,a_status,cf_id) VALUES ('{$index[$i]}','".date("Y-m-d")."','".date("g:i A ", strtotime("+5 hours"))."','{$this->array[$index[$i]]}','{$this->array[$index[0]]}')";
            $result = $database->query($Query);
            if($result)
            {
                header("Location: ../../user/attendance.php?course=".$this->array[$index[0]]."");
            }
           // ".$index[$i].",date("Y-m-d"),date("g:i A ", strtotime("+5 hours")),".$this->array[$index[$i]].",".$this->array[$index[0]])." 
           //echo "value at index ".$index[$i]. "is ".$this->array[$index[$i]];  
          // echo "<br>";     
        }
    }  
}
$MyOBJECT = new AddMidtermMarks;
$MyOBJECT->Add();

?>