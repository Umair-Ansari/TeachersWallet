<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddProjectFiles
{
    
    private $array;
    private $p_id;
    private $case;
    private $c_id;
    Private $Result;
	function __construct()
	{
        $this->array         = $_FILES;
        $this->p_id          = $_POST['p_id'];
        $this->case          = $_POST['case'];
        $this->c_id          = $_POST['course'];
    }
    public function Add()
    {	
    	global $database;
        if(!is_dir("course_files/Projects/".$this->p_id."/".$this->case))
        {
            if(!is_dir("course_files/Projects/".$this->p_id))
            {
                if(!is_dir("course_files/Projects"))
                {
                    if(!is_dir("course_files"))
                    {
                        mkdir("course_files", 0755);
                        mkdir("course_files/Projects", 0755);
                        mkdir("course_files/Projects/".$this->p_id, 0755);
                        mkdir("course_files/Projects/".$this->p_id."/".$this->case, 0755);
                    }
                    else
                    {
                        mkdir("course_files/Projects", 0755);
                        mkdir("course_files/Projects/".$this->p_id, 0755);
                        mkdir("course_files/Projects/".$this->p_id."/".$this->case, 0755);
                    }
                }
                else
                {

                    mkdir("course_files/Projects/".$this->p_id, 0755);
                    mkdir("course_files/Projects/".$this->p_id."/".$this->case, 0755);
                }
            }
            else
            {
                mkdir("course_files/Projects/".$this->p_id."/".$this->case, 0755);
            }
        }
        $index = array_keys($this->array);
        $end =  count($this->array);
        for($i =0 ; $i < $end; $i++)
        {
            $temp_file    = $_FILES[$index[$i]]['tmp_name'];
            $target_file  = $_FILES[$index[$i]]['name'];
            $upload_dir   = "course_files/Projects/".$this->p_id."/".$this->case."/";
            move_uploaded_file($temp_file, $upload_dir.$target_file);
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Project Added</div>";
            header("Location: ../../user/project.php?course=".$this->c_id."");
              
        }
    }  
}
$MyOBJECT = new AddProjectFiles;
$MyOBJECT->Add();

?>