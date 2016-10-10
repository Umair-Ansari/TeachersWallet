<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class UpdateMidtermMarks
{
    
    private $c_id;
    private $m_id;
    private $marks;
    private $user;

    Private $Result;
	function __construct()
	{
        $this->c_id           = $_POST['c_id'];
        $this->m_id           = $_POST['m_id'];
        $this->marks          = $_POST['marks'];
        $this->user           = $_POST['user'];
    }
    public function update()
    {	
    	global $database;
       $Query_mid = "SELECT m_total FROM midterm WHERE m_id=".$this->m_id." ";
            $result_mid = $database->query($Query_mid);
            if ($row_mid =  mysqli_fetch_assoc($result_mid))
            {
                $total = $row_mid['m_total'];
                if($this->marks > $total)
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Can not add more then total marks</div>";
                    header("Location: ../../user/midterm.php?course=".$this->c_id."");
                    die();
                }
            }
        $Query = "Update total SET m_marks = '{$this->marks}' WHERE u_id = '{$this->user}' AND m_id = '{$this->m_id}' ";
        $result = $database->query($Query);
        if ($result) 
        {
              $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Midteam Paper Marks Updated</div>";
              //header("Location: ../../user/midterm.php?course=".$this->c_id."");
        }
        else 
        {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
               // header("Location: ../../user/midterm.php?course=".$this->c_id."");
        }
        
    }  
}
$MyOBJECT = new UpdateMidtermMarks;
$MyOBJECT->update();

?>