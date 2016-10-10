<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddNotification
{
    
    private $title;
    private $n_id;
    private $array;
    private $teacher;
    private $student;

    Private $Result;
	function __construct()
	{
        $this->array            = $_FILES;
        $this->title            = $_POST['title'];
        
        $this->teacher          = $_POST['teacher'];
        $this->student          = $_POST['student'];
    }
    public function add()
    {	
    	global $database;
        $this->title        = $database->escape_value($this->title);
        $this->teacher      = $database->escape_value( $this->teacher );
        $this->student      = $database->escape_value( $this->student );


        $Query = "INSERT INTO notification (title,teacher,student) VALUES ('{$this->title}','{$this->teacher}','{$this->student}') ";
        $result = $database->query($Query);
        if($result)
        {
            $Query = "SELECT LAST_INSERT_ID() as n_id FROM notification";
            $result = $database->query($Query);
            if($row = mysqli_fetch_assoc($result))
            {
                $this->n_id = $row['n_id'];
                if(!is_dir("notification"))
                {
                    mkdir("notification", 0755);
                    mkdir("notification/".$this->n_id, 0755);
                }
                else
                {
                        mkdir("notification/".$this->n_id, 0755);
                }
                
                $index = array_keys($this->array);
                $end =  count($this->array);
                for($i =0 ; $i < $end; $i++)
                {
                    $temp_file    = $_FILES[$index[$i]]['tmp_name'];
                    $target_file  = $_FILES[$index[$i]]['name'];
                    $upload_dir   = "notification/".$this->n_id."/";
                    move_uploaded_file($temp_file, $upload_dir.$target_file);
                    $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Notification Set</div>";
                    header("Location: ../../user/notification.php");
                    die();
                      
                }
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error! Please Delete This Notification If Created.</div>";
               header("Location: ../../user/notification.php");
            }
            else 
            {
                     $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                    header("Location: ../../user/notification.php");
            }

        }
        else 
        {
                 $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/assignment.php?course=".$this->c_id."");
        }
        
    }  
}
$MyOBJECT = new AddNotification;
$MyOBJECT->add();

?>