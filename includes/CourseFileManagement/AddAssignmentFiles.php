<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddAssignmentFiles
{
    
    private $array;
    private $c_id;
    private $case;
    private $assignment;
    Private $Result;
	function __construct()
	{
        $this->array         = $_FILES;
        $this->c_id          = $_POST['course'];
        $this->case          = $_POST['case'];
        $this->assignment          = $_POST['assignment'];
    }
    public function Add()
    {	
    	global $database;
        if(!is_dir("course_files/"))
        {
            mkdir("course_files", 0755);
            mkdir("course_files/Assignment", 0755);
            mkdir("course_files/Assignment/".$this->c_id, 0755);
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment, 0755);
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment."/".$this->case, 0755);
        }
        else  if(!is_dir("course_files/Assignment/"))
        {
            mkdir("course_files/Assignment", 0755);
            mkdir("course_files/Assignment/".$this->c_id, 0755);
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment, 0755);
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment."/".$this->case, 0755);
        }
        else if(!is_dir("course_files/Assignment/".$this->c_id))
        {
            mkdir("course_files/Assignment/".$this->c_id, 0755);
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment, 0755);
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment."/".$this->case, 0755);
        }
        else if(!is_dir("course_files/Assignment/".$this->c_id."/".$this->assignment))
        {
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment, 0755);
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment."/".$this->case, 0755);
        }
        else if(!is_dir("course_files/Assignment/".$this->c_id."/".$this->assignment."/".$this->case))
        {
            
            mkdir("course_files/Assignment/".$this->c_id."/".$this->assignment."/".$this->case, 0755);
        }
        
        $index = array_keys($this->array);
        $end =  count($this->array);
        for($i =0 ; $i < $end; $i++)
        {
            $temp_file    = $_FILES[$index[$i]]['tmp_name'];
            $target_file  = $_FILES[$index[$i]]['name'];
            $upload_dir   = "course_files/Assignment/".$this->c_id."/".$this->assignment."/".$this->case."/";
            move_uploaded_file($temp_file, $upload_dir.$target_file);
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Files Uploaded </div>";
            header("Location: ../../user/ViewAssignment.php?course=".$this->c_id."&action=View&assignment=".$this->assignment."&case=".$this->case."");
              
        }
    }  
}
$MyOBJECT = new AddAssignmentFiles;
$MyOBJECT->Add();

?>