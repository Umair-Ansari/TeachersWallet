<?php
if(session_id() == '') {
    session_start();
}
require_once("../../PHPMailerAutoload.php");
require_once("../database.php");

class RecoverAccount
{
	private $email;
    private $token;
    private $id;

    Private $Result;
	function __construct()
	{
		$this->email      = $_GET["email"];
        $this->token      = $_GET["token"];
        $this->id         = $_GET["id"];
	}
    public function authenticate()
    {	
    	global $User_Management;

    	$this->email       = trim($this->email);
        $this->token       = trim($this->token);
        $this->id          = trim($this->id);

    	if(($this->email == null)||($this->token == null)||($this->id == null))
    	{
    		$_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Invalid Verification Code</div>";
            $_SESSION["info"]    = "<center>The Verification Code you are using is either Invalid or expired.<br></center>";
            header("Location: info.php");
            die();
    	}
    	else
    	{
    		global $database;

            $this->email      = $database->escape_value($this->email);
            $this->token      = $database->escape_value($this->token);
            $this->id         = $database->escape_value($this->id);

            if($this->id == 1)
            {
                $Query  = "SELECT * ";
                $Query .= "FROM temp_student ";
                $Query .= "WHERE email='{$this->email}' AND ts_id ={$this->token}";
                $result = $database->query($Query);
                if ( $row = mysqli_fetch_assoc($result)) 
                {
                    $Query = "UPDATE temp_student SET status = 1 WHERE email='{$this->email}' AND ts_id ={$this->token}";
                    $result = $database->query($Query);
                    if($result)
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Account Request is in progress</div>";
                        $_SESSION["info"]    = "<center><b>Your email is verified and your request is in under progress.<br>You will be notified by email.</b></center>";
                        header("Location: ../../info.php");
                        die();
                    }
                    else
                    {
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Invalid Verification Code</div>";
                        $_SESSION["info"]    = "<center>The Verification Code you are using is either Invalid or expired.<br></center>";
                         header("Location: ../../info.php");
                        die();
                    }
                }
                else
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Invalid Verification Code</div>";
                    $_SESSION["info"]    = "<center>The Verification Code you are using is either Invalid or expired.<br></center>";
                     header("Location: ../../info.php");
                    die();
                }
            }
            else if($this->id == 2)
            {
                $Query  = "SELECT * ";
                $Query .= "FROM temp_teacher ";
                $Query .= "WHERE email='{$this->email}' AND tt_id ={$this->token}";
                $result = $database->query($Query);
                if ( $row = mysqli_fetch_assoc($result)) 
                {
                    $Query = "UPDATE temp_teacher SET status = 1 WHERE email='{$this->email}' AND tt_id ={$this->token}";
                    $result = $database->query($Query);
                    if($result)
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Account Request is in progress</div>";
                        $_SESSION["info"]    = "<center><b>Your email is verified and your request is in under progress.<br>You will be notified by email.</b></center>";
                        header("Location: ../../info.php");
                        die();
                    }
                    else
                    {
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Invalid Verification Code</div>";
                        $_SESSION["info"]    = "<center>The Verification Code you are using is either Invalid or expired.<br></center>";
                         header("Location: ../../info.php");
                        die();
                    }
                }
                else
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Invalid Verification Code</div>";
                    $_SESSION["info"]    = "<center>The Verification Code you are using is either Invalid or expired.<br></center>";
                     header("Location: ../../info.php");
                    die();
                }
            }
            else if($this->id == 3)
            {
                $Query  = "SELECT * ";
                $Query .= "FROM temp_worker ";
                $Query .= "WHERE email='{$this->email}' AND tw_id ={$this->token}";
                $result = $database->query($Query);
                if ( $row = mysqli_fetch_assoc($result)) 
                {
                    $Query = "UPDATE temp_worker SET status = 1 WHERE email='{$this->email}' AND tw_id ={$this->token}";
                    $result = $database->query($Query);
                    if($result)
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Account Request is in progress</div>";
                        $_SESSION["info"]    = "<center><b>Your email is verified and your request is in under progress.<br>You will be notified by email.</b></center>";
                        header("Location: ../../info.php");
                        die();
                    }
                    else
                    {
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Invalid Verification Code</div>";
                        $_SESSION["info"]    = "<center>The Verification Code you are using is either Invalid or expired.<br></center>";
                         header("Location: ../../info.php");
                        die();
                    }
                }
                else
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Invalid Verification Code</div>";
                    $_SESSION["info"]    = "<center>The Verification Code you are using is either Invalid or expired.<br></center>";
                     header("Location: ../../info.php");
                    die();
                }
            }
            else
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Invalid Verification Code</div>";
                $_SESSION["info"]    = "<center>The Verification Code you are using is either Invalid or expired.<br></center>";
                 header("Location: ../../info.php");
                die();
            }
    	}
    	

        return $this->Result;
    }  
}
$MyOBJECT = new RecoverAccount;
$MyOBJECT->authenticate();

?>