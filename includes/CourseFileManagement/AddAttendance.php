<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddAttendance
{
    
    private $array;
    Private $date;
    Private $Result;
	function __construct()
	{
        $this->array           = $_POST;
        //print_r($this->array);
        $this->date           = $this->array['date'];
    }
    public function register()
    {	
    	global $database;
        
        $str = (explode("/",$this->date));
        $this->date  = $str[2]."-".$str[0]."-".$str[1];
        $index = array_keys($this->array);
        //print_r($index);
        if(!isset($index[2]))
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>No Students Found!</div>";
            header("Location: ../../user/attendance.php?course=".$this->array['cf_id']."");
            die();
        }
        $end =  count($this->array);
        for($i =2 ; $i < $end; $i++)
        {
            $Query = "INSERT INTO attendance (u_id,a_date,a_time,a_status,cf_id) VALUES ('{$index[$i]}','".$this->date."','".date("g:i A ", strtotime("+5 hours"))."','{$this->array[$index[$i]]}','{$this->array[$index[1]]}')";
            $result = $database->query($Query);
            if($result)
            {
              header("Location: ../../user/attendance.php?course=".$this->array[$index[1]]."");
            }
           // ".$index[$i].",date("Y-m-d"),date("g:i A ", strtotime("+5 hours")),".$this->array[$index[$i]].",".$this->array[$index[0]])." 
           //echo "value at index ".$index[$i]. "is ".$this->array[$index[$i]];  
          // echo "<br>";     
        }
    }  
}
$MyOBJECT = new AddAttendance;
$MyOBJECT->register();

?>