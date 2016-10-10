<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class UpdatePassword
{
    
   
    Private $old;
    Private $new;
    Private $confrm;
    Private $u_id;
    Private $Result;
    Private $password;
	function __construct()
	{
        $this->old        = $_POST["old"];
        $this->new        = $_POST["new"];
        $this->confrm     = $_POST["confrm"];
        $this->u_id       = $_POST["u_id"];
	}
    public function UpdatePass()
    {	
    	global $database;

        $this->old        = trim($this->old);
        $this->new        = trim($this->new);
        $this->confrm     = trim($this->confrm);


    	if(($this->old == null)||($this->new == null)||($this->confrm == null))
    	{
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -20pt 0pt 0pt 0pt;'><b>Please re-enter your missing information.</div>";
            //header("Location: ../../user/profile.php");
    	}
    	else
    	{      
    		if($this->new == $this->confrm)
            {
                 global $database;

                $this->old        = $database->escape_value($this->old);
                $this->new        = $database->escape_value($this->new );

                
                $Query  = "SELECT  password  ";
                $Query .= "FROM user ";
                $Query .= "WHERE u_id = '{$this->u_id}' ";
                 //echo $Query;
                $this->Result = $database->query($Query);
                    
                if( $row = mysqli_fetch_assoc($this->Result)) 
                {
                    echo $this->old;

                    $this->password  = $row['password'];
                    if($this->password == $this->old)
                    {
                                                $Query  = "UPDATE user ";
                        $Query .= "SET password = '{$this->new}' WHERE u_id = '{$this->u_id}' ";
                                
                        $this->Result = $database->query($Query);
                       if (!$this->Result) 
                        {
                            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Please re-enter your information</b><br><br>Information you entered is incorrect. Please try again (make sure your caps lock is off).</div>";
                             header("Location: ../../user/profile.php");
                           
                        } 
                        else 
                        {
                            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Password Chnaged</div>";
                            header("Location: ../../user/profile.php");
                        }
                    }
                                 
                    else 
                    {
                         $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Current Password Missmatch!</div>";
                        header("Location: ../../user/profile.php");
                    }
                }
            }
            else
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Password Missmatch!</div>";
                header("Location: ../../user/profile.php");
            }
        }
    	return $this->Result;
    }  
}
$MyOBJECT = new UpdatePassword;
$MyOBJECT->UpdatePass();

?>