<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class UpdateProfileStudent
{
    
   
    Private $fname;
    Private $lname;
    Private $reg_no;
    Private $dob;
    Private $address;
    Private $cnic;
    Private $u_id;
    Private $Result;
    Private $phone;
    Private $cgpa;
    Private $nationality;
	function __construct()
	{
        $this->reg_no       = $_POST["reg_no"];
        $this->u_id         = $_POST["u_id"];

        $this->fname        = $_POST["fname"];
        $this->lname        = $_POST["lname"];
        $this->dob          = $_POST["dob"];
        $this->address      = $_POST["address"];
        $this->cnic         = $_POST["cnic"];
        $this->phone        = $_POST["contact"];
        $this->cgpa         = $_POST["cgpa"];
        $this->nationality  = $_POST["nationality"];
	}
    public function UpdateProfile()
    {	
    	global $database;

       $this->fname        = trim($this->fname);
       $this->lname        = trim($this->lname);

       $this->reg_no       = trim($this->reg_no);
       $this->address      = trim($this->address);
       $this->dob          = trim($this->dob);
       $this->cnic         = trim($this->cnic);
       $this->phone        = trim($this->phone);
       $this->cgpa         = trim($this->cgpa);
       $this->nationality  = trim($this->nationality);


    	if(($this->fname == null)||($this->lname == null)||($this->reg_no == null)||($this->dob == null) || ($this->address == null) ||  ($this->phone == null) || ($this->cgpa == null) || ($this->nationality == null))
    	{
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Please re-enter your missing information.</div>";
           header("Location: ../../user/profile.php");
    	}
    	else
    	{
    		  global $database;

                $this->fname        = $database->escape_value($this->fname);
                $this->lname        = $database->escape_value($this->lname );

                $this->address      = $database->escape_value($this->address);
                $this->dob          = $database->escape_value($this->dob);
                $this->cnic         = $database->escape_value($this->cnic);
                $this->phone        = $database->escape_value($this->phone);
                $this->cgpa         = $database->escape_value($this->cgpa);
                $this->nationality  = $database->escape_value($this->nationality);

                
                $Query  = "UPDATE student ";
                $Query .= "SET s_address  = '{$this->address}' , s_dob = '{$this->dob}', s_cnic = '{$this->cnic}', s_phone = '{$this->phone}' ,s_nationality = '{$this->nationality}' , s_cgpa = '{$this->cgpa}'  WHERE Reg_no = '{$this->reg_no}' ";
                   
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
$MyOBJECT = new UpdateProfileStudent;
$MyOBJECT->UpdateProfile();

?>