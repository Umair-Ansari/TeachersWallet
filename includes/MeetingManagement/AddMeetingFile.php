<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddMeetingFile
{
    
    private $array;
   // private $p_id;
    //private $case;

    private $m_id;
    Private $Result;
	function __construct()
	{
        $this->array         = $_FILES;
        $this->m_id          = $_POST['m_id'];
    }
    public function Add()
    {	
    	global $database;
        if(!is_dir("meeting/".$this->m_id))
        {
            if(!is_dir("meeting"))
            {
               

                    mkdir("meeting", 0755);
                    mkdir("meeting/".$this->m_id, 0755);
                
            }
            else
            {
                mkdir("meeting/".$this->m_id, 0755);
            }
        }
        $index = array_keys($this->array);
        $end =  count($this->array);
        for($i =0 ; $i < $end; $i++)
        {
            $temp_file    = $_FILES[$index[$i]]['tmp_name'];
            $target_file  = $_FILES[$index[$i]]['name'];
            $upload_dir   = "meeting/".$this->m_id."/";
            move_uploaded_file($temp_file, $upload_dir.$target_file);
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Meeting Minutes Added</div>";
            header("Location: ../../user/meeting.php");
              
        }
    }  
}
$MyOBJECT = new AddMeetingFile;
$MyOBJECT->Add();

?>