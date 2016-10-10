<?php
if(session_id() == '') {
    session_start();
}
require_once("../../PHPMailerAutoload.php");
require_once("../database.php");
class RegisterTeacher
    {
   
    private $email;
    private $password;
    private $Cpassword;

    Private $fname;
    Private $lname;
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

        $this->email            = $_POST["email"];
        $this->password         = $_POST["password"];
        $this->Cpassword        = $_POST["Cpassword"];

        $this->fname            = $_POST["fname"];
        $this->lname            = $_POST["lname"];
        $this->session          = $_POST["session"];
        $this->rom              = $_POST["rom"];
        if(isset($_POST["cnic"]))
        {
           $this->cnic           = $_POST["cnic"]; 
        }
        else
        {
            $this->cnic         = "N/A";
        }
        $this->phone            = $_POST["contact"];
        $this->gender           = $_POST["gender"];
        $this->qualification    = $_POST["qualification"];
        $this->degree           = $_POST["degree"];
	}
    public function Register()
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
       $this->email          = trim($this->email);  
       $this->password       = trim($this->password);
       $this->Cpassword      = trim($this->Cpassword);

    	if(($this->fname == null)||($this->lname == null)||($this->session == null) || ($this->rom == null)  || ($this->phone == null) || ($this->gender == null) || ($this->qualification == null)||($this->degree == null)||($this->email == null)||($this->password == null)||($this->Cpassword == null))
    	{
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Please re-enter your missing information.</div>";
          //header("Location: ../../signup.php");
    	}
    	else
        {
            if($this->password == $this->Cpassword)
            {
                $this->email          = $database->escape_value($this->email);  
                $this->password       = $database->escape_value($this->password);

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
                
               
                $Query = "SELECT * FROM temp_teacher WHERE email ='".$this->email."' ";
                $result = $database->query($Query);
                if($row = mysqli_fetch_assoc($result)) 
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
                       $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw/includes/UserManagement/VerifyAccount.php?token=".$token."&email=".$this->email."&id=2";
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
                $Query  = "INSERT INTO temp_teacher ";
                $Query .= "(fname,lname,cnic,phone,office,gender,qualification,email,password,status) ";
                $Query .= "VALUES "; 
                $Query .= "( ";
                $Query .= "'{$this->fname}','{$this->lname}','{$this->cnic}','{$this->phone}','{$this->session}','{$this->gender}','{$this->qualification}','{$this->email}','{$this->password}',0";
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
                    $Query = "SELECT MAX(tt_id) AS token FROM temp_teacher";
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
                    $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw/includes/UserManagement/VerifyAccount.php?token=".$token."&email=".$this->email."&id=2";
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
                    
                    $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Account Request Send!</div>";
                    $_SESSION["info"]    = "<center><b>Note</b> - <u>admin will not be able to view your account request untill you verify your email</u><br>An email that contain your verification link is already send to your email address <b>'".$this->email."'</b>.<br>Please verify your email by clicking  verification link</center>";
                    header("Location: ../../info.php");
                }
            }
            else
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Password missmatch.</div>";
                header("Location: ../../signup.php");
            }
        }
        return $this->Result;
    }  
}
$MyOBJECT = new RegisterTeacher;
$MyOBJECT->Register();

?>