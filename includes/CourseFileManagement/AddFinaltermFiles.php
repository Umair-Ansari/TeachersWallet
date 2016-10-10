<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddFinaltermFiles
{
    
    private $array;
    private $f_id;
    private $case;
    private $c_id;
    Private $Result;
	function __construct()
	{
        $this->array         = $_FILES;
        $this->f_id          = $_POST['f_id'];
        $this->case          = $_POST['case'];
        $this->c_id          = $_POST['c_id'];
    }
    public function Add()
    {	
    	global $database;
        if(!is_dir("course_files/Finalterm/".$this->f_id."/".$this->case))
        {
            if(!is_dir("course_files/Finalterm/".$this->f_id))
            {
                if(!is_dir("course_files/Finalterm"))
                {
                    if(!is_dir("course_files"))
                    {
                        mkdir("course_files", 0755);
                        mkdir("course_files/Finalterm", 0755);
                        mkdir("course_files/Finalterm/".$this->f_id, 0755);
                        mkdir("course_files/Finalterm/".$this->f_id."/".$this->case, 0755);
                    }
                    else
                    {
                        mkdir("course_files/Finalterm", 0755);
                        mkdir("course_files/Finalterm/".$this->f_id, 0755);
                        mkdir("course_files/Finalterm/".$this->f_id."/".$this->case, 0755);
                    }
                }
                else
                {

                    mkdir("course_files/Finalterm/".$this->f_id, 0755);
                    mkdir("course_files/Finalterm/".$this->f_id."/".$this->case, 0755);
                }
            }
            else
            {
                mkdir("course_files/Finalterm/".$this->f_id."/".$this->case, 0755);
            }
        }
        $index = array_keys($this->array);
        $end =  count($this->array);
        for($i =0 ; $i < $end; $i++)
        {
            $temp_file    = $_FILES[$index[$i]]['tmp_name'];
            $target_file  = $_FILES[$index[$i]]['name'];
            $upload_dir   = "course_files/Finalterm/".$this->f_id."/".$this->case."/";
            move_uploaded_file($temp_file, $upload_dir.$target_file);
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Final Term Paper Images Added</div>";
            header("Location: ../../user/final.php?course=".$this->c_id."");
              
        }
    }  
}
$MyOBJECT = new AddFinaltermFiles;
$MyOBJECT->Add();

?>