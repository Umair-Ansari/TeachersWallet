<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddQuizsFiles
{
    
    private $array;
    private $c_id;
    private $case;
    private $quiz;
    Private $Result;
	function __construct()
	{
        $this->array         = $_FILES;
        $this->c_id          = $_POST['course'];
        $this->case          = $_POST['case'];
        $this->quiz          = $_POST['quiz'];
    }
    public function Add()
    {	
    	global $database;
        if(!is_dir("course_files/"))
        {
            mkdir("course_files", 0755);
            mkdir("course_files/Quiz", 0755);
            mkdir("course_files/Quiz/".$this->c_id, 0755);
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz, 0755);
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz."/".$this->case, 0755);
        }
        else  if(!is_dir("course_files/Quiz/"))
        {
            mkdir("course_files/Quiz", 0755);
            mkdir("course_files/Quiz/".$this->c_id, 0755);
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz, 0755);
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz."/".$this->case, 0755);
        }
        else if(!is_dir("course_files/Quiz/".$this->c_id))
        {
            mkdir("course_files/Quiz/".$this->c_id, 0755);
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz, 0755);
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz."/".$this->case, 0755);
        }
        else if(!is_dir("course_files/Quiz/".$this->c_id."/".$this->quiz))
        {
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz, 0755);
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz."/".$this->case, 0755);
        }
        else if(!is_dir("course_files/Quiz/".$this->c_id."/".$this->quiz."/".$this->case))
        {
            
            mkdir("course_files/Quiz/".$this->c_id."/".$this->quiz."/".$this->case, 0755);
        }
        
        $index = array_keys($this->array);
        $end =  count($this->array);
        for($i =0 ; $i < $end; $i++)
        {
            $temp_file    = $_FILES[$index[$i]]['tmp_name'];
            $target_file  = $_FILES[$index[$i]]['name'];
            $upload_dir   = "course_files/Quiz/".$this->c_id."/".$this->quiz."/".$this->case."/";
            move_uploaded_file($temp_file, $upload_dir.$target_file);
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Files Uploaded </div>";
            header("Location: ../../user/ViewQuiz.php?course=".$this->c_id."&action=View&quiz=".$this->quiz."&case=".$this->case."");
              
        }
    }  
}
$MyOBJECT = new AddQuizsFiles;
$MyOBJECT->Add();

?>