<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddQualification
    {
   
    Private $degree;
    Private $institute;
    Private $grade;
    Private $percentage;
    Private $cgpa;
    Private $u_id;

    Private $Result;
	function __construct()
	{
        $this->degree           = $_POST["degree"];
        $this->u_id             = $_POST["u_id"];
        $this->institute        = $_POST["institute"];
        $this->division         = $_POST["division"];
        $this->percentage       = $_POST["percentage"];
        $this->cgpa             = $_POST["cgpa"];
	}
    public function add()
    {	
    	global $database;

       $this->degree      = trim($this->degree);
       $this->institute   = trim($this->institute);
       $this->u_id        = trim($this->u_id);
       $this->division       = trim($this->division);
       $this->percentage  = trim($this->percentage);
       $this->cgpa        = trim($this->cgpa);

    	if(($this->degree == null)||($this->institute == null)||($this->u_id == null) || ($this->division == null) || ($this->percentage == null) || ($this->cgpa == null))
    	{
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Please re-enter your missing information.</div>";
            header("Location: ../../user/qualification.php");
            die();
    	}
    	else
    	{
    		global $database;

            $this->degree      = $database->escape_value($this->degree);
            $this->institute   = $database->escape_value($this->institute);
            $this->u_id        = $database->escape_value($this->u_id);
            $this->division    = $database->escape_value($this->division);
            $this->percentage  = $database->escape_value($this->percentage);
            $this->cgpa        = $database->escape_value($this->cgpa);

            $Query_file = "INSERT INTO qualification (u_id,degree,institute,division,percentage,cgpa) VALUES ({$this->u_id},'{$this->degree}','{$this->institute}','{$this->division}','{$this->percentage}','{$this->cgpa}') ";
            $result_file = $database->query($Query_file);
            if($result_file)
            {
                $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Degree Added</div>";
                header("Location: ../../user/qualification.php");
                die();
            }
            else
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Error.</div>";
                header("Location: ../../user/qualification.php");
                die();
            }
        }
    	return $this->Result;
    }  
}
$MyOBJECT = new AddQualification;
$MyOBJECT->add();

?>