<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class UpdateProfileWorker
{
    
   
    Private $fname;
    Private $lname;
    Private $designation;
    Private $shift;
    Private $c_o_id;
    Private $Result;
	function __construct()
	{
        $this->fname        = $_POST["fname"];
        $this->lname        = $_POST["lname"];
        $this->designation  = $_POST["designation"];
        $this->shift        = $_POST["shift"];
        $this->c_o_id       = $_POST["c_o_id"];
        $this->u_id         = $_POST["u_id"];
	}
    public function UpdateProfile()
    {	
    	global $database;

        $this->fname        = trim($this->fname);
        $this->lname        = trim($this->lname);
        $this->designation  = trim($this->designation);
        $this->shift        = trim($this->shift);


    	if(($this->fname == null)||($this->lname == null)||($this->designation == null)||($this->shift == null) || ($this->c_o_id == null) || ($this->u_id == null))
    	{
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -20pt 0pt 0pt 0pt;'><b>Please re-enter your missing information.</div>";
            header("Location: ../../user/profile.php");
    	}
    	else
    	{
    		  global $database;

                $this->fname        = $database->escape_value($this->fname);
                $this->lname        = $database->escape_value($this->lname );
                $this->designation  = $database->escape_value($this->designation);
                $this->shift        = $database->escape_value($this->shift);

                
                $Query  = "UPDATE c_officer ";
                $Query .= "SET c_o_designation = '{$this->designation}' , c_o_shif = '{$this->shift}' WHERE c_o_id = '{$this->c_o_id}' ";
                   
                $this->Result = $database->query($Query);
               if (!$this->Result) 
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Please re-enter your information</b><br><br>Information you entered is incorrect. Please try again (make sure your caps lock is off).</div>";
                     header("Location: ../../user/profile.php");
                   
                } 
                else 
                {
                     global $database;

                   
                    $Query  = "UPDATE user ";
                    $Query .= "SET fname = '{$this->fname}' , lname = '{$this->lname}' WHERE u_id = '{$this->u_id}' ";
                        
                    $this->Result = $database->query($Query);
                   if (!$this->Result) 
                    {
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Please re-enter your information</b><br><br>Information you entered is incorrect. Please try again (make sure your caps lock is off).</div>";
                         header("Location: ../../user/profile.php");
                       
                    } 
                    else 
                    {
                         $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Profile Updated</div>";
                         header("Location: ../../user/profile.php");
                         $_SESSION["fname"]  =  $this->fname;
                        $_SESSION["lname"]  = $this->lname;
                    }
                }
            
        }
    	return $this->Result;
    }  
}
$MyOBJECT = new UpdateProfileWorker;
$MyOBJECT->UpdateProfile();

?>