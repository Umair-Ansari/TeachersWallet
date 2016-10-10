<?php
if(session_id() == '') {
    session_start();
}
require_once("../../PHPMailerAutoload.php");
require_once("../database.php");

class RecoverAccount
{
	private $email;
    private $password;
    Private $Result;
	function __construct()
	{
		$this->email      = $_POST["email"];
	}
    public function authenticate()
    {	
    	global $User_Management;

    	$this->email       = trim($this->email);

    	if($this->email == null)
    	{
    		$_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -20pt 0pt 0pt 0pt;'><b>Please re-enter your email.</div>";
            header("Location: forget.php");
            die();
    	}
    	else
    	{
    		global $database;

            $this->email      = $database->escape_value($this->email);

            $Query  = "SELECT * ";
            $Query .= "FROM user ";
            $Query .= "WHERE email='{$this->email}' ";

            $result = $database->query($Query);
            
            if ( $row = mysqli_fetch_assoc($result)) 
            {
                $this->password = $row['password'];
                $mail = new PHPMailer;
                    
                    $message = "Hi, <b>".$row['fname']." ".$row['lname']."</b>";
                    $message .= "<br><br>";
                    $message .= "We recieved your forget password request";
                    $message .= "<br><br>";
                    $message .= "<b>**** Never tell you password to anyone ****</b><br>";
                    $message .= "Your password : $this->password";
                    $message .= "<br><br>";
                    $message .= "<img src='cid:logo' /><br>";
                    $message .= "Teacher's Wallet";

                    $mail->isSMTP();                                      
                    $mail->Host = 'smtp.gmail.com';  
                    $mail->SMTPAuth = true;                               
                    $mail->Username = "teacherwallet@gmail.com";                
                    $mail->Password = 'dhjqihygjwxheeph';                           
                    $mail->SMTPSecure = 'tls';                           
                    $mail->Port = 587;                                  
                    $mail->From = 'admin@unishare.com';
                    $mail->FromName = "Teacher's Wallet";
                    $mail->addAddress($this->email);              
                    $mail->isHTML(true);                                  
                    $mail->AddEmbeddedImage('../../images/icon.png', 'logo');
                    $mail->Subject = 'Email Address Verification';
                    $mail->Body    = $message;
                    
                    if(!$mail->send()) {
                        //$_SESSION['emailNotSent'] ="Failed to send verification email.";
                        //echo $mail->ErrorInfo;
                       // header("Location:index.php");
                    }
                    
                    $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Account Details Send!</div>";
                    $_SESSION["info"]    = "<center><b>Note</b> - <u>Never tell you password to anyone</u><br>An email that contain your Account Infomation is already send to your email address <b>'".$this->email."'</b></center>";
                    header("Location: ../../info.php");
                    die();
            }
             
            else 
            {
                $Query  = "SELECT * ";
                $Query .= "FROM temp_student ";
                $Query .= "WHERE email='{$this->email}' ";
                $result = $database->query($Query);
                if ( $row = mysqli_fetch_assoc($result)) 
                {
                    if($row['status'] == 0)
                    {
                        $token = 0;
                        $Query = "SELECT ts_id AS token FROM temp_student WHERE email ='".$this->email."' ";
                        $result = $database->query($Query);
                        if($row = mysqli_fetch_assoc($result)) 
                        {
                            $token = $row['token'];
                        }
                        $mail = new PHPMailer;
                        
                        $message = "Welcome <b>".$this->fname." ".$this->lname."</b> to Teacher's Wallet";
                        $message .= "<br><br>";
                        $message .= "We recieved your account request";
                        $message .= "<br><br>";
                        $message .= "**** Click link below to verify your account ****<br>";
                        
                        $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw/VerifyAccountPath?token=".$token."&email=".$this->email."";
                        $message .= "<br><br>";
                        $message .= "<img src='cid:logo' /><br>";
                        $message .= "Teacher's Wallet";

                        $mail->isSMTP();                                      
                        $mail->Host = 'smtp.gmail.com';  
                        $mail->SMTPAuth = true;                               
                        $mail->Username = "teacherwallet@gmail.com";                
                        $mail->Password = 'dhjqihygjwxheeph';                           
                        $mail->SMTPSecure = 'tls';                           
                        $mail->Port = 587;                                  
                        $mail->From = 'admin@unishare.com';
                        $mail->FromName = "Teacher's Wallet";
                        $mail->addAddress($this->email);              
                        $mail->isHTML(true);                                  
                        $mail->AddEmbeddedImage('../../images/icon.png', 'logo');
                        $mail->Subject = 'Email Address Verification';
                        $mail->Body    = $message;
                        
                        if(!$mail->send()) {
                            //$_SESSION['emailNotSent'] ="Failed to send verification email.";
                            //echo $mail->ErrorInfo;
                           // header("Location:index.view.php");
                        }
                        
                            
                            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Please verify your account!</div>";
                            $_SESSION["info"]    = "<center><b>Note</b> - <u>admin will not be able to view your account request untill you verify your email</u><br>An email that contain your verification link is already send to your email address <b>'".$this->email."'</b>.<br>Please verify your email by clicking  verification link</center>";
                            header("Location: ../../info.php");
                            die();
                         
                        
                    }
                    else
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Account Request is in progress</div>";
                        $_SESSION["info"]    = "<center><b>Your email is verified and your request is in under progress.<br>You will be notified by email.</b></center>";
                        header("Location: ../../info.php");
                        die();
                    }
                }
                $Query  = "SELECT * ";
                $Query .= "FROM temp_teacher ";
                $Query .= "WHERE email='{$this->email}' ";
                $result = $database->query($Query);
                if ( $row = mysqli_fetch_assoc($result)) 
                {
                    if($row['status'] == 0)
                    {
                        $token = 0;
                    
                        $token = $row['tt_id'];
                    
                    $mail = new PHPMailer;
                    
                    $message = "Welcome <b>".$this->fname." ".$this->lname."</b> to Teacher's Wallet";
                    $message .= "<br><br>";
                    $message .= "We recieved your account request";
                    $message .= "<br><br>";
                    $message .= "**** Click link below to verify your account ****<br>";
                    $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw//includes/UserManagement/VerifyAccountPath?token=".$token."&email=".$this->email."";
                    $message .= "<br><br>";
                    $message .= "<img src='cid:logo' /><br>";
                    $message .= "Teacher's Wallet";

                    $mail->isSMTP();                                      
                    $mail->Host = 'smtp.gmail.com';  
                    $mail->SMTPAuth = true;                               
                    $mail->Username = "teacherwallet@gmail.com";                
                    $mail->Password = 'dhjqihygjwxheeph';                           
                    $mail->SMTPSecure = 'tls';                           
                    $mail->Port = 587;                                  
                    $mail->From = 'admin@unishare.com';
                    $mail->FromName = "Teacher's Wallet";
                    $mail->addAddress($this->email);              
                    $mail->isHTML(true);                                  
                    $mail->AddEmbeddedImage('../../images/icon.png', 'logo');
                    $mail->Subject = 'Email Address Verification';
                    $mail->Body    = $message;
                    
                    if(!$mail->send()) {
                        //$_SESSION['emailNotSent'] ="Failed to send verification email.";
                        //echo $mail->ErrorInfo;
                       // header("Location:index.view.php");
                    }
                    
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;>Please verify your account</div>";
                    $_SESSION["info"]    = "<center><b>Note</b> - <u>admin will not be able to view your account request untill you verify your email</u><br>An email that contain your verification link is already send to your email address <b>'".$this->email."'</b>.<br>Please verify your email by clicking  verification link</center>";
                    header("Location: ../../info.php");
                    die();
                        
                        
                    }
                    else
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Account Request is in progress</div>";
                        $_SESSION["info"]    = "<center><b>Your email is verified and your request is in under progress.<br>You will be notified by email.</b></center>";
                        header("Location: ../../info.php");
                        die();
                    }
                }
                $Query  = "SELECT * ";
                $Query .= "FROM temp_worker ";
                $Query .= "WHERE email='{$this->email}' ";
                $result = $database->query($Query);
                if ( $row = mysqli_fetch_assoc($result)) 
                {
                    if($row['status'] == 0)
                    {
                        $token = 0;
                        $token = $row['tw_id'];
                        
                        $mail = new PHPMailer;
                        
                        $message = "Welcome <b>".$this->fname." ".$this->lname."</b> to Teacher's Wallet";
                        $message .= "<br><br>";
                        $message .= "We recieved your account request";
                        $message .= "<br><br>";
                        $message .= "**** Click link below to verify your account ****<br>";
                        $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw/VerifyAccountPath?token=".$token."&email=".$this->email."";
                        $message .= "<br><br>";
                        $message .= "<img src='cid:logo' /><br>";
                        $message .= "Teacher's Wallet";

                        $mail->isSMTP();                                      
                        $mail->Host = 'smtp.gmail.com';  
                        $mail->SMTPAuth = true;                               
                        $mail->Username = "teacherwallet@gmail.com";                
                        $mail->Password = 'dhjqihygjwxheeph';                           
                        $mail->SMTPSecure = 'tls';                           
                        $mail->Port = 587;                                  
                        $mail->From = 'admin@unishare.com';
                        $mail->FromName = "Teacher's Wallet";
                        $mail->addAddress($this->email);              
                        $mail->isHTML(true);                                  
                        $mail->AddEmbeddedImage('../../images/icon.png', 'logo');
                        $mail->Subject = 'Email Address Verification';
                        $mail->Body    = $message;
                        
                        if(!$mail->send()) {
                            //$_SESSION['emailNotSent'] ="Failed to send verification email.";
                            //echo $mail->ErrorInfo;
                           // header("Location:index.view.php");
                        }
                        
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;>Please verify your account</div>";
                        $_SESSION["info"]    = "<center><b>Note</b> - <u>admin will not be able to view your account request untill you verify your email</u><br>An email that contain your verification link is already send to your email address <b>'".$this->email."'</b>.<br>Please verify your email by clicking  verification link</center>";
                        header("Location: ../../info.php");
                        die();
                        
                        
                    }
                    else
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Account Request is in progress</div>";
                        $_SESSION["info"]    = "<center><b>Your email is verified and your request is in under progress.<br>You will be notified by email.</b></center>";
                        header("Location: ../../info.php");
                        die();
                    }
                }
                else
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Account not found</div>";
                    $_SESSION["info"]    = "<center><b>Possible Reasons<br>Your account request rejected by Admin</b></center>";
                    header("Location: ../../info.php");
                    die();
                }
            }
            
    	}
    	

        return $this->Result;
    }  
}
$MyOBJECT = new RecoverAccount;
$MyOBJECT->authenticate();

?>