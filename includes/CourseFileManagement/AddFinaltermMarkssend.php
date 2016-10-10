<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddFinaltermMarkssend
{
    
    private $c_id;
    private $f_id;
    private $marks;
    private $user;

    Private $Result;
	function __construct()
	{
        $this->c_id           = $_POST['c_id'];
        $this->f_id           = $_POST['f_id'];
        $this->marks          = $_POST['marks'];
        $this->user           = $_POST['user'];
    }
    public function add()
    {	
    	global $database;
        $Query_final = "SELECT f_total FROM final WHERE f_id=".$this->f_id." ";
            $result_final = $database->query($Query_final);
            if ($row_final =  mysqli_fetch_assoc($result_final))
            {
                $total = $row_final['f_total'];
                if($this->marks > $total)
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Can not add more then total marks</div>";
                    header("Location: ../../user/final.php?course=".$this->c_id."");
                    die();
                }
            }
        $Query = "SELECT COUNT( to_id ) to_id FROM total WHERE u_id = '{$this->user}'";
        $result = $database->query($Query);
        $row = mysqli_fetch_assoc($result);
        if ($row['to_id'] == 0)
        {
            $Query = "INSERT INTO total (u_id,f_id,f_marks) VALUES ('{$this->user}','{$this->f_id}','{$this->marks}') ";
            $result = $database->query($Query);
            if ($result) 
            {
                $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Final Term Paper Marks Added</div>";
                header("Location: ../../user/final.php?course=".$this->c_id."");
            }
            else 
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/final.php?course=".$this->c_id."");
            }
        }
        else
        {
            $Query = "UPDATE total SET f_id = '{$this->f_id}',f_marks='{$this->marks}'  WHERE u_id = '{$this->user}' ";
            $result = $database->query($Query);
            if ($result) 
            {
                $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Final Term Marks Updated</div>";
                header("Location: ../../user/final.php?course=".$this->c_id."");
            }
            else 
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                header("Location: ../../user/final.php?course=".$this->c_id."");
            }
        }
        
    }  
}
$MyOBJECT = new AddFinaltermMarkssend;
$MyOBJECT->add();

?>