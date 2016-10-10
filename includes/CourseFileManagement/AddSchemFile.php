<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddSchemFile
{
    
    private $array;
   // private $p_id;
    //private $case;

    private $c_id;
    Private $Result;
	function __construct()
	{
        $this->array         = $_FILES;
        $this->c_id          = $_POST['course'];
    }
    public function Add()
    {	
    	global $database;
        if(!is_dir("course_files/scheme_of_study/".$this->c_id))
        {
            if(!is_dir("course_files/scheme_of_study"))
            {
                if(!is_dir("course_files"))
                {
                    
                    mkdir("course_files", 0755);
                    mkdir("course_files/scheme_of_study", 0755);
                    mkdir("course_files/scheme_of_study/".$this->c_id, 0755);
                }
                else
                {

                    mkdir("course_files/scheme_of_study", 0755);
                    mkdir("course_files/scheme_of_study/".$this->c_id, 0755);
                }
            }
            else
            {
                mkdir("course_files/scheme_of_study/".$this->c_id, 0755);
            }
        }
        $index = array_keys($this->array);
        $end =  count($this->array);
        for($i =0 ; $i < $end; $i++)
        {
            $temp_file    = $_FILES[$index[$i]]['tmp_name'];
            $target_file  = $_FILES[$index[$i]]['name'];
            $upload_dir   = "course_files/scheme_of_study/".$this->c_id."/";
            move_uploaded_file($temp_file, $upload_dir.$target_file);
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Scheme Of Study Added</div>";
            header("Location: ../../user/courseFile.php");
              
        }
    }  
}
$MyOBJECT = new AddSchemFile;
$MyOBJECT->Add();

?>