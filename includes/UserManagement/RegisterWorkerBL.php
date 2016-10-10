<?php
if(session_id() == '') {
    session_start();
}
require_once("../../PHPMailerAutoload.php");
require_once("../database.php");
class RegisterWorker
{
    
    private $email;
    private $password;
    private $Cpassword;
    Private $fname;
    Private $lname;
    Private $designation;
    Private $shift;
    Private $Result;
	function __construct()
	{
        $this->email            = $_POST["email"];
        $this->password         = $_POST["password"];
        $this->Cpassword        = $_POST["Cpassword"];
        $this->fname            = $_POST["fname"];
        $this->lname            = $_POST["lname"];
        $this->designation      = $_POST["designation"];
        $this->shift            = $_POST["shift"];
	}
    public function register()
    {	
    	global $database;

        $this->fname        = trim($this->fname);
        $this->lname        = trim($this->lname);
        $this->designation  = trim($this->designation);
        $this->shift        = trim($this->shift);

       $this->email          = trim($this->email);  
       $this->password       = trim($this->password);
       $this->Cpassword      = trim($this->Cpassword);

    	if(($this->fname == null)||($this->lname == null)||($this->designation == null)||($this->shift == null) ||($this->email == null)||($this->password == null)||($this->Cpassword == null))
    	{
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -20pt 0pt 0pt 0pt;'><b>Please re-enter your missing information.</div>";
            header("Location: ../../user/profile.php");
    	}
    	{
            if($this->password == $this->Cpassword)
            {
                $this->email        = $database->escape_value($this->email);  
                $this->password     = $database->escape_value($this->password);

                $this->fname        = $database->escape_value($this->fname);
                $this->lname        = $database->escape_value($this->lname );
                $this->designation  = $database->escape_value($this->designation);
                $this->shift        = $database->escape_value($this->shift);

                $Query = "SELECT * FROM temp_worker WHERE email ='".$this->email."' ";
                $result = $database->query($Query);
                if($row = mysqli_fetch_assoc($result)) 
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
                        $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw/includes/UserManagement/VerifyAccount.php?token=".$token."&email=".$this->email."&id=3";
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
                        
                        if(!$mail->send()) {}
                                               
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Another Request Already Pendding!</div>";
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
                $Query = "SELECT * FROM user WHERE email ='".$this->email."' ";
                $result = $database->query($Query);
                if($row = mysqli_fetch_assoc($result))
                {
                    $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Email Already Registered!</div>";
                    $_SESSION["info"]    = "<center>Please <a href='index.php'>Login</a> to continue</center>";
                    header("Location: ../../info.php");
                    die();
                }
                $Query  = "INSERT INTO temp_worker ";
                $Query .= "(fname,lname,designation,shift,email,password,status) ";
                $Query .= "VALUES "; 
                $Query .= "( ";
                $Query .= "'{$this->fname}','{$this->lname}','{$this->designation}','{$this->shift}','{$this->email}','{$this->password}',0";
                $Query .= " )";
                        
                $result = $database->query($Query);
               if (!$result) 
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -35pt 0pt -8pt;'><b>Please re-enter your information</b><br><br>Information you entered is incorrect. Please try again (make sure your caps lock is off).</div>";
                   header("Location: ../../signup.php");
                   die();
                } 
                else 
                {
                    $token = 0;
                    $Query = "SELECT MAX(tw_id) AS token FROM temp_worker";
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
                    $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw/includes/UserManagement/VerifyAccount.php?token=".$token."&email=".$this->email."&id=3";
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
                    
                    $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Account Request Send!</div>";
                    $_SESSION["info"]    = "<center><b>Note</b> - <u>admin will not be able to view your account request untill you verify your email</u><br>An email that contain your verification link is already send to your email address <b>'".$this->email."'</b>.<br>Please verify your email by clicking  verification link</center>";
                    header("Location: ../../info.php");
                    die();
                }
            }
            else
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Password missmatch.</div>";
                header("Location: ../../signup.php");
                die();
            }
        }
        return $this->Result;
    }  
}
$MyOBJECT = new RegisterWorker;
$MyOBJECT->register();

?>