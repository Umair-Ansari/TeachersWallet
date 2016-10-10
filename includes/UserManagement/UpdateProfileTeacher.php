<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class UpdateProfileTeacher
    {
   
    Private $fname;
    Private $lname;

    Private $t_id;
    Private $u_id;

    Private $session;
    Private $rom;
    Private $cnic;
    Private $phone;
    Private $gender;
    Private $qualification;
    Private $degree;

    Private $Result;
	function __construct()
	{
        $this->t_id             = $_POST["t_id"];
        $this->u_id             = $_POST["u_id"];

        $this->fname            = $_POST["fname"];
        $this->lname            = $_POST["lname"];

        $this->session          = $_POST["session"];
        $this->rom              = $_POST["rom"];
        $this->cnic             = $_POST["cnic"];
        $this->phone            = $_POST["contact"];
        $this->gender           = $_POST["gender"];
        $this->qualification    = $_POST["qualification"];
        $this->degree           = $_POST["degree"];
	}
    public function UpdateProfile()
    {	
    	global $database;

       $this->fname          = trim($this->fname);
       $this->lname          = trim($this->lname);

       $this->session        = trim($this->session);
       $this->rom            = trim($this->rom);
       $this->cnic           = trim($this->cnic);
       $this->phone          = trim($this->phone);
       $this->gender         = trim($this->gender);
       $this->qualification  = trim($this->qualification);
       $this->degree         = trim($this->degree);


    	if(($this->fname == null)||($this->lname == null)||($this->session == null) || ($this->rom == null) || ($this->phone == null) || ($this->gender == null) || ($this->qualification == null)|| ($this->degree == null))
    	{
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Please re-enter your missing information.</div>";
           header("Location: ../../user/profile.php");
    	}
    	else
    	{
    		  global $database;

                $this->fname          = $database->escape_value($this->fname);
                $this->lname          = $database->escape_value($this->lname );

                $this->session        = $database->escape_value($this->session);
                $this->rom            = $database->escape_value($this->rom);
                $this->cnic           = $database->escape_value($this->cnic);
                $this->phone          = $database->escape_value($this->phone);
                $this->gender         = $database->escape_value($this->gender);
                $this->qualification  = $database->escape_value($this->qualification);
                $this->degree         = $database->escape_value($this->degree);

                $this->session       =  $this->session." ".$this->rom;
                $this->qualification = $this->degree." ".$this->qualification;
                $Query  = "UPDATE teacher ";
                $Query .= "SET t_office  = '{$this->session}' , t_phone = '{$this->phone}', final_qualification = '{$this->qualification}', t_cnic = '{$this->cnic}' ,t_gender = '{$this->gender}'   WHERE t_id = '{$this->t_id}' ";
                   
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
$MyOBJECT = new UpdateProfileTeacher;
$MyOBJECT->UpdateProfile();

?>